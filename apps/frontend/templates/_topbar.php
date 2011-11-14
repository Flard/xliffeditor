<div class="topbar">
    <div class="fill">
        <div class="container">
            <?php echo link_to(sfConfig::get('app_title'), 'homepage', array(), array('class' => 'brand')); ?>
            <ul class="nav">
                <li class="active"><a href="#"><?php echo __('Home'); ?></a></li>
                <li><a href="#about"><?php echo __('About'); ?></a></li>
                <li><a href="#contact"><?php echo __('Contact'); ?></a></li>
            </ul>
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
