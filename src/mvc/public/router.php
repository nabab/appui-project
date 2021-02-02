<?php
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
elseif (!empty($ctrl->arguments)
    && ($ctrl->arguments[1] === 'ide')
) {
  $project = array_shift($ctrl->arguments);
  $ide     = array_shift($ctrl->arguments);
  $bu      = APPUI_PROJECT_ROOT.'router/'.$project.'/'.$ide.'/editor/';
  $ctrl->addInc(
    'ide', new \bbn\Appui\Ide(
      $ctrl->db,
      $ctrl->inc->options,
      $ctrl->getRoutes(),
      $ctrl->inc->pref,
      $project,
      'appui-project'
    )
  );

  if (empty($ctrl->baseURL) && (count($ctrl->arguments) > 1)) {
    // for actions or history
    $ctrl->reroute(
      $ctrl->pluginUrl('appui-ide') . '/'
          . ($ctrl->arguments[0] === 'editor' ? 'editor' : implode('/', $ctrl->arguments)),
      $ctrl->post
    );
  }
  else{
    $args = $ctrl->arguments;
    array_shift($args);
    array_shift($args);
    if (end($ctrl->arguments) === 'content') {
      array_unshift($ctrl->arguments, 'editor');
    }

    $ctrl->reroute(
      $ctrl->pluginUrl('appui-ide').'/'
          .implode('/', $ctrl->arguments),
      $ctrl->post,
      $args
    );
  }
}
