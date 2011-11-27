<ul class="dropdown-menu">
<?php foreach($projects as $project): ?>
    <li><?php echo link_to($project->name, 'project', $project); ?></li>
<?php endforeach; ?>
<?php if (count($projects) > 3): ?>
    <li class="divider"></li>
    <li><?php echo link_to(__('Project overview'), 'project_index'); ?></li>
<?php endif; ?>
</ul>