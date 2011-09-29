<?php
/**
 * @file field--fences-address.tpl.php
 * Wrap a single-value field in the <address> element.
 *
 * @see http://developers.whatwg.org/sections.html#the-address-element
 *
 * These semantics may not be right for your content. We suggest you read the
 * spec and customize this as needed. You can put a copy of this file in your
 * theme, edit it, clear the cache, and Drupal will use your theme's copy
 * instead of this one.
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
