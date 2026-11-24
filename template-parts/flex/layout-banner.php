<?php
$text = get_sub_field('text') ?: 'Your table. Your friends. One murder. Everyone has a secret.';
$image_id = get_sub_field('image');
?>
<div class="banner__inner">
  <?php if ($text): ?>
    <p class="banner__text"><?php echo esc_html($text); ?></p>
  <?php endif; ?>

  <?php if ($image_id): ?>
    <div class="banner__illustration" aria-hidden="true">
      <?php echo wp_get_attachment_image($image_id, 'medium', false, [
        'class' => 'banner__image',
        'loading' => 'lazy',
        'decoding' => 'async',
      ]); ?>
    </div>
  <?php endif; ?>
</div>
