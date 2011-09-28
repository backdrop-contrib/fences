<?php
/**
 * @file
 * Hooks provided by the Fences module.
 */

/**
 * @addtogroup hooks
 * @{
 */

/**
 * Provide theme hook suggestions for various theme hooks.
 *
 * @return array
 *   A nested array containing information about the theme hook suggestions
 *   provided by the implementing module.
 */
function hook_fences_suggestion_info() {
  // The suggestions for the "field" theme hook.
  $fences['field'] = array(
    // This key will be appended to THEMEHOOK__fences_ to make the theme hook
    // suggestion. field__fences_p in this case. The corresponding template
    // files should be named field--fences-p.tpl.php and
    // field--fences-p-multiple.tpl.php.
    'p' => array(
      // The label used in the UI when selecting a suggestion.
      'label' => t('p'),
      // The description used in the UI when selecting a suggestion.
      'description' => t('A paragraph tag. Multiple values are each wrapped in a <p>.'),
    ),
  );
  return $fences;
}

/**
 * Alter the theme hook suggestions used by the fences module.
 *
 * @param $fences
 *   An array containing the data returned by hook_fences_suggestion_info().
 */
function hook_fences_suggestion_info_alter(&$fences) {
}

/**
 * @} End of "addtogroup hooks".
 */
