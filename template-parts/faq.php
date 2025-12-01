<?php
/**
 * Секция FAQ
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$faq_title    = get_field( 'gociss_faq_title' );
$faq_subtitle = get_field( 'gociss_faq_subtitle' );
$faq_items    = get_field( 'gociss_faq_items' );

if ( ! $faq_items ) {
	return;
}
?>

<section class="faq">
	<div class="container">
		<?php if ( $faq_title ) : ?>
			<h2 class="faq__title"><?php echo esc_html( $faq_title ); ?></h2>
		<?php endif; ?>

		<?php if ( $faq_subtitle ) : ?>
			<p class="faq__subtitle"><?php echo esc_html( $faq_subtitle ); ?></p>
		<?php endif; ?>

		<div class="faq__list">
			<?php
			$index = 0;
			foreach ( $faq_items as $faq_item ) :
				$index++;
				$is_open = ( 1 === $index ) ? 'is-open' : '';
				?>
				<div class="faq__item <?php echo esc_attr( $is_open ); ?>">
					<button class="faq__question" aria-expanded="<?php echo ( 1 === $index ) ? 'true' : 'false'; ?>">
						<span class="faq__question-text"><?php echo esc_html( $faq_item['question'] ); ?></span>
						<span class="faq__icon">▼</span>
					</button>
					<div class="faq__answer">
						<?php echo wp_kses_post( $faq_item['answer'] ); ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>



