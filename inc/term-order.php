<?php
/**
 * Функционал сортировки терминов таксономий (категорий услуг)
 *
 * Добавляет поле menu_order для терминов и drag-and-drop сортировку в админке
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Добавляем поле порядка при создании термина
 */
function gociss_term_order_add_field( $taxonomy ) {
	?>
	<div class="form-field term-order-wrap">
		<label for="term_order"><?php esc_html_e( 'Порядок', 'gociss' ); ?></label>
		<input type="number" name="term_order" id="term_order" value="0" min="0" step="1">
		<p class="description"><?php esc_html_e( 'Чем меньше число, тем выше позиция в списке.', 'gociss' ); ?></p>
	</div>
	<?php
}
add_action( 'gociss_service_cat_add_form_fields', 'gociss_term_order_add_field' );

/**
 * Добавляем поле порядка при редактировании термина
 */
function gociss_term_order_edit_field( $term, $taxonomy ) {
	$order = get_term_meta( $term->term_id, 'menu_order', true );
	$order = $order ? intval( $order ) : 0;
	?>
	<tr class="form-field term-order-wrap">
		<th scope="row">
			<label for="term_order"><?php esc_html_e( 'Порядок', 'gociss' ); ?></label>
		</th>
		<td>
			<input type="number" name="term_order" id="term_order" value="<?php echo esc_attr( $order ); ?>" min="0" step="1">
			<p class="description"><?php esc_html_e( 'Чем меньше число, тем выше позиция в списке.', 'gociss' ); ?></p>
		</td>
	</tr>
	<?php
}
add_action( 'gociss_service_cat_edit_form_fields', 'gociss_term_order_edit_field', 10, 2 );

/**
 * Сохраняем порядок термина
 */
function gociss_term_order_save( $term_id ) {
	if ( isset( $_POST['term_order'] ) ) {
		$order = intval( $_POST['term_order'] );
		update_term_meta( $term_id, 'menu_order', $order );
	}
}
add_action( 'created_gociss_service_cat', 'gociss_term_order_save' );
add_action( 'edited_gociss_service_cat', 'gociss_term_order_save' );

/**
 * Добавляем колонку "Порядок" в таблицу терминов
 */
function gociss_term_order_column( $columns ) {
	$columns['term_order'] = __( 'Порядок', 'gociss' );
	return $columns;
}
add_filter( 'manage_edit-gociss_service_cat_columns', 'gociss_term_order_column' );

/**
 * Выводим значение в колонке "Порядок"
 */
function gociss_term_order_column_content( $content, $column_name, $term_id ) {
	if ( 'term_order' === $column_name ) {
		$order = get_term_meta( $term_id, 'menu_order', true );
		$content = $order ? intval( $order ) : 0;
	}
	return $content;
}
add_filter( 'manage_gociss_service_cat_custom_column', 'gociss_term_order_column_content', 10, 3 );

/**
 * Делаем колонку сортируемой
 */
function gociss_term_order_sortable_column( $columns ) {
	$columns['term_order'] = 'term_order';
	return $columns;
}
add_filter( 'manage_edit-gociss_service_cat_sortable_columns', 'gociss_term_order_sortable_column' );

/**
 * Обработка сортировки терминов по menu_order
 */
function gociss_term_order_clauses( $clauses, $taxonomies, $args ) {
	global $wpdb;

	if ( ! is_admin() || ! in_array( 'gociss_service_cat', $taxonomies, true ) ) {
		// Для фронтенда всегда сортируем по menu_order
		if ( in_array( 'gociss_service_cat', $taxonomies, true ) &&
			( ! isset( $args['orderby'] ) || 'menu_order' === $args['orderby'] ) ) {
			$clauses['join']    .= " LEFT JOIN {$wpdb->termmeta} AS tm ON t.term_id = tm.term_id AND tm.meta_key = 'menu_order'";
			$clauses['orderby']  = 'ORDER BY CAST(COALESCE(tm.meta_value, 999999) AS SIGNED)';
			$clauses['order']    = 'ASC';
		}
		return $clauses;
	}

	// В админке сортируем, если выбрана колонка term_order
	if ( isset( $_GET['orderby'] ) && 'term_order' === $_GET['orderby'] ) {
		$clauses['join']    .= " LEFT JOIN {$wpdb->termmeta} AS tm ON t.term_id = tm.term_id AND tm.meta_key = 'menu_order'";
		$clauses['orderby']  = 'ORDER BY CAST(COALESCE(tm.meta_value, 0) AS SIGNED)';
		$clauses['order']    = isset( $_GET['order'] ) && 'desc' === strtolower( $_GET['order'] ) ? 'DESC' : 'ASC';
	}

	return $clauses;
}
add_filter( 'terms_clauses', 'gociss_term_order_clauses', 10, 3 );

