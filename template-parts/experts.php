<?php
/**
 * Секция экспертов
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$experts_query = new WP_Query(
	array(
		'post_type'      => 'gociss_expert',
		'posts_per_page' => 4,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	)
);

if ( ! $experts_query->have_posts() ) {
	return;
}
?>

<section class="experts">
	<div class="container">
		<h2 class="experts__title">Наши ведущие эксперты</h2>
		<p class="experts__subtitle">Команда профессионалов с международной аккредитацией и многолетним опытом</p>

		<div class="experts__slider">
			<button class="experts__nav experts__nav--prev" aria-label="<?php esc_attr_e( 'Предыдущий', 'gociss' ); ?>">‹</button>

			<div class="experts__grid">
				<?php
				while ( $experts_query->have_posts() ) {
					$experts_query->the_post();
					$position    = get_field( 'gociss_expert_position' );
					$experience  = get_field( 'gociss_expert_experience' );
					?>
					<div class="experts__item">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="experts__photo">
								<?php the_post_thumbnail( 'gociss-expert' ); ?>
							</div>
						<?php endif; ?>

						<h3 class="experts__name"><?php the_title(); ?></h3>

						<?php if ( $position ) : ?>
							<p class="experts__position"><?php echo esc_html( $position ); ?></p>
						<?php endif; ?>

						<?php if ( $experience ) : ?>
							<p class="experts__experience"><?php echo esc_html( $experience ); ?></p>
						<?php endif; ?>
					</div>
					<?php
				}
				wp_reset_postdata();
				?>
			</div>

			<button class="experts__nav experts__nav--next" aria-label="<?php esc_attr_e( 'Следующий', 'gociss' ); ?>">›</button>
		</div>
	</div>
</section>



