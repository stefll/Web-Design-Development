<?php
$summary = get_sub_field('summary');
$title = get_sub_field('title');
$text     = get_sub_field('text');
$image_id = get_sub_field('image');
?>
<div class="row align-items-center g-5">
  <div class="col-md-6">
    <?php
    if ($image_id) {
      echo wp_get_attachment_image($image_id, 'large', false, [
        'class'    => 'img-fluid rounded',
        'loading'  => 'lazy',
        'decoding' => 'async',
      ]);
    }
    ?>
  </div>
  <div class="col-md-6">
    <?php if ($summary): ?><h2 class="mb-3"><?php echo esc_html($summary); ?></h2><?php endif; ?>
    <?php if ($title): ?><h3 class="mb-3"><?php echo esc_html($title); ?></h3><?php endif; ?>
    <?php if ($text): ?><div class="rte"><?php echo wp_kses_post($text); ?></div><?php endif; ?>
  </div>
</div>