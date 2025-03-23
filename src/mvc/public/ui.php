<?php

use bbn\X;
use bbn\Str;
use bbn\Appui;
/** @var bbn\Mvc\Controller $ctrl */
/** @var bbn\Appui\Option $ctrl->inc->options */
/** @var bbn\User\Permissions $ctrl->inc->permissions */
/** @var bbn\User\Preferences $ctrl->inc->pref */

/** @var array $args */
$args = $ctrl->arguments;
if (!count($args)) {
  if (!defined('BBN_PROJECT')) {
    throw new Exception(_("Impossible to find the ID project"));
  }

  $id_project = constant('BBN_PROJECT');
  $args[] = 'home';
}
else {
  $id_project = Str::isUid($args[0]) ? 
      array_shift($args)
      : $ctrl->inc->options->fromCode(array_shift($args), "list", "project", "appui");
}

// the request is coming straight from the internal router
if (count($args) && defined('BBN_BASEURL') && constant('BBN_BASEURL')) {
  //array_unshift($ctrl->arguments, $id_project);
  /** @var string $page */
  $page = array_shift($args);
  if ($page === $id_project) {
    $page = array_shift($args);
  }

  $full_url = count($args) ? '/'.X::join($args, '/') : '';
  $url      = $ctrl->pluginUrl('appui-project')."/ui/$id_project";
  switch ($page) {
    case "ide":
      $url.='/ide';
      $hasFile = false;
      if ($args[0] === 'file') {
        $hasFile = true;
        array_shift($args);
      }

      $ctrl->addToObj($ctrl->pluginUrl('appui-ide') . "/editor" . $full_url, [
        "arguments" => $args,
        "id_project" => $id_project,
        "url" => X::join($args, '/'),
        "baseURL" => constant('BBN_BASEURL')
      ]);

      if (!empty($ctrl->obj->url)) {
        $ctrl->setUrl($url.'/'.($hasFile ? 'file/' : '').$ctrl->obj->url);
      }

      break;

    case "database":
      $url .= '/database';
      $engine = 'mysql';
      if (!isset($ctrl->inc->dbc)) {
        $ctrl->addInc('dbc', new bbn\Appui\Database($ctrl->db));
      }

      if (count($args) > 3) {
        if ($args[3] === 'home') {
          $ctrl->addToObj($ctrl->pluginUrl('appui-database').'/tabs/table/'.$engine.'/'.$args[0].'/'.$args[1].'/'.$args[2], [], true);
        }

        $ctrl->setUrl("$url/$args[0]/$args[1]/$args[2]/$args[3]");
      }
      elseif (count($args) > 2) {
        if ($args[2] === 'home') {
          $ctrl->addToObj($ctrl->pluginUrl('appui-database').'/tabs/db/'.$engine.'/'.$args[0].'/'.$args[1], [], true);
        }
        elseif ($args[2] === 'console') {
          $ctrl->addToObj($ctrl->pluginUrl('appui-database').'/console', [
            'engine' => $engine,
            'connection' => $args[0],
            'database' => $args[1]
          ], true);
        }

        $ctrl->setUrl("$url/$args[0]/$args[1]/$args[2]");
      }
      else {
        $ctrl->setUrl($url);
        $ctrl->setTitle(_("Databases"));
      }
    /*
      if (count($args) > 2) {
        if (!($row = X::getRow($databases, ['code' => $args[2]]))) {
          $ctrl->obj->error = _("The database does not exist");
        }
        elseif (!X::getRow($row['items'], ['code' => $args[1]])) {
          $ctrl->obj->error = _("The connection does not exist");
        }
        else {
          $ctrl->addToObj($ctrl->pluginUrl('appui-ide') . "/editor" . $full_url, [
            "engine" => $args[0],
            "host" => $args[1],
            "db" => $args[2],
            "baseURL" => constant('BBN_BASEURL')
          ]);
    
        }
      }
      else {
        $ctrl->addToObj('./ui/db', [
          "arguments" => $ctrl->arguments,
          "id_project" => $id_project,
          "databases" => $databases
        ], true);
      }
      $ctrl->setUrl("$url/database".(empty($ctrl->arguments) ? "" : "/".X::join($ctrl->arguments, "/")));
    */
      break;
    case "finder":
      $ctrl->addToObj($ctrl->pluginUrl("appui-ide")."/finder".(empty($ctrl->arguments) ? "" : "/".X::join($ctrl->arguments, "/")));
      $ctrl->setUrl("project_ide/$id_project/finder".(empty($ctrl->arguments) ? "" : "/".X::join($ctrl->arguments, "/")));
      $ctrl->setTitle(_("Finder"));
      break;
    case 'home':
      $ctrl->addToObj($ctrl->pluginUrl("appui-project")."/ui/home", ['id_project' => $id_project], true)
        ->setUrl("project_ide/$id_project/home")
        ->setTitle(_("Home"))
        ->setIcon('nf nf-fa-home');
      break;

  }
}
// from the root router, showing the whole UI
elseif ($ctrl->hasArguments()) {
  $ctrl->setUrl($ctrl->pluginUrl("appui-project") . "/ui/$id_project")
    ->addData(['id_project' => $id_project])
    ->setColor('teal', '#FFF')
    ->setIcon(Appui::getLogo())
    ->combo($ctrl->inc->options->text($id_project), true);
}