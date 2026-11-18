<?php
$marquee_text = get_sub_field('marquee_text') ?: 'A DINNER WORTH DYING FOR';
$marquee_copy = implode(' || ', array_fill(0, 10, $marquee_text));
$title = get_sub_field('title') ?: 'OCCHIO FATALE';
$dinner_link = get_sub_field('dinner_link') ?: get_sub_field('catering_link');
$menu_link = get_sub_field('menu_link');
$booking_link = get_sub_field('booking_link');
$menu_items = [
  ['link' => $dinner_link, 'fallback' => 'Dinner'],
  ['link' => $menu_link, 'fallback' => 'Menu'],
  ['link' => $booking_link, 'fallback' => 'Booking'],
];
?>
<header class="page-header">
  <div class="page-header__marquee" aria-hidden="true">
    <div class="page-header__marquee-track">
      <?php for ($copy = 0; $copy < 2; $copy++): ?>
        <span class="page-header__marquee-copy"><?php echo esc_html($marquee_copy); ?></span>
      <?php endfor; ?>
    </div>
  </div>

  <div class="page-header__center">
    <h1 class="page-header__title"><?php echo esc_html($title); ?></h1>

    <nav class="page-header__menu" aria-label="<?php esc_attr_e('Main menu', 'projecttheme'); ?>">
      <?php foreach ($menu_items as $menu_item): ?>
        <?php
        $link = $menu_item['link'];
        if (!is_array($link) || empty($link['url'])) {
          continue;
        }

        $target = !empty($link['target']) ? $link['target'] : '_self';
        $rel = $target === '_blank' ? 'noopener noreferrer' : '';
        $label = !empty($link['title']) ? $link['title'] : $menu_item['fallback'];
        ?>
        <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($target); ?>"<?php echo $rel ? ' rel="' . esc_attr($rel) . '"' : ''; ?>>
          <?php echo esc_html($label); ?>
        </a>
      <?php endforeach; ?>
    </nav>
  </div>
</header>
