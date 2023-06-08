<?php
/**
 * What is my purpose?
 *
 **/

use bbn\X;
use bbn\Str;
/** @var $model \bbn\Mvc\Model*/
if ($model->hasData('id_project', true)) {
  $project = new appui\Project($model->db, $model->data['id_project']);

  return [
    "project" => $project->getProjectInfo()
  ];
}
