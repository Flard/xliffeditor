<?php slot('page_title', $resource->name); ?>
<?php slot('page_sub_title', $project->name); ?>

<?php echo dv_bootstrap_breadcrumbs(array(
   array('route' => 'homepage', 'text' => __('Home')),
   array('route' => 'project_index', 'text' => __('Projects')),
   array('route' => 'project', 'route_params' => $project, 'text' => $project->name),
   array('route' => 'resource', 'route_params' => $resource, 'text' => $resource->name),
   array('route' => 'resource_update', 'route_params' => $resource, 'text' => __('Update Resource'))
   )); ?>

<?php echo form_tag_for($form, '@resource'); ?>
<?php echo $form; ?>
  <div class="action">
    <input type="submit" class="btn primary" value="<?php echo __('Update'); ?>" />
    <input type="reset" class="btn" value="<?php echo __('Cancel changes'); ?>" />
  </div>
</form>
