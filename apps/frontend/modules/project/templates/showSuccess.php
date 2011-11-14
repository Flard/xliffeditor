<?php slot('page_title', $project->name); ?>
<?php slot('page_sub_title', __('Project Overview')); ?>

<?php echo dv_bootstrap_breadcrumbs(array(
   array('route' => 'homepage', 'text' => 'Home'),
   array('route' => 'project_index', 'text' => 'Projects'),
   array('route' => 'project', 'route_params' => $project, 'text' => $project->name)
   )); ?>

<h2><?php echo __('Resources'); ?></h2>
<table class="zebra-striped">
  <thead>
    <tr>
      <th><?php echo __('Name'); ?></th>
      <th><?php echo __('No. of Lines'); ?></th>
      <th><?php echo __('% Complete'); ?></th>
    </tr>
  </thead>
  <tbody>
<?php foreach($project->Resources as $resource): ?>
    <tr>
      <td><?php echo link_to($resource->name, 'resource', $resource); ?></td>
      <td><?php echo $resource->getTotalLineCount(); ?></td>
      <td><?php echo $resource->getPercentagecomplete(); ?>%</td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
