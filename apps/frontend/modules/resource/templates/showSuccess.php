<?php slot('page_title', $resource->name); ?>
<?php slot('page_sub_title', $project->name); ?>

<?php echo dv_bootstrap_breadcrumbs(array(
   array('route' => 'homepage', 'text' => 'Home'),
   array('route' => 'project_index', 'text' => 'Projects'),
   array('route' => 'project', 'route_params' => $project, 'text' => $project->name),
   array('route' => 'resource', 'route_params' => $resource, 'text' => $resource->name)
   )); ?>

<h3><?php echo __('Languages'); ?></h3>
<table>
  <thead>
    <tr>
      <th><?php echo __('Language'); ?></th>
      <th><?php echo __('No. Lines Translated'); ?></th>
      <th><?php echo __('% Complete'); ?></th>
      <th><?php echo __('Options'); ?></th>
    </tr>
  <tbody>
<?php foreach($project->Languages as $language): ?>
    <tr>
      <td>
        <?php if ($language->hasIcon()) echo image_tag($language->getIconUrl()); ?>
	<?php echo link_to($language->name, 'resource_translate', array('sf_subject' => $resource, 'lang' => $language->lang)); ?>
      </td>
      <td>0</td>
      <td>0</td>
      <td><a href="#" class="btn"><img src="/images/icons/drive-download.png"> <?php echo __('Download'); ?></a></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>


<h3><?php echo __('Manage Resource'); ?></h3>
<ul>
   <li><a href="#" class="btn"><img src="/images/icons/drive-upload.png"><?php echo __('Upload updated resource'); ?></a></li>
</ul>
