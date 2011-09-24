<?php

/**
 * Support for the <pre> and <code> elements
 * for Drupal multivalue fields
 * http://developers.whatwg.org/grouping-content.html#the-pre-element
 * http://developers.whatwg.org/text-level-semantics.html#the-code-element
 *
 * These semantics may not be right for your content. We suggest you read the spec and customize this as needed. You can make a copy of this file, put it in your theme, and edit it (and clear the cache) --Êand Drupal will you your copy instead of ours. (Don't alter this copy, however!)
 * 
 */
?>
<address class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

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
    <div class="field-item <?php print $delta % 2 ? 'odd' : 'even'; ?>"<?php print $item_attributes[$delta]; ?>>
      <?php print render($item); ?>
    </div>
  <?php endforeach; ?>

</address>
