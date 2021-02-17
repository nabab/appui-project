<?php
use bbn\X;

$list = [];
if (empty($ctrl->arguments) || ($ctrl->arguments[0] === 'list')) {
    // We define ide array in session
  if (!$ctrl->inc->session->has('projects')) {
    $ctrl->inc->session->set(
      [
      'list' => $list
      ], 'projects'
    );
  }

  $ctrl->obj->url    = APPUI_PROJECT_ROOT.'router/list';
  $ctrl->obj->bcolor = '#017a8a';
  $ctrl->obj->fcolor = '#FFF';
  $ctrl->obj->icon   = "nf nf-fa-cogs";

  $ctrl->combo(_('Projects') ,true);
}
elseif ($ctrl->hasArguments(2)
    && ($ide = $ctrl->pluginUrl('appui-ide'))
    && (strpos(X::join(array_slice($ctrl->arguments, 1), '/'), $ide) === 0)
) {
  $current = $ctrl->pluginUrl('appui-project');
  $args    = $ctrl->arguments;
  $project = array_shift($args);
  // We remove the plugin from args
  $args = X::split(substr(X::join($args, '/'), strlen($ide) + 1), '/');
  $ctrl->addInc(
    'ide', new bbn\Appui\Ide(
      $ctrl->db,
      $ctrl->inc->options,
      $ctrl->getRoutes(),
      $ctrl->inc->pref,
      $project,
      'appui-project'
    )
  );
  //die(var_dump(X::join($args, '/')));


  if (empty($ctrl->baseURL)) {
    // for actions or history
    $ctrl->reroute(
      $ctrl->pluginUrl('appui-ide').'/'.($args[0] === 'editor' ? 'editor' : implode('/', $args)),
      $ctrl->post,
      $args[0] === 'editor' ? array_slice($args, 1) : []
    );
  }
  else{
    if (end($args) === 'content') {
      //array_unshift($args, 'editor');
    }

    $ctrl->reroute(
      $ctrl->pluginUrl('appui-ide').'/'.X::join($args, '/'),
      $ctrl->post
    );
  }
}
