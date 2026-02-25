<?php
/**
 * Страница настроек форм в админке (Внешний вид → Формы)
 * Работает без ACF Pro — пункт меню добавляется всегда.
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Получить значение настройки формы (из опций или ACF Option)
 *
 * @param string $key Ключ опции, например gociss_form_popup_shortcode.
 * @return string
 */
function gociss_form_option( $key ) {
	$v = get_option( $key );
	if ( $v === false && function_exists( 'get_field' ) ) {
		$v = get_field( $key, 'option' );
	}
	if ( $v === null || $v === false ) {
		return '';
	}
	// ACF image: может вернуть массив с url
	if ( is_array( $v ) && ! empty( $v['url'] ) ) {
		return $v['url'];
	}

	// Поля-изображения: если сохранён ID вложения — конвертируем в URL
	$image_keys = array( 'gociss_form_consult_photo', 'gociss_form_popup_image' );
	if ( in_array( $key, $image_keys, true ) && is_numeric( $v ) && (int) $v > 0 ) {
		$url = wp_get_attachment_image_url( (int) $v, 'medium_large' );
		return $url ? $url : '';
	}

	return is_string( $v ) ? $v : '';
}

/* ==========================================================================
   ШОРТКОДЫ ФОРМ — для вставки на любую страницу через редактор

   [gociss_form_consult]        — «Готовы проконсультировать» (фото + форма)
   [gociss_form_callback]       — «Остались вопросы» (горизонтальная компактная)
   [gociss_form_vertical]       — «Онлайн заявка» вертикальная (карточка)
   [gociss_form_horizontal]     — «Онлайн заявка» горизонтальная

   Параметр service_name — название услуги для скрытого поля (опц.)
   ========================================================================== */

/**
 * Шорткод [gociss_form_consult]
 */
function gociss_shortcode_form_consult( $atts ) {
	$atts = shortcode_atts( array( 'service_name' => '' ), $atts, 'gociss_form_consult' );
	ob_start();
	get_template_part( 'template-parts/forms/consult', null, $atts );
	return ob_get_clean();
}
add_shortcode( 'gociss_form_consult', 'gociss_shortcode_form_consult' );

/**
 * Шорткод [gociss_form_callback]
 */
function gociss_shortcode_form_callback( $atts ) {
	$atts = shortcode_atts( array( 'service_name' => '' ), $atts, 'gociss_form_callback' );
	ob_start();
	get_template_part( 'template-parts/forms/callback-simple', null, $atts );
	return ob_get_clean();
}
add_shortcode( 'gociss_form_callback', 'gociss_shortcode_form_callback' );

/**
 * Шорткод [gociss_form_vertical]
 */
function gociss_shortcode_form_vertical( $atts ) {
	$atts = shortcode_atts( array( 'service_name' => '' ), $atts, 'gociss_form_vertical' );
	ob_start();
	get_template_part( 'template-parts/forms/application-vertical', null, $atts );
	return ob_get_clean();
}
add_shortcode( 'gociss_form_vertical', 'gociss_shortcode_form_vertical' );

/**
 * Шорткод [gociss_form_horizontal]
 */
function gociss_shortcode_form_horizontal( $atts ) {
	$atts = shortcode_atts( array( 'service_name' => '' ), $atts, 'gociss_form_horizontal' );
	ob_start();
	get_template_part( 'template-parts/forms/application-horizontal', null, $atts );
	return ob_get_clean();
}
add_shortcode( 'gociss_form_horizontal', 'gociss_shortcode_form_horizontal' );


/**
 * Добавить пункт меню «Формы» в раздел «Внешний вид»
 */
function gociss_forms_add_admin_menu() {
	add_theme_page(
		'Настройки форм',
		'Формы',
		'edit_posts',
		'gociss-forms-settings',
		'gociss_forms_options_page_render'
	);
}
add_action( 'admin_menu', 'gociss_forms_add_admin_menu' );

/**
 * Подключение медиабиблиотеки на странице настроек форм
 */
function gociss_forms_enqueue_media( $hook ) {
	if ( $hook !== 'appearance_page_gociss-forms-settings' ) {
		return;
	}
	wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'gociss_forms_enqueue_media' );

/**
 * JS для медиа-загрузчика фото консультанта (выводится в футере админки)
 */
function gociss_forms_footer_scripts() {
	$screen = get_current_screen();
	if ( ! $screen || $screen->id !== 'appearance_page_gociss-forms-settings' ) {
		return;
	}
	?>
	<script>
	jQuery(function($){
		var frame;
		$('#gociss_consult_photo_select').on('click',function(e){
			e.preventDefault();
			if(frame){frame.open();return;}
			frame=wp.media({
				title:'Выберите фото консультанта',
				library:{type:'image'},
				button:{text:'Использовать'},
				multiple:false
			});
			frame.on('select',function(){
				var att=frame.state().get('selection').first().toJSON();
				$('#gociss_form_consult_photo').val(att.url);
				$('#gociss_consult_photo_preview').html('<img src="'+att.url+'" alt="" style="max-width:150px;height:auto;display:block;border:1px solid #ddd;border-radius:4px;">');
				$('#gociss_consult_photo_remove').show();
			});
			frame.open();
		});
		$('#gociss_consult_photo_remove').on('click',function(e){
			e.preventDefault();
			$('#gociss_form_consult_photo').val('');
			$('#gociss_consult_photo_preview').html('<span class="gociss-media-placeholder" style="display:inline-block;padding:20px;background:#f5f5f5;border:1px dashed #ccc;border-radius:4px;color:#666;">Фото не выбрано</span>');
			$(this).hide();
		});
	});
	</script>
	<?php
}
add_action( 'admin_print_footer_scripts', 'gociss_forms_footer_scripts' );

