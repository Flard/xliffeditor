<?php slot('page_title', $resource->name); ?>
<?php slot('page_sub_title', $project->name); ?>

<?php slot('breadcrumbs'); ?>
<?php echo dv_bootstrap_breadcrumbs(array(
   array('route' => 'homepage', 'text' => 'Home'),
   array('route' => 'project_index', 'text' => 'Projects'),
   array('route' => 'project', 'route_params' => $project, 'text' => $project->name),
   array('route' => 'resource', 'route_params' => $resource, 'text' => $resource->name),
   array('route' => 'resource_translate', 'route_params' => array('sf_subject' => $resource, 'lang' => $langCode), 'text' => $language->name)
   )); ?>
<?php end_slot(); ?>

<form method="POST">
  <?php echo $form; ?>
  <div class="actions">
    <button type="submit" class="btn primary"><?php echo __('Submit changes'); ?></button>
    <button type="reset" class="btn"><?php echo __('Cancel'); ?></button>
  </div>
</form>

<?php slot('sidebar'); ?>
<h3><?php echo __('Other languages'); ?></h3>
<ul class="unstyled">
<?php foreach($project->Languages as $language): ?>
  <li>
    <a href="<?php echo url_for('resource_translate', array('sf_subject' => $resource, 'lang' => $language->lang)); ?>">
  <?php if ($language->hasIcon()): ?>
    <?php echo image_tag($language->getIconUrl(), array('class' => 'icon')); ?>
  <?php endif; ?>
    <?php echo $language->name; ?>
    </a>
  </li>
<?php endforeach; ?>
</ul>

<h3><?php echo __('Other resources'); ?></h3>
<ul class="unstyled">
<?php foreach($project->Resources as $resource): ?>
<li><?php echo link_to(icon_tag('box').$resource->name, 'resource_translate', array('sf_subject' => $resource, 'lang' => $langCode)); ?>
<?php endforeach; ?>
</ul>

<p><?php echo link_to(icon_tag('drive-download').__('Download %filename%', array('%filename%' => '<strong>'.$resource->getFilename().'</strong>')), 'resource_download', array('sf_subject' => $resource, 'lang' => 'nl'), array('class'=>'btn')); ?></p>
<?php end_slot(); ?>
