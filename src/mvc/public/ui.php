<?php

use bbn\X;
use bbn\Str;
/** @var $ctrl \bbn\Mvc\Controller */

/** @todo temporary hard coded $id_project */
$id_project = $ctrl->hasArguments() ? $ctrl->arguments[0] : $ctrl->inc->options->fromCode(BBN_APP_NAME, "list", "project", "appui");

// the request is coming straight from the root router, showing the whole UI
if (empty($ctrl->baseURL)) {
  $ctrl->setUrl("project/ui/$id_project")
    ->combo("Project IDE", true);
}
// from internal router
elseif ($ctrl->hasArguments()) {
  //array_unshift($ctrl->arguments, $id_project);
  /** @var string ide/database/finder */
  $page = array_shift($ctrl->arguments);
  if ($page === $id_project) {
    $page = array_shift($ctrl->arguments);
  }
  $url = $ctrl->pluginUrl('appui-project')."/ui/$id_project";
  switch ($page) {
    case "ide":
      $url.='/ide';
      $full_url = $ctrl->hasArguments() ? '/'.X::join($ctrl->arguments, '/') : '';
			$hasFile = false;
      if ($ctrl->arguments[0] === 'file') {
        $hasFile = true;
        array_shift($ctrl->arguments);
      }
      $ctrl->addToObj("newide/editor".$full_url, [
        "arguments" => $ctrl->arguments,
        "id_project" => $id_project,
        "url" => X::join($ctrl->arguments, '/'),
        "baseURL" => $ctrl->baseURL
      ]);
      if ($ctrl->obj->url) {
        $ctrl->setUrl($url.'/'.($hasFile ? 'file/' : '').$ctrl->obj->url);
      }
      break;
    case "database":
      $database = $ctrl->inc->options->fromCode("db", $id_project);
      $databases = $ctrl->inc->options->fullOptions($database);
      $ctrl->addToObj("project_ide/db", [
        "arguments" => $ctrl->arguments,
        "id_project" => $id_project,
        "databases" => $databases
      ], true);
      $ctrl->setUrl("project_ide/$id_project/database".(empty($ctrl->arguments) ? "" : "/".X::join($ctrl->arguments, "/")));
      $ctrl->setTitle(_("Databases"));
      break;
    case "finder":
      $ctrl->addToObj($ctrl->pluginUrl("appui-ide")."/finder".(empty($ctrl->arguments) ? "" : "/".X::join($ctrl->arguments, "/")));
      $ctrl->setUrl("project_ide/$id_project/finder".(empty($ctrl->arguments) ? "" : "/".X::join($ctrl->arguments, "/")));
      $ctrl->setTitle(_("Finder"));
      break;
  }
}
