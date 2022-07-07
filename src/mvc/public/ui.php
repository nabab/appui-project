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
  switch ($page) {
    case "ide":
      $ctrl->addToObj("newide/editor".($ctrl->hasArguments() ? '/'.X::join($ctrl->arguments, '/') : ''), [
        "arguments" => $ctrl->arguments,
        "id_project" => $id_project
      ]);
      $ctrl->setUrl("project/ui/$id_project/".(empty($ctrl->arguments) ? "" : "/".X::join($ctrl->arguments, "/")));
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
