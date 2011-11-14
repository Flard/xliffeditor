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
<?php if (count($project->Resources) > 0): ?>
<?php foreach($project->Resources as $resource): ?>
    <tr>
      <td><?php echo link_to(icon_tag('box').$resource->name, 'resource', $resource); ?></td>
      <td><?php echo $resource->getTotalLineCount(); ?></td>
      <td><?php echo $resource->getPercentagecomplete(); ?>%</td>
    </tr>
<?php endforeach; ?>
<?php else: ?>
    <tr>
      <td colspan="3"><?php echo __('No resources found. %upload_link%.', array('%upload_link%' => link_to(__('Add new resource'), 'resource_add', $project))); ?></td>
    </tr>
<?php endif; ?>
  </tbody>
</table>

<div class="actions">
  <?php echo link_to(icon_tag('box--plus').' '.__('Add new resource'), 'resource_add', $project, array('class' => 'btn')); ?>
  <?php echo link_to(icon_tag('cross').' '.__('Delete'), 'homepage', array(), array('class' => 'btn danger')); ?>
</div>
