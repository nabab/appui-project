<?php
$list_projects = [];
$num_path = [];
$paths = ['app','cdn', 'lib'];
if ( !empty($model->inc->options) ){
  $projects =  $model->inc->options->fullOptions($model->inc->options->fromCode('list', 'project', 'appui'));
  if ( !empty($projects) && count($projects) ){
    foreach ( $projects as $i => $project){
      if ( $project['code'] !== 'assets' ){
        $num = 0;
        foreach( $paths as $path ){
  				$opt = $model->inc->options->option($model->inc->options->fromCode($path, 'path', $project['id']));
          $num += $opt['num_children'];
          $num_path[$path] = !empty($opt['num_children']) ? $opt['num_children'] : 0;
  			}
        $list_projects[] = array_merge([
          'project' => $project['code'],
          'repositories' => $num
        ], $num_path);
      } 
    }
  }
}

return [
  'data' => $list_projects,
  'total' => count($list_projects)
];