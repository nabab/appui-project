<?php

use bbn\X;
use bbn\Str;
/** @var $ctrl \bbn\Mvc\Controller */

/** @todo temporary hard coded $id_project */
if (!$ctrl->hasArguments()) {
  if (!defined('BBN_PROJECT')) {
    throw new Exception(_("Impossible to find the ID project"));
  }
  $id_project = BBN_PROJECT;
}
else {
  if (!Str::isUid($ctrl->arguments[0])) {
    $id_project = $ctrl->inc->options->fromCode(BBN_APP_NAME, "list", "project", "appui");
  }
  else {
    $id_project = $ctrl->arguments[0];
  }
}

// the request is coming straight from the internal router
if (defined('BBN_BASEURL') && !empty(BBN_BASEURL)) {
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
      $ctrl->addToObj($ctrl->pluginUrl('appui-ide') . "/editor".$full_url, [
        "arguments" => $ctrl->arguments,
        "id_project" => $id_project,
        "url" => X::join($ctrl->arguments, '/'),
        "baseURL" => BBN_BASEURL
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
// from the root router, showing the whole UI
elseif ($ctrl->hasArguments()) {
  $ctrl->setUrl($ctrl->pluginUrl('appui-project') . "/ui/$id_project")
    ->addData(['id_project' => $id_project])
    ->combo("Project IDE", true);
}