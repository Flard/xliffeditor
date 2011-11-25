<?php slot('page_title', __('Projects')); ?>
<?php echo dv_bootstrap_breadcrumbs(array(
   array('route' => 'homepage', 'text' => 'Home'),
   array('route' => 'project_index', 'text' => 'Projects')
   )); ?>

<div class="projectsList">
<?php foreach($projects as $project): ?>
<div class="project">
  <h2><?php echo link_to($project->name, 'project', $project); ?></h2>
  <p>
    <?php echo icon_tag('documents-stack'); ?> <?php echo $project->getFileCount(); ?> Files
    <?php echo icon_tag('language'); ?> <?php echo $project->getLanguageCount(); ?> Languages
    <?php echo icon_tag('tick'); ?> <?php echo round($project->getPercentageComplete()); ?>% done
  </p>
</div>
<?php endforeach; ?>
</div>

<?php if ($sf_user->hasCredential('CREATE_PROJECT')): ?>
<p><a href="#">Create project</a></p>
<?php endif; ?>
