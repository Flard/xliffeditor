<?php slot('page_title', __('Projects')); ?>
<?php echo dv_bootstrap_breadcrumbs(array(
   array('route' => 'homepage', 'text' => __('Home')),
   array('route' => 'project_index', 'text' => __('Projects'))
   )); ?>

<div class="projectsList">
<?php foreach($projects as $project): ?>
<div class="project">
  <h2><?php echo link_to($project->name, 'project', $project); ?></h2>
  <p>
    <?php echo icon_tag('documents-stack'); ?> <?php echo format_number_choice('[0]No files|[1]1 File|(1,+Inf]%count% Files', array('%count%' => $project->getFileCount()), $project->getFileCount()); ?>
    <?php echo icon_tag('language'); ?> <?php echo format_number_choice('[0]No languages|[1]1 Language|(1,+Inf]%count% Languages', array('%count%' => $project->getLanguageCount()), $project->getLanguageCount()); ?>
    <?php echo icon_tag('tick'); ?> <?php echo __('%percentage%% done', array('%percentage%' => round($project->getPercentageComplete()))); ?>
  </p>
</div>
<?php endforeach; ?>
</div>

<?php if ($sf_user->hasCredential('CREATE_PROJECT')): ?>
<p><a href="#">Create project</a></p>
<?php endif; ?>
