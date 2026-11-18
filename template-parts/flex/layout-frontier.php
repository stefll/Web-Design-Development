<?php
$left_image = get_sub_field('left_image');
$main_image = get_sub_field('main_image');
$right_image = get_sub_field('right_image');
$title = get_sub_field('title') ?: 'OCCHIO FATALE';
?>
<div class="frontier">
  <?php if ($left_image || $main_image || $right_image): ?>
    <div class="frontier__gallery">
      <?php if ($left_image): ?>
        <div class="frontier__photo frontier__photo--left">
          <?php echo wp_get_attachment_image($left_image, 'large', false, ['loading' => 'eager', 'decoding' => 'async']); ?>
        </div>
      <?php endif; ?>

      <?php if ($main_image): ?>
        <div class="frontier__photo frontier__photo--main">
          <?php echo wp_get_attachment_image($main_image, 'large', false, ['loading' => 'eager', 'decoding' => 'async']); ?>
        </div>
      <?php endif; ?>

      <?php if ($right_image): ?>
        <div class="frontier__photo frontier__photo--right">
          <?php echo wp_get_attachment_image($right_image, 'large', false, ['loading' => 'eager', 'decoding' => 'async']); ?>
        </div>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <?php if ($title): ?>
    <h1 class="frontier__title"><?php echo esc_html($title); ?></h1>
  <?php endif; ?>
</div>
