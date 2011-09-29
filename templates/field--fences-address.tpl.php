<?php
/**
 * Support for the <address> element
 * for a single Drupal field
 * http://developers.whatwg.org/sections.html#the-address-element
 *
 * These semantics may not be right for your content. We suggest you read the spec and customize this as needed. You can make a copy of this file, put it in your theme, and edit it (and clear the cache) -- and Drupal will you your copy instead of ours. (Don't alter this copy, however!)
 *
 */
?>
<address class="<?php print $classes; ?> clearfix"<?php print $attributes . $item_attributes[0]; ?>>

  <?php if (!$label_hidden) : ?>
    <span class="field-label <?php print $title_attributes; ?>">
      <?php print $label; ?>:
    </span>
  <?php endif; ?>

  <?php print render($items[0]); ?>

</address>
