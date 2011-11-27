<div class="topbar">
    <div class="fill">
        <div class="container">
            <?php echo link_to(sfConfig::get('app_title'), 'homepage', array(), array('class' => 'brand')); ?>
            <?php if ($sf_user->isAuthenticated()): ?>
            <ul class="nav">
                <li data-dropdown="dropdown">
                    <a href="<?php echo url_for('project_index'); ?>" class="dropdown-toggle"><?php echo __('Projects'); ?></a>
                    <?php include_component('sfGuardAuth', 'topBarProjects'); ?>
                </li>

                        <?php
                            $items = array();
                            if ($sf_user->hasPermission('PROJECT_ADMIN')) $items[] = link_to(__('Projects'), 'project_admin');
                            if ($sf_user->hasPermission('USER_ADMIN')) $items[] = link_to(__('Users'), 'sf_guard_user');
                            if ($sf_user->hasPermission('GROUP_ADMIN')) $items[] = link_to(__('Groups'), 'sf_guard_group');
                            if ($sf_user->hasPermission('PERMISSION_ADMIN')) $items[] = link_to(__('Permissions'), 'sf_guard_permission');
                            if ($sf_user->hasPermission('API_ADMIN')) $items[] = link_to(__('API'), 'api_admin');
                            if (count($items) > 0):
                        ?>
                                <li data-dropdown="dropdown">
                                    <a href="#" class="dropdown-toggle"><?php echo __('Manage'); ?></a>
                                    <ul class="dropdown-menu">

                                <?php echo '<li>'.implode('</li><li>', $items).'</li>'; ?>
                                    </ul>
                                </li>

                            <?php endif; ?>
            </ul>
            <?php endif; ?>
            <?php

            if (!$sf_user->isAuthenticated()) {
                include_component('sfGuardAuth', 'topBarSignin');
            } else {
                include_component('sfGuardAuth', 'topBarProfile');
            }
            ?>

        </div>
    </div>
</div>
