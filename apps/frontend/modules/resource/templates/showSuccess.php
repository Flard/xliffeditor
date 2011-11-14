<?php slot('page_title', $resource->name); ?>
<?php slot('page_sub_title', $project->name); ?>

<?php echo dv_bootstrap_breadcrumbs(array(
   array('route' => 'homepage', 'text' => 'Home'),
   array('route' => 'project_index', 'text' => 'Projects'),
   array('route' => 'project', 'route_params' => $project, 'text' => $project->name),
   array('route' => 'resource', 'route_params' => $resource, 'text' => $resource->name)
   )); ?>

