<?php
/**
 * @file field--fences-s.tpl.php
 * Wrap each field value in the <s> element.
 *
 * @see http://developers.whatwg.org/text-level-semantics.html#the-s-element
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

<?php foreach ($items as $delta => $item): ?>
  <s class="<?php print $classes; ?> field-item <?php print $delta % 2 ? 'odd' : 'even'; ?>"<?php print $attributes; ?>>
    <?php print render($item); ?>
  </s>
<?php endforeach; ?>
