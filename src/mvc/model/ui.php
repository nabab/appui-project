<?php
/**
 * What is my purpose?
 *
 **/

use bbn\Appui\Project;
/** @var $model \bbn\Mvc\Model*/
if ($model->hasData('id_project', true)) {
  $project = new Project($model->db, $model->data['id_project']);

  return [
    "project" => $project->getProjectInfo()
  ];
}
