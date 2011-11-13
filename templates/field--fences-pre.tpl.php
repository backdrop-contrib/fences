<?php
/**
 * @file field--fences-pre.tpl.php
 * Wrap a single-value field in the <pre> element.
 *
 * @see http://developers.whatwg.org/grouping-content.html#the-pre-element
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

<pre class="<?php print $classes; ?> field-item odd"<?php print $attributes; ?>>
  <?php print render($items[0]); ?>
</pre>
