<?php

/**
 * Support for the <small> element
 * for a single Drupal field
 * http://developers.whatwg.org/text-level-semantics.html#the-small-element
 *
 * These semantics may not be right for your content. We suggest you read the spec and customize this as needed. You can make a copy of this file, put it in your theme, and edit it (and clear the cache) --Êand Drupal will you your copy instead of ours. (Don't alter this copy, however!)
 *
 */
?>
<small class="<?php print $classes; ?> clearfix"<?php print $attributes . $item_attributes[0]; ?>>

  <?php if ($element['#label_display'] == 'inline'): ?>
    <span class="field-label <?php print $title_attributes; ?>">
      <?php print $label; ?>:
    </span>
  <?php elseif ($element['#label_display'] == 'above'): ?>
    <h3 class="field-label <?php print $title_attributes; ?>">
      <?php print $label; ?>
    </h3>
  <?php endif; ?>
  
  <?php print render($items[0]); ?>

</small>
