<?php slot('page_title', $resource->name); ?>
<?php slot('page_sub_title', $project->name); ?>

<?php echo dv_bootstrap_breadcrumbs(array(
   array('route' => 'homepage', 'text' => __('Home')),
   array('route' => 'project_index', 'text' => __('Projects')),
   array('route' => 'project', 'route_params' => $project, 'text' => $project->name),
   array('route' => 'resource', 'route_params' => $resource, 'text' => $resource->name),
   array('route' => 'resource_admin', 'route_params' => $resource, 'text' => __('Manage Resource'))
   )); ?>

<form method="POST" action="<?php echo url_for('resource_admin', $resource); ?>">
<?php echo $form; ?>
<div class="actions">
    <input type="submit" class="btn primary" value="<?php echo __('Submit changes'); ?>"/>
    <input type="reset" class="btn" value="<?php echo __('Cancel changes'); ?>"/>
</div>
</form>
