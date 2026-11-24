<?php
$headline = get_sub_field('headline') ?: 'Choose one of many dinners';
$options = get_sub_field('options') ?: array();
?>
<div class="options">
  <?php if ($headline): ?>
    <h2 class="options__title"><?php echo esc_html($headline); ?></h2>
  <?php endif; ?>

  <?php if (!empty($options)): ?>
    <div class="options__grid">
      <?php foreach ($options as $option): ?>
        <?php
        $image_id = $option['image'] ?? 0;
        $title = $option['title'] ?? '';
        $text = $option['text'] ?? '';
        $price = $option['price'] ?? '';
        $link = $option['link'] ?? array();
        $url = is_array($link) ? ($link['url'] ?? '') : '';
        $target = is_array($link) ? ($link['target'] ?: '_self') : '_self';
        ?>
        <article class="options__card">
          <?php if ($image_id): ?>
            <div class="options__image">
              <?php echo wp_get_attachment_image($image_id, 'large', false, [
                'class' => 'options__image-file',
                'loading' => 'lazy',
                'decoding' => 'async',
              ]); ?>
            </div>
          <?php endif; ?>

          <div class="options__body">
            <?php if ($title): ?>
              <h3 class="options__card-title"><?php echo esc_html($title); ?></h3>
            <?php endif; ?>
            <?php if ($text): ?>
              <p class="options__text"><?php echo esc_html($text); ?></p>
            <?php endif; ?>
            <?php if ($price): ?>
              <p class="options__price"><?php echo esc_html($price); ?></p>
            <?php endif; ?>
            <?php if ($url): ?>
              <a class="options__link" href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>">
                <?php echo esc_html($link['title'] ?: __('View option', 'projecttheme')); ?>
              </a>
            <?php endif; ?>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>
