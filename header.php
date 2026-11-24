<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">

  <?php
  $header_marquee_text = 'A DINNER WORTH DYING FOR';
  $header_title = get_bloginfo( 'name' ) ?: 'OCCHIO FATALE';
  $header_menu_items = array();

  if ( function_exists( 'get_field' ) ) {
    $page_modules = get_field( 'page_modules' );

    if ( is_array( $page_modules ) ) {
      foreach ( $page_modules as $module ) {
        if ( isset( $module['acf_fc_layout'] ) && $module['acf_fc_layout'] === 'header' ) {
          $header_marquee_text = !empty( $module['marquee_text'] ) ? $module['marquee_text'] : $header_marquee_text;
          $header_title = !empty( $module['title'] ) ? $module['title'] : $header_title;

          $header_menu_items = array(
            array( 'link' => $module['dinner_link'] ?? null, 'fallback' => 'Dinner' ),
            array( 'link' => $module['menu_link'] ?? null, 'fallback' => 'Menu' ),
            array( 'link' => $module['booking_link'] ?? null, 'fallback' => 'Booking' ),
          );
          break;
        }
      }
    }
  }

  $header_marquee_copy = implode( ' || ', array_fill( 0, 10, $header_marquee_text ) );
  ?>

  <header id="masthead" class="site-header page-header">
    <div class="page-header__marquee" aria-hidden="true">
      <div class="page-header__marquee-track">
        <?php for ( $copy = 0; $copy < 2; $copy++ ): ?>
          <span class="page-header__marquee-copy">
            <?php echo esc_html( $header_marquee_copy ); ?>
          </span>
        <?php endfor; ?>
      </div>
    </div>

    <div class="page-header__center">
      <a class="page-header__title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
        <?php echo esc_html( $header_title ); ?>
      </a>

      <nav id="site-navigation" class="main-navigation page-header__menu" aria-label="<?php esc_attr_e( 'Main menu', 'projecttheme' ); ?>">
        <button
          class="menu-toggle"
          type="button"
          aria-controls="menu-main"
          aria-expanded="false"
        >
          <span class="menu-toggle-label"><?php esc_html_e( 'Menu', 'projecttheme' ); ?></span>
          <span class="menu-toggle-icon" aria-hidden="true">
            <span></span>
            <span></span>
            <span></span>
          </span>
        </button>
        <?php if ( !empty( $header_menu_items ) ): ?>
          <ul class="main-menu">
            <?php foreach ( $header_menu_items as $menu_item ): ?>
              <?php
              $link = $menu_item['link'];
              if ( !is_array( $link ) || empty( $link['url'] ) ) continue;
              $target = !empty( $link['target'] ) ? $link['target'] : '_self';
              $rel = $target === '_blank' ? ' rel="noopener noreferrer"' : '';
              $label = !empty( $link['title'] ) ? $link['title'] : $menu_item['fallback'];
              ?>
              <li>
                <a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $target ); ?>"<?php echo $rel; ?>>
                  <?php echo esc_html( $label ); ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php else: ?>
          <?php
          wp_nav_menu(
            array(
              'theme_location'  => 'menu-main',
              'menu_id'         => 'menu-main',
              'menu_class'      => 'main-menu',
              'container_class' => 'main-menu-container',
              'fallback_cb'     => '',
            )
          );
          ?>
        <?php endif; ?>
      </nav>
    </div>
  </header>

  <div id="content" class="site-content">
