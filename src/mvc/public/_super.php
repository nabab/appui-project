<?php
/** @var $ctrl \bbn\Mvc\Controller */
if ( !$ctrl->inc->user->isDev() ){
  die("You aren't an admin user.");
}

if ( !isset($ctrl->inc->pref) ){
  die("Preferences must be set up for the PROJECT module to load.");
}

if ( !\defined('APPUI_PROJECT_ROOT') ){
  define('APPUI_PROJECT_ROOT', $ctrl->pluginUrl('appui-project').'/');
}

$ctrl->addData([
  'root' => APPUI_PROJECT_ROOT,
  'shared_path' => BBN_SHARED_PATH
]);

$ctrl->addInc('fs',  new \bbn\File\System());

return 1;