/**
 * AJAX обработчик для drag-and-drop сортировки услуг
 */
function gociss_save_services_order() {
	// Проверка nonce
	check_ajax_referer( 'gociss_sort_services', 'nonce' );

	// Проверка прав
	if ( ! current_user_can( 'edit_posts' ) ) {
		wp_send_json_error( array( 'message' => __( 'Недостаточно прав', 'gociss' ) ) );
	}

	if ( ! isset( $_POST['order'] ) || ! is_array( $_POST['order'] ) ) {
		wp_send_json_error( array( 'message' => __( 'Неверные данные', 'gociss' ) ) );
	}

	$order = array_map( 'intval', $_POST['order'] );

	foreach ( $order as $position => $post_id ) {
		wp_update_post(
			array(
				'ID'         => $post_id,
				'menu_order' => $position,
			)
		);
	}

	wp_send_json_success( array( 'message' => __( 'Порядок сохранён', 'gociss' ) ) );
}
add_action( 'wp_ajax_gociss_save_services_order', 'gociss_save_services_order' );

/**
 * AJAX обработчик для drag-and-drop сортировки категорий
 */
function gociss_save_terms_order() {
	// Проверка nonce
	check_ajax_referer( 'gociss_sort_terms', 'nonce' );

	// Проверка прав
	if ( ! current_user_can( 'manage_categories' ) ) {
		wp_send_json_error( array( 'message' => __( 'Недостаточно прав', 'gociss' ) ) );
	}

	if ( ! isset( $_POST['order'] ) || ! is_array( $_POST['order'] ) ) {
		wp_send_json_error( array( 'message' => __( 'Неверные данные', 'gociss' ) ) );
	}

	$order = array_map( 'intval', $_POST['order'] );

	foreach ( $order as $position => $term_id ) {
		update_term_meta( $term_id, 'menu_order', $position );
	}

	wp_send_json_success( array( 'message' => __( 'Порядок сохранён', 'gociss' ) ) );
}
add_action( 'wp_ajax_gociss_save_terms_order', 'gociss_save_terms_order' );

/**
 * Добавляем страницу сортировки в меню Услуги
 */
function gociss_add_sort_page() {
	add_submenu_page(
		'edit.php?post_type=gociss_service',
		__( 'Сортировка услуг', 'gociss' ),
		__( 'Сортировка', 'gociss' ),
		'edit_posts',
		'gociss-sort-services',
		'gociss_render_sort_page'
	);
}
add_action( 'admin_menu', 'gociss_add_sort_page' );

/**
 * Отображение страницы сортировки
 */
