<?php slot('page_title', $resource->name); ?>
<?php slot('page_sub_title', $project->name); ?>

<?php echo dv_bootstrap_breadcrumbs(array(
                                         array('route' => 'homepage', 'text' => 'Home'),
                                         array('route' => 'project_index', 'text' => 'Projects'),
                                         array('route' => 'project', 'route_params' => $project, 'text' => $project->name),
                                         array('route' => 'resource', 'route_params' => $resource, 'text' => $resource->name)
                                    )); ?>

<?php if ($resource->Lines->count() == 0): ?>
<div class="alert-message block-message warning">
    <a class="close" href="#">×</a>

    <p>
        <strong><?php echo __('No lines found!'); ?></strong> <?php echo __('This resource has no lines yet. Please upload a resource first.'); ?>
    </p>

    <div class="alert-actions">
        <a href="<?php echo url_for('resource_update', $resource); ?>"
           class="btn small"><?php echo __('Upload resource'); ?></a>
    </div>
</div>
<?php endif; ?>

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
    <?php foreach ($project->Languages as $language): ?>
    <tr>
        <td>
            <?php if ($language->hasIcon()) echo image_tag($language->getIconUrl()); ?>
            <?php echo link_to_if($resource->Lines->count() > 0, $language->name, 'resource_translate', array('sf_subject' => $resource, 'lang' => $language->lang)); ?>
        </td>
        <td><?php echo $resource->getTranslatedLineCount($language); ?></td>
        <td><?php echo round($resource->getPercentageComplete($language)); ?>%</td>
        <?php if ($resource->Lines->count() > 0): ?>
        <td><a href="<?php echo url_for('resource_download', array('sf_subject' => $resource, 'lang' => $language->lang)); ?>" class="btn"><img src="/images/icons/drive-download.png"> <?php echo __('Download'); ?></a></td>
        <?php else: ?>
        <td><a href="#" class="btn disabled"><img src="/images/icons/drive-download.png"> <?php echo __('Download'); ?></a></td>
        <?php endif; ?>
    </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<h3><?php echo __('Manage Resource'); ?></h3>
<ul>
    <li><a href="<?php echo url_for('resource_update', $resource); ?>" class="btn"><img
            src="/images/icons/drive-upload.png"><?php echo __('Update resource'); ?></a></li>
</ul>
