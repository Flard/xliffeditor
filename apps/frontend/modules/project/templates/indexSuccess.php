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
    10 Files
    2 Languages
    3 70% done
  </p>
</div>
<?php endforeach; ?>
</div>

<?php if ($sf_user->hasCredential('CREATE_PROJECT')): ?>
<p><a href="#">Create project</a></p>
<?php endif; ?>
