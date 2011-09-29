<?php
/**
 * @file field--fences-pre-multiple.tpl.php
 * Wrap a multi-value field in the <pre> element.
 *
 * @see http://developers.whatwg.org/grouping-content.html#the-pre-element
 *
 * These semantics may not be right for your content. We suggest you read the
 * spec and customize this as needed. You can put a copy of this file in your
 * theme, edit it, clear the cache, and Drupal will use your theme's copy
 * instead of this one.
 */
?>
<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php if ($element['#label_display'] == 'inline'): ?>
    <span class="field-label <?php print $title_attributes; ?>">
      <?php print $label; ?>:
    </span>
  <?php elseif ($element['#label_display'] == 'above'): ?>
    <h3 class="field-label <?php print $title_attributes; ?>">
      <?php print $label; ?>
    </h3>
  <?php endif; ?>

  <?php foreach ($items as $delta => $item) : ?>
    <pre class="field-item <?php print $delta % 2 ? 'odd' : 'even'; ?>"<?php print $item_attributes[$delta]; ?>>
      <?php print render($item); ?>
    </pre>
  <?php endforeach; ?>

</div>
