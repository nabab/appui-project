<?php
/**
 * What is my purpose?
 *
 **/

use bbn\X;
use bbn\Str;
/** @var $model \bbn\Mvc\Model*/

$id_project = $model->inc->options->fromCode("dev-lucas", "list", "project", "appui");
$project = new luk\Project($model->db, $id_project);

return [
  "project" => $project->getProjectInfo()
];