function gociss_render_sort_page() {
	// Получаем все категории
	$categories = get_terms(
		array(
			'taxonomy'   => 'gociss_service_cat',
			'hide_empty' => false,
			'parent'     => 0,
			'orderby'    => 'meta_value_num',
			'meta_key'   => 'menu_order',
			'order'      => 'ASC',
		)
	);

	// Получаем все услуги
	$services = get_posts(
		array(
			'post_type'      => 'gociss_service',
			'posts_per_page' => -1,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		)
	);
	?>
	<div class="wrap gociss-sort-page">
		<h1><?php esc_html_e( 'Сортировка услуг и категорий', 'gociss' ); ?></h1>
		<p class="description"><?php esc_html_e( 'Перетащите элементы для изменения порядка. Изменения сохраняются автоматически.', 'gociss' ); ?></p>

		<div class="gociss-sort-columns">
			<!-- Сортировка категорий -->
			<div class="gociss-sort-column">
				<h2><?php esc_html_e( 'Категории услуг', 'gociss' ); ?></h2>
				<?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
				<ul class="gociss-sortable-list" id="gociss-terms-sortable" data-type="terms">
					<?php foreach ( $categories as $cat ) : ?>
						<li data-id="<?php echo esc_attr( $cat->term_id ); ?>">
							<span class="dashicons dashicons-menu"></span>
							<span class="item-title"><?php echo esc_html( $cat->name ); ?></span>
							<span class="item-order"><?php echo esc_html( get_term_meta( $cat->term_id, 'menu_order', true ) ?: 0 ); ?></span>
						</li>
					<?php endforeach; ?>
				</ul>
				<?php else : ?>
					<p><?php esc_html_e( 'Категории не найдены.', 'gociss' ); ?></p>
				<?php endif; ?>
			</div>

			<!-- Сортировка услуг -->
			<div class="gociss-sort-column">
				<h2><?php esc_html_e( 'Услуги', 'gociss' ); ?></h2>
				<?php if ( ! empty( $services ) ) : ?>
				<ul class="gociss-sortable-list" id="gociss-services-sortable" data-type="services">
					<?php foreach ( $services as $service ) : ?>
						<li data-id="<?php echo esc_attr( $service->ID ); ?>">
							<span class="dashicons dashicons-menu"></span>
							<span class="item-title"><?php echo esc_html( $service->post_title ); ?></span>
							<span class="item-order"><?php echo esc_html( $service->menu_order ); ?></span>
						</li>
					<?php endforeach; ?>
				</ul>
				<?php else : ?>
					<p><?php esc_html_e( 'Услуги не найдены.', 'gociss' ); ?></p>
				<?php endif; ?>
			</div>
		</div>

		<div class="gociss-sort-status" id="sort-status"></div>
	</div>

	<?php
	// Выводим nonces для AJAX
	wp_nonce_field( 'gociss_sort_services', 'gociss_sort_services_nonce' );
	wp_nonce_field( 'gociss_sort_terms', 'gociss_sort_terms_nonce' );
}

/**
 * Подключаем скрипты и стили для страницы сортировки
 */
