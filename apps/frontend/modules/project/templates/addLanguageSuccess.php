<?php slot('page_title', __('Add Language')); ?>
<?php slot('page_sub_title', $project->name); ?>

<?php echo dv_bootstrap_breadcrumbs(array(
                                         array('route' => 'homepage', 'text' => __('Home')),
                                         array('route' => 'project_index', 'text' => __('Projects')),
                                         array('route' => 'project', 'route_params' => $project, 'text' => $project->name),
                                         array('route' => 'language_add', 'route_params' => $project, 'text' => __('Add Language'))
                                    )); ?>

<form method="POST" action="<?php echo url_for('language_add', $project); ?>">
<?php echo $form; ?>
<div class="actions">
    <input type="submit" class="btn primary" value="<?php echo __('Submit changes'); ?>"/>
    <input type="reset" class="btn" value="<?php echo __('Cancel changes'); ?>"/>
</div>
</form>
