<?php
/** @var $ctrl \bbn\mvc\controller */
if ( !$ctrl->inc->user->is_dev() ){
  die("You aren't an admin user.");
}
if ( !isset($ctrl->inc->pref) ){
  die("Preferences must be set up for the PROJECT module to load.");
}
if ( !\defined('APPUI_PROJECT_ROOT') ){
  define('APPUI_PROJECT_ROOT', $ctrl->plugin_url('appui-project').'/');
}

$ctrl->data['shared_path'] = BBN_SHARED_PATH;

$ctrl->add_inc('fs',  new \bbn\file\system());



return 1;