function gociss_sort_page_scripts( $hook ) {
	if ( 'gociss_service_page_gociss-sort-services' !== $hook ) {
		return;
	}

	// jQuery UI Sortable уже есть в WordPress
	wp_enqueue_script( 'jquery-ui-sortable' );

	// Добавляем кастомные стили и скрипты
	wp_add_inline_style(
		'wp-admin',
		'
		.gociss-sort-page {
			max-width: 1200px;
		}
		.gociss-sort-columns {
			display: grid;
			grid-template-columns: 1fr 1fr;
			gap: 30px;
			margin-top: 20px;
		}
		.gociss-sort-column h2 {
			margin-bottom: 15px;
			padding-bottom: 10px;
			border-bottom: 1px solid #ddd;
		}
		.gociss-sortable-list {
			margin: 0;
			padding: 0;
			list-style: none;
			background: #fff;
			border: 1px solid #ddd;
			border-radius: 4px;
		}
		.gociss-sortable-list li {
			display: flex;
			align-items: center;
			gap: 10px;
			padding: 12px 15px;
			border-bottom: 1px solid #eee;
			background: #fff;
			cursor: move;
		}
		.gociss-sortable-list li:last-child {
			border-bottom: none;
		}
		.gociss-sortable-list li:hover {
			background: #f5f5f5;
		}
		.gociss-sortable-list li.ui-sortable-helper {
			box-shadow: 0 2px 8px rgba(0,0,0,0.1);
		}
		.gociss-sortable-list li.ui-sortable-placeholder {
			background: #f0f0f1;
			visibility: visible !important;
			border: 2px dashed #c3c4c7;
		}
		.gociss-sortable-list .dashicons {
			color: #999;
		}
		.gociss-sortable-list .item-title {
			flex: 1;
		}
		.gociss-sortable-list .item-order {
			color: #999;
			font-size: 12px;
			min-width: 30px;
			text-align: right;
		}
		.gociss-sort-status {
			margin-top: 20px;
			padding: 10px 15px;
			border-radius: 4px;
			display: none;
		}
		.gociss-sort-status.success {
			display: block;
			background: #d4edda;
			color: #155724;
		}
		.gociss-sort-status.error {
			display: block;
			background: #f8d7da;
			color: #721c24;
		}
		@media (max-width: 768px) {
			.gociss-sort-columns {
				grid-template-columns: 1fr;
			}
		}
		'
	);

	wp_add_inline_script(
		'jquery-ui-sortable',
		'
		jQuery(function($) {
			var servicesNonce = $("#gociss_sort_services_nonce").val();
			var termsNonce = $("#gociss_sort_terms_nonce").val();

			function showStatus(message, type) {
				var $status = $("#sort-status");
				$status.removeClass("success error").addClass(type).text(message).show();
				setTimeout(function() {
					$status.fadeOut();
				}, 2000);
			}

			function updateOrder($list) {
				$list.find("li").each(function(index) {
					$(this).find(".item-order").text(index);
				});
			}

			// Сортировка услуг
			$("#gociss-services-sortable").sortable({
				placeholder: "ui-sortable-placeholder",
				update: function(event, ui) {
					var order = $(this).sortable("toArray", {attribute: "data-id"});
					updateOrder($(this));

					$.ajax({
						url: ajaxurl,
						type: "POST",
						data: {
							action: "gociss_save_services_order",
							nonce: servicesNonce,
							order: order
						},
						success: function(response) {
							if (response.success) {
								showStatus("Порядок услуг сохранён", "success");
							} else {
								showStatus("Ошибка: " + response.data.message, "error");
							}
						},
						error: function() {
							showStatus("Ошибка сохранения", "error");
						}
					});
				}
			});

			// Сортировка категорий
			$("#gociss-terms-sortable").sortable({
				placeholder: "ui-sortable-placeholder",
				update: function(event, ui) {
					var order = $(this).sortable("toArray", {attribute: "data-id"});
					updateOrder($(this));

					$.ajax({
						url: ajaxurl,
						type: "POST",
						data: {
							action: "gociss_save_terms_order",
							nonce: termsNonce,
							order: order
						},
						success: function(response) {
							if (response.success) {
								showStatus("Порядок категорий сохранён", "success");
							} else {
								showStatus("Ошибка: " + response.data.message, "error");
							}
						},
						error: function() {
							showStatus("Ошибка сохранения", "error");
						}
					});
				}
			});
		});
		'
	);
}
add_action( 'admin_enqueue_scripts', 'gociss_sort_page_scripts' );

/**
 * Сортировка услуг по menu_order на фронтенде
 */
function gociss_services_default_order( $query ) {
	if ( ! is_admin() && $query->is_main_query() ) {
		if ( is_post_type_archive( 'gociss_service' ) || is_tax( 'gociss_service_cat' ) ) {
			$query->set( 'orderby', 'menu_order' );
			$query->set( 'order', 'ASC' );
		}
	}
}
add_action( 'pre_get_posts', 'gociss_services_default_order' );

/**
 * Добавляем колонку порядка в список услуг
 */
function gociss_service_order_column( $columns ) {
	$new_columns = array();
	foreach ( $columns as $key => $value ) {
		if ( 'title' === $key ) {
			$new_columns['menu_order'] = __( 'Порядок', 'gociss' );
		}
		$new_columns[ $key ] = $value;
	}
	return $new_columns;
}
add_filter( 'manage_gociss_service_posts_columns', 'gociss_service_order_column' );

/**
 * Выводим значение в колонке порядка услуг
 */
function gociss_service_order_column_content( $column, $post_id ) {
	if ( 'menu_order' === $column ) {
		$post = get_post( $post_id );
		echo esc_html( $post->menu_order );
	}
}
add_action( 'manage_gociss_service_posts_custom_column', 'gociss_service_order_column_content', 10, 2 );

/**
 * Делаем колонку порядка сортируемой
 */
function gociss_service_order_sortable( $columns ) {
	$columns['menu_order'] = 'menu_order';
	return $columns;
}
add_filter( 'manage_edit-gociss_service_sortable_columns', 'gociss_service_order_sortable' );


