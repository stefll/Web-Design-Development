
  </div><!-- #content -->

  <?php
  $footer_title = function_exists( 'get_field' ) ? get_field( 'footer_title', 'option' ) : '';
  $footer_background = function_exists( 'get_field' ) ? get_field( 'footer_background', 'option') : '';
  $footer_description = function_exists( 'get_field' ) ? get_field( 'footer_description', 'option' ) : '';
  $footer_address = function_exists( 'get_field' ) ? get_field( 'footer_address', 'option' ) : '';
  $footer_email = function_exists( 'get_field' ) ? get_field( 'footer_email', 'option' ) : '';
  $footer_phone = function_exists( 'get_field' ) ? get_field( 'footer_phone', 'option' ) : '';
  $footer_social = function_exists( 'get_field' ) ? get_field( 'footer_social', 'option' ) : array();
  $footer_navigation = function_exists( 'get_field' ) ? get_field( 'footer_navigation', 'option' ) : array();

  $footer_title = $footer_title ?: 'OCCHIO FATALE';
  $footer_description = $footer_description ?: 'Behind every perfect evening hides a secret.';
  $footer_address = $footer_address ?: "Hidden address 65\nFr. 12345";
  $footer_email = $footer_email ?: 'occhio@fatale.com';
  $footer_phone = $footer_phone ?: '+49 1234 567 890';
  $footer_style = $footer_background ? ' style="background-color:' . esc_attr( $footer_background ) . '"' : '';
  ?>

  <footer id="colophon" class="site-footer"<?php echo $footer_style; ?>>
    <div class="footer__inner">
      <h2 class="footer__title"><?php echo esc_html( $footer_title ); ?></h2>

      <div class="footer__grid">
        <div class="footer__column footer__contact">
          <h3>Contact</h3>
          <p><?php echo nl2br( esc_html( $footer_address ) ); ?></p>
          <?php if ( $footer_email ): ?>
            <a href="mailto:<?php echo esc_attr( antispambot( $footer_email ) ); ?>"><?php echo esc_html( antispambot( $footer_email ) ); ?></a>
          <?php endif; ?>
          <?php if ( $footer_phone ): ?>
            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $footer_phone ) ); ?>"><?php echo esc_html( $footer_phone ); ?></a>
          <?php endif; ?>
        </div>

        <div class="footer__column footer__description">
          <?php if ( $footer_description ): ?>
            <p><?php echo esc_html( $footer_description ); ?></p>
          <?php endif; ?>
        </div>

        <?php if ( is_array( $footer_social ) && !empty( $footer_social ) ): ?>
          <div class="footer__social" aria-label="<?php esc_attr_e( 'Social media', 'projecttheme' ); ?>">
            <?php foreach ( $footer_social as $social ): ?>
              <?php
              $social_link = $social['link'] ?? array();
              $social_label = $social['label'] ?? '';
              if ( !is_array( $social_link ) || empty( $social_link['url'] ) ) continue;
              ?>
              <a href="<?php echo esc_url( $social_link['url'] ); ?>" target="<?php echo esc_attr( $social_link['target'] ?: '_self' ); ?>" aria-label="<?php echo esc_attr( $social_label ?: $social_link['title'] ?: 'Social link' ); ?>"<?php echo !empty( $social_link['target'] ) && $social_link['target'] === '_blank' ? ' rel="noopener noreferrer"' : ''; ?>>
                <?php echo esc_html( $social_label ?: $social_link['title'] ?: '↗' ); ?>
              </a>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <div class="footer__social" aria-hidden="true">
            <span></span><span></span><span></span>
          </div>
        <?php endif; ?>
      </div>

      <?php if ( is_array( $footer_navigation ) && !empty( $footer_navigation ) ): ?>
        <nav class="footer__navigation" aria-label="<?php esc_attr_e( 'Footer navigation', 'projecttheme' ); ?>">
          <?php foreach ( $footer_navigation as $item ): ?>
            <?php
            $link = $item['link'] ?? array();
            if ( !is_array( $link ) || empty( $link['url'] ) ) continue;
            ?>
            <a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ?: '_self' ); ?>"<?php echo !empty( $link['target'] ) && $link['target'] === '_blank' ? ' rel="noopener noreferrer"' : ''; ?>>
              <?php echo esc_html( $link['title'] ?: '' ); ?>
            </a>
          <?php endforeach; ?>
        </nav>
      <?php endif; ?>
    </div>
  </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
