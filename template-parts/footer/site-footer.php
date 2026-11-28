<?php
$get_footer_field = function( $name, $default = '' ) {
	return function_exists( 'get_field' ) ? ( get_field( $name, 'option' ) ?: $default ) : $default;
};

$footer_title             = $get_footer_field( 'footer_title', 'OCCHIO FATALE' );
$footer_background        = $get_footer_field( 'footer_background' );
$footer_ticker_text       = $get_footer_field( 'footer_ticker_text', 'A DINNER WORTH DYING FOR' );
$footer_contact_heading   = $get_footer_field( 'footer_contact_heading', 'Contact' );
$footer_questions_heading = $get_footer_field( 'footer_questions_heading', 'Q&A' );
$footer_address           = $get_footer_field( 'footer_address', "Hidden address 65\nFr. 12345" );
$footer_email             = $get_footer_field( 'footer_email', 'occhio@fatale.com' );
$footer_phone             = $get_footer_field( 'footer_phone', '+49 1234 567 890' );
$footer_questions         = function_exists( 'get_field' ) ? get_field( 'footer_questions', 'option' ) : array();
$footer_navigation        = function_exists( 'get_field' ) ? get_field( 'footer_navigation', 'option' ) : array();
$footer_style             = $footer_background ? ' style="--footer-background: ' . esc_attr( $footer_background ) . ';"' : '';

if ( ! is_array( $footer_questions ) || empty( $footer_questions ) ) {
	$footer_questions = array(
		array(
			'question' => 'Dinner',
			'answer'   => 'Murder mystery for 10 people',
		),
		array(
			'question' => 'Menu',
			'answer'   => 'Alternative food options',
		),
		array(
			'question' => 'Bookings',
			'answer'   => 'How should I dress?',
		),
	);
}
?>
<footer id="colophon" class="site-footer"<?php echo $footer_style; ?>>
	<div class="footer__ticker">
		<div class="footer__ticker-track">
			<div class="footer__ticker-group">
				<span class="footer__ticker-copy">
					<?php echo esc_html( $footer_ticker_text ); ?><span class="footer__ticker-separator" aria-hidden="true"> || </span>
				</span>
			</div>
			<div class="footer__ticker-group" aria-hidden="true">
				<span class="footer__ticker-copy">
					<?php echo esc_html( $footer_ticker_text ); ?><span class="footer__ticker-separator" aria-hidden="true"> || </span>
				</span>
			</div>
		</div>
	</div>

	<div class="footer__inner">
		<h2 class="footer__title"><?php echo esc_html( $footer_title ); ?></h2>

		<div class="footer__grid">
			<section class="footer__contact" aria-labelledby="footer-contact-title">
				<h3 id="footer-contact-title" class="footer__section-title"><?php echo esc_html( $footer_contact_heading ); ?></h3>
				<?php if ( $footer_address ): ?>
					<p><?php echo nl2br( esc_html( $footer_address ) ); ?></p>
				<?php endif; ?>
				<?php if ( $footer_phone ): ?>
					<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $footer_phone ) ); ?>"><?php echo esc_html( $footer_phone ); ?></a>
				<?php endif; ?>
				<?php if ( $footer_email ): ?>
					<a href="mailto:<?php echo esc_attr( antispambot( $footer_email ) ); ?>"><?php echo esc_html( antispambot( $footer_email ) ); ?></a>
				<?php endif; ?>
			</section>

			<section class="footer__questions" aria-labelledby="footer-questions-title">
				<h3 id="footer-questions-title" class="footer__section-title"><?php echo esc_html( $footer_questions_heading ); ?></h3>
				<?php foreach ( $footer_questions as $item ): ?>
					<?php
					$question = $item['question'] ?? '';
					$answer   = $item['answer'] ?? '';
					if ( ! $question && ! $answer ) {
						continue;
					}
					?>
					<div class="footer__question">
						<?php if ( $question ): ?>
							<h4><?php echo esc_html( $question ); ?></h4>
						<?php endif; ?>
						<?php if ( $answer ): ?>
							<p><?php echo esc_html( $answer ); ?></p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</section>
		</div>

		<?php if ( is_array( $footer_navigation ) && ! empty( $footer_navigation ) ): ?>
			<nav class="footer__navigation" aria-label="<?php esc_attr_e( 'Footer navigation', 'projecttheme' ); ?>">
				<?php foreach ( $footer_navigation as $item ): ?>
					<?php
					$link = $item['link'] ?? array();
					if ( ! is_array( $link ) || empty( $link['url'] ) ) {
						continue;
					}
					$target = $link['target'] ?? '_self';
					?>
					<a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $target ); ?>"<?php echo '_blank' === $target ? ' rel="noopener noreferrer"' : ''; ?>>
						<?php echo esc_html( $link['title'] ?? '' ); ?>
					</a>
				<?php endforeach; ?>
			</nav>
		<?php endif; ?>
	</div>
</footer><!-- #colophon -->
