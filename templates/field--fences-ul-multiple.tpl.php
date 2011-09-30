<?php
/**
 * @file field--fences-ul-multiple.tpl.php
 * Wrap a multi-value field in the <ul> element.
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
  <span class="field-label <?php print $title_attributes; ?>">
    <?php print $label; ?>:
  </span>
<?php elseif ($element['#label_display'] == 'above'): ?>
  <h3 class="field-label <?php print $title_attributes; ?>">
    <?php print $label; ?>
  </h3>
<?php endif; ?>

<ul class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <?php foreach ($items as $delta => $item) : ?>
    <li class="field-item <?php print $delta % 2 ? 'odd' : 'even'; ?>"<?php print $item_attributes[$delta]; ?>>
      <?php print render($item); ?>
    </li>
  <?php endforeach; ?>

</ul>
