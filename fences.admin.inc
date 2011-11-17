<?php
/**
 * @file
 * Functions only needed on configuration pages.
 */

/**
 * Implements hook_theme().
 */
function _fences_theme($existing, $type, $theme, $path) {
  $hooks = array();

  $fences = fences_get_fences_suggestion_info();

  $supported_hooks = array('field');
  foreach ($supported_hooks as $hook) {
    foreach ($fences[$hook] as $suggestion => $data) {
      // Manually register the suggestions for a module, but let hook_theme
      // auto-discover theme-owned suggestions as it normally does.
      if ($fences[$hook][$suggestion]['type'] == 'module') {
        $hook_suggestion = $hook . '__fences_' . str_replace('-', '_', $suggestion);
        $hook_suggestions = array($hook_suggestion);
        // Register the "-multiple" suggestion if that template was found.
        if ($fences[$hook][$suggestion]['multiple']) {
          $hook_suggestions[] = $hook_suggestion . '_multiple';
        }
        foreach ($hook_suggestions as $name) {
          $hooks[$name] = array(
            'base hook'      => $hook,
            'render element' => $existing[$hook]['render element'],
            'type'           => $fences[$hook][$suggestion]['type'],
            'theme path'     => $existing[$hook]['theme path'],
            'template'       => str_replace('_', '-', $name),
            'path'           => $fences[$hook][$suggestion]['path'],
          );
        }
      }
    }
  }

  // Register theme hook suggestions for field_collection's entity.
  if (module_exists('entity')) {
    $hooks['entity__fences_no_wrapper'] = array(
      'base hook'      => 'entity',
      'render element' => $existing['entity']['render element'],
      'type'           => 'module',
      'theme path'     => $existing['entity']['theme path'],
      'function'       => 'theme_entity__fences_no_wrapper',
    );
  }

  return $hooks;
}

/**
 * Implements hook_theme_registry_alter().
 */
function _fences_theme_registry_alter(&$theme_registry) {
  $fences = fences_get_fences_suggestion_info();

  // Manually registering module-based suggestions means they mistakenly get
  // preprocess and process functions registered to them.
  $supported_hooks = array('field');
  foreach ($supported_hooks as $hook) {
    foreach ($fences[$hook] as $suggestion => $data) {
      if ($fences[$hook][$suggestion]['type'] == 'module') {
        $hook_suggestion = $hook . '__fences_' . str_replace('-', '_', $suggestion);
        foreach (array($hook_suggestion, $hook_suggestion . '_multiple') as $name) {
          unset($theme_registry[$name]['preprocess functions']);
          unset($theme_registry[$name]['process functions']);
        }
      }
    }
  }
}

/**
 * Helper function for fences_get_fences_suggestion_info().
 */
function _fences_get_fences_suggestion_info(&$fences) {
  $fences = $files = array();

  // Call hook_fences_suggestion_info for modules. We need to search each
  // module for template files to get their paths, so we can't use
  // module_invoke_all().
  foreach (module_implements('fences_suggestion_info') as $module) {
    $function = $module . '_fences_suggestion_info';
    if (function_exists($function)) {
      $result = $function();
      if (isset($result) && is_array($result)) {
        // Search the module for template files.
        $files[$module] = drupal_system_listing('/\-\-fences\-.*\.tpl\.php$/', drupal_get_path('module', $module), 'name', 0);
        // Go through each of the results of hook_fences_suggestion_info().
        foreach (array_keys($result) as $hook) {
          foreach (array_keys($result[$hook]) as $suggestion) {
            $template = str_replace('_', '-', $hook . '--fences-' . $suggestion) . '.tpl';
            // Only record the suggestion if a corresponding template file is found.
            if (isset($files[$module][$template])) {
              $fences[$hook][$suggestion] = $result[$hook][$suggestion];
              // We need the path and project type for hook_theme().
              $fences[$hook][$suggestion]['path'] = dirname($files[$module][$template]->uri);
              $fences[$hook][$suggestion]['type'] = 'module';
              // Record if there is a "multiple-" version of the template.
              $template = str_replace('_', '-', $hook . '--fences-' . $suggestion . '-multiple') . '.tpl';
              $fences[$hook][$suggestion]['multiple'] = isset($files[$module][$template]) ? TRUE : FALSE;
            }
          }
        }
      }
    }
  }

  // Create a list of the default theme and its base themes.
  $theme_default = $GLOBALS['conf']['theme_default'];
  // We can't use list_themes() here because of #761608.
  $theme_data = _system_rebuild_theme_data();
  if (isset($theme_data[$theme_default]->base_themes)) {
    foreach (array_keys($theme_data[$theme_default]->base_themes) as $base_theme) {
      $themes[$base_theme] = 'base_theme_engine';
    }
  }
  $themes[$theme_default] = 'theme_engine';
  // Include the template.php files of the entire theme stack.
  foreach (array_keys($themes) as $theme) {
    $file = './' . drupal_get_path('theme', $theme) . '/template.php';
    if (file_exists($file)) {
      include_once $file;
    }
  }

  // Call hook_fences_suggestion_info for themes.
  foreach ($themes as $theme => $type) {
    // Search the theme for template files.
    $files[$theme] = drupal_system_listing('/\-\-fences\-.*\.tpl\.php$/', drupal_get_path('theme', $theme), 'name', 0);
    $function = $theme . '_fences_suggestion_info';
    if (function_exists($function)) {
      $result = $function();
      if (isset($result) && is_array($result)) {
        // Go through each of the results of hook_fences_suggestion_info().
        foreach (array_keys($result) as $hook) {
          foreach (array_keys($result[$hook]) as $suggestion) {
            $template = str_replace('_', '-', $hook . '--fences-' . $suggestion) . '.tpl';
            // Only record the suggestion if a corresponding template file is found.
            if (isset($files[$theme][$template])) {
              $fences[$hook][$suggestion] = $result[$hook][$suggestion];
              // We need the project type in hook_theme().
              $fences[$hook][$suggestion]['type'] = $type;
            }
          }
        }
      }
    }
    // If hook_fences_suggestion_info() doesn't exist for the theme, do a
    // "lazy" hook implementation by parsing the file names of matching
    // template files.
    else {
      foreach ($files[$theme] as $template => $data) {
        list($hook, $suggestion) = explode('--', $template);
        $suggestion = str_replace(array('fences-', '-multiple', '.tpl'), '', $suggestion);
        if (!isset($fences[$hook][$suggestion])) {
          $fences[$hook][$suggestion] = array(
            'label'       => $suggestion,
            'element'     => $suggestion,
            'description' => t('A <@tag> tag', array('@tag' => $suggestion)),
            'groups'      => array(t('Provided by @theme_name', array('@theme_name', $theme))),
            'type'        => $type,
          );
        }
      }
    }
  }

  // Allow modules and themes to alter the fences info.
  drupal_alter('fences_suggestion_info', $fences);

  foreach (array_keys($fences) as $hook) {
    ksort($fences[$hook]);
  }
}
