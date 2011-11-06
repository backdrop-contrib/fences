<?php
/**
 * @file field--fences-ul.tpl.php
 * Wrap a single-value field in the <ul> element.
 *
 * @see http://developers.whatwg.org/grouping-content.html#the-ul-element
 *
 * These semantics may not be right for your content. We suggest you read the
 * spec and customize this as needed. You can put a copy of this file in your
 * theme, edit it, clear the cache, and Drupal will use your theme's copy
 * instead of this one.
 */
?>
<?php if ($element['#label_display'] == 'inline'): ?>
  <span class="field-label"<?php print $title_attributes; ?>>
    <?php print $label; ?>:
  </span>
<?php elseif ($element['#label_display'] == 'above'): ?>
  <h3 class="field-label"<?php print $title_attributes; ?>>
    <?php print $label; ?>
  </h3>
<?php endif; ?>

<ul class="<?php print $classes; ?>"<?php print $attributes; ?>>
<li class="field-item"<?php print $item_attributes[0]; ?>>
  <?php print render($items[0]); ?>
</li>
</ul>
