<?php decorate_with('clean'); ?>

<!-- Main hero unit for a primary marketing message or call to action -->
<div class="hero-unit">
    <h1><?php echo __('Welcome'); ?></h1>

    <p><?php echo __('Manage the translations for your webapplication easily.'); ?></p>

    <p><a class="btn primary large">Learn more &raquo;</a></p>
</div>

<!-- Example row of columns -->
<div class="row">
    <div class="span6">
        <h2><?php echo __('About'); ?></h2>

        <p>Etiam porta sem malesuada magna mollis euismod. Integer posuere erat a ante venenatis dapibus posuere velit
            aliquet. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Duis mollis, est non
            commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>

        <p><a class="btn" href="#">View details &raquo;</a></p>
    </div>
    <div class="span5">
        <?php if (!$sf_user->isAuthenticated()): ?>
        <h2><?php echo __('Signin'); ?></h2>

        <?php include_component('sfGuardAuth', 'signin_form'); ?>
        <?php endif; ?>
    </div>
</div>