/**
 * Сохранение настроек форм
 */
function gociss_forms_save_options() {
	if ( ! current_user_can( 'edit_posts' ) ) {
		return;
	}
	// phpcs:ignore WordPress.Security.NonceVerification.Missing
	if ( empty( $_POST['gociss_forms_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['gociss_forms_nonce'] ) ), 'gociss_forms_save' ) ) {
		return;
	}

	$keys = array(
		'gociss_form_default_shortcode',
		'gociss_form_popup_shortcode',
		'gociss_form_popup_image',
		'gociss_form_consult_shortcode',
		'gociss_form_consult_photo',
		'gociss_form_consult_name',
		'gociss_form_callback_shortcode',
		'gociss_form_vertical_shortcode',
		'gociss_form_horizontal_shortcode',
	);

	// Поля-изображения: санитизируем как URL, а не как текст
	$image_keys = array( 'gociss_form_consult_photo', 'gociss_form_popup_image' );

	foreach ( $keys as $key ) {
		// phpcs:ignore WordPress.Security.NonceVerification.Missing
		$value = isset( $_POST[ $key ] ) ? wp_unslash( $_POST[ $key ] ) : '';
		if ( in_array( $key, $image_keys, true ) ) {
			$value = is_string( $value ) ? esc_url_raw( $value ) : '';
		} else {
			$value = is_string( $value ) ? sanitize_text_field( $value ) : '';
		}
		update_option( $key, $value );
	}

	set_transient( 'gociss_forms_saved', true, 30 );
}

/**
 * Вывод страницы настроек форм
 */
function gociss_forms_options_page_render() {
	gociss_forms_save_options();

	// Уведомление об успешном сохранении
	if ( get_transient( 'gociss_forms_saved' ) ) {
		delete_transient( 'gociss_forms_saved' );
		echo '<div class="notice notice-success is-dismissible"><p>Настройки форм сохранены.</p></div>';
	}

	$default_shortcode    = get_option( 'gociss_form_default_shortcode', '' );
	$popup_shortcode      = get_option( 'gociss_form_popup_shortcode', '' );
	$popup_image          = get_option( 'gociss_form_popup_image', '' );
	$consult_shortcode    = get_option( 'gociss_form_consult_shortcode', '' );
	$consult_photo        = get_option( 'gociss_form_consult_photo', '' );
	$consult_name         = get_option( 'gociss_form_consult_name', 'Специалист-консультант' );
	$callback_shortcode   = get_option( 'gociss_form_callback_shortcode', '' );
	$vertical_shortcode   = get_option( 'gociss_form_vertical_shortcode', '' );
	$horizontal_shortcode = get_option( 'gociss_form_horizontal_shortcode', '' );

	?>
	<div class="wrap">
		<h1>Настройки форм</h1>
		<p>Вставьте шорткоды форм Contact Form 7. Формы создаются в <a href="<?php echo esc_url( admin_url( 'admin.php?page=wpcf7' ) ); ?>">Контакты → Contact Form 7</a>.</p>

		<div style="background:#f0f6ff;border:1px solid #c3dafe;border-radius:8px;padding:16px 20px;margin:16px 0 24px;">
			<strong>Как это работает:</strong>
			<ul style="margin:8px 0 0;list-style:disc;padding-left:20px;">
				<li><strong>Основная форма</strong> — отображается на всех страницах по умолчанию</li>
				<li><strong>Попап</strong> — глобально по кнопке «Заказать звонок»</li>
				<li><strong>Варианты</strong> — менеджер выбирает на конкретной странице через ACF-поле «Вариант формы»</li>
			</ul>
			<p style="margin:12px 0 4px;"><strong>Шорткоды для вставки в контент:</strong></p>
			<ul style="margin:4px 0 0;list-style:disc;padding-left:20px;">
				<li><code>[gociss_form_consult]</code> — «Готовы проконсультировать»</li>
				<li><code>[gociss_form_callback]</code> — «Остались вопросы»</li>
				<li><code>[gociss_form_vertical]</code> — «Онлайн заявка» вертикальная</li>
				<li><code>[gociss_form_horizontal]</code> — «Онлайн заявка» горизонтальная</li>
			</ul>
		</div>

		<form method="post" action="">
			<?php wp_nonce_field( 'gociss_forms_save', 'gociss_forms_nonce' ); ?>

			<h2 class="title">Основная форма и попап</h2>

			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="gociss_form_default_shortcode">Основная форма (по умолчанию)</label></th>
					<td>
						<input type="text" name="gociss_form_default_shortcode" id="gociss_form_default_shortcode" value="<?php echo esc_attr( $default_shortcode ); ?>" class="large-text" placeholder="[contact-form-7 id=&quot;...&quot; title=&quot;Основная&quot;]">
						<p class="description">Используется на всех страницах, если не выбран другой вариант. Это форма в стиле главной страницы.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="gociss_form_popup_shortcode">Попап «Есть вопросы»</label></th>
					<td>
						<input type="text" name="gociss_form_popup_shortcode" id="gociss_form_popup_shortcode" value="<?php echo esc_attr( $popup_shortcode ); ?>" class="large-text" placeholder="[contact-form-7 id=&quot;...&quot; title=&quot;Попап&quot;]">
						<p class="description">Глобальный попап по кнопке «Заказать звонок» в шапке/подвале</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="gociss_form_popup_image">Фото оператора (попап)</label></th>
					<td>
						<input type="url" name="gociss_form_popup_image" id="gociss_form_popup_image" value="<?php echo esc_attr( $popup_image ); ?>" class="large-text" placeholder="https://...">
						<p class="description">URL изображения справа в попапе (необязательно)</p>
					</td>
				</tr>
			</table>

			<h2 class="title">Резервные варианты форм</h2>
			<p>CF7-шорткоды для каждого варианта дизайна. Менеджер выбирает вариант через ACF-поле «Вариант формы» на конкретной странице.</p>

			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="gociss_form_consult_shortcode">«Готовы проконсультировать»</label></th>
					<td>
						<input type="text" name="gociss_form_consult_shortcode" id="gociss_form_consult_shortcode" value="<?php echo esc_attr( $consult_shortcode ); ?>" class="large-text" placeholder="[contact-form-7 ...]">
						<p class="description">Форма с фото консультанта слева</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="gociss_form_consult_photo">Фото консультанта</label></th>
					<td>
						<?php
						$consult_photo_url = '';
						if ( $consult_photo ) {
							$consult_photo_url = is_numeric( $consult_photo )
								? wp_get_attachment_image_url( (int) $consult_photo, 'medium' )
								: $consult_photo;
						}
						?>
						<input type="text" name="gociss_form_consult_photo" id="gociss_form_consult_photo" value="<?php echo esc_attr( $consult_photo ); ?>" class="large-text" placeholder="ID вложения или URL изображения">
						<p class="description">Введите URL изображения или нажмите «Выбрать» для выбора из медиабиблиотеки.</p>
						<p class="description" style="color:#888;"><strong>Текущее значение в БД:</strong> <code><?php echo esc_html( $consult_photo ? $consult_photo : '(пусто)' ); ?></code></p>
						<div style="margin:10px 0;">
							<button type="button" class="button" id="gociss_consult_photo_select">Выбрать из медиабиблиотеки</button>
							<button type="button" class="button" id="gociss_consult_photo_remove" <?php echo $consult_photo ? '' : ' style="display:none;"'; ?>>Удалить</button>
						</div>
						<div id="gociss_consult_photo_preview" class="gociss-media-preview">
							<?php if ( $consult_photo_url ) : ?>
								<img src="<?php echo esc_url( $consult_photo_url ); ?>" alt="" style="max-width:150px;height:auto;display:block;border:1px solid #ddd;border-radius:4px;">
							<?php endif; ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="gociss_form_consult_name">Подпись под фото</label></th>
					<td>
						<input type="text" name="gociss_form_consult_name" id="gociss_form_consult_name" value="<?php echo esc_attr( $consult_name ); ?>" class="regular-text">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="gociss_form_callback_shortcode">«Остались вопросы»</label></th>
					<td>
						<input type="text" name="gociss_form_callback_shortcode" id="gociss_form_callback_shortcode" value="<?php echo esc_attr( $callback_shortcode ); ?>" class="large-text" placeholder="[contact-form-7 ...]">
						<p class="description">Компактная горизонтальная форма</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="gociss_form_vertical_shortcode">«Онлайн заявка» вертикальная</label></th>
					<td>
						<input type="text" name="gociss_form_vertical_shortcode" id="gociss_form_vertical_shortcode" value="<?php echo esc_attr( $vertical_shortcode ); ?>" class="large-text" placeholder="[contact-form-7 ...]">
						<p class="description">Карточка с тенью</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="gociss_form_horizontal_shortcode">«Онлайн заявка» горизонтальная</label></th>
					<td>
						<input type="text" name="gociss_form_horizontal_shortcode" id="gociss_form_horizontal_shortcode" value="<?php echo esc_attr( $horizontal_shortcode ); ?>" class="large-text" placeholder="[contact-form-7 ...]">
						<p class="description">Секция с тёмно-синим фоном</p>
					</td>
				</tr>
			</table>

			<?php submit_button( 'Сохранить настройки' ); ?>
		</form>
	</div>
	<?php
}
