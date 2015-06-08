Fences (fences)
=======================

Fences is a an easy-to-use tool to specify an HTML element for each field. This 
element choice will propagate everywhere the field is used, such as teasers,  
RSS feeds and Views. You don't have to keep re-configuring the same HTML  
element over and over again every time you display the field.

Best of all, Fences provides leaner markup than Backdrop 1 core! And can get rid 
of the extraneous classes too!

This kind of tool is needed in order to create semantic HTML5 output from 
Backdrop. Without such a tool, you have to create custom field templates in your 
theme for every field. :(

Similar projects include Semantic fields, Field Wrappers and a tool inside the 
Display Suite extras. But we think this approach is Morefasterbetter™.

Installation
------------

- Download, install and enable the module.

- Visit admin/config/content/fences to configure the default markup and classes 
used on the site. For new sites, we highly recommend using all of the "override" 
options.

- Now when you create new fields, in the configuration for that field, you have 
a new option — to choose the markup for this field.

Now anytime you display that field in a node, or even in Views, Fences will alter 
the markup for the field to use the element you chose. If you would like to not 
let Views use the Fences markup, you can still use all the power of Views to 
alter it. But it will use Fences by default. :)

License
-------

This project is GPL v2 software. See the LICENSE.txt file in this directory for 
complete text.

Maintainers
-----------

- Bill Kelly (https://www.drupal.org/u/bkelly)

Originally written for Drupal by

- JohnAlbin (https://www.drupal.org/u/johnalbin)
- jensimmons (https://www.drupal.org/u/jensimmons)
- CrashTest_ (https://www.drupal.org/u/crashtest_)
- gleroux02 (https://www.drupal.org/u/gleroux02)
- n8tron (https://www.drupal.org/u/n8tron)
