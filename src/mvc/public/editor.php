<?php
/*
$list =[];

if ( !$ctrl->inc->session->has('project') ){
  $ctrl->inc->session->set([
    'list' => $list
  ], 'ide');
}

if ( count($ctrl->arguments) > 2 ){
  $path = $ctrl->arguments;
  $project = array_shift($path);
  $path = implode('/', $path);
  $ctrl->reroute(APPUI_PROJECTS_ROOT.$path, ['project' => $project], $ctrl->arguments);
}
else{
  $ctrl->obj->url = APPUI_PROJECTS_ROOT.'router/'.$ctrl->arguments[0].'/editor';
  $ctrl->obj->bcolor = 'blue';
  $ctrl->obj->fcolor = '#FFF';
  $ctrl->obj->icon = "nf nf-fa-code";

  $data = $ctrl->getModel($ctrl->pluginUrl('appui-ide').'/editor',[
    'routes' => $ctrl->getRoutes(),
    'project' => $ctrl->arguments[0]
  ]);

  $ctrl->obj->data = array_merge($data, ['project' => $ctrl->arguments[0]]);

  $title ='I.D.E'. ' ('.$ctrl->arguments[0].')';
  echo $ctrl
      ->setTitle($title)
      ->addJs($ctrl->obj)
      ->getView();
}



//$ctrl->combo($title,$ctrl->obj);
*/