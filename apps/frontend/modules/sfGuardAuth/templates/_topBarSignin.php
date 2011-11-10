<form action="<?php echo url_for('@sf_guard_signin') ?>" method="POST" class="pull-right">
    <?php echo $form->renderHiddenFields(); ?>
    <?php echo $form['username']->render(array('class' => 'input-small', 'placeholder' => __('Username', null, 'sf_guard'))); ?>
    <?php echo $form['password']->render(array('class' => 'input-small', 'placeholder' => __('Password', null, 'sf_guard'))); ?>
    <button class="btn" type="submit"><?php echo __('Signin', null, 'sf_guard'); ?></button>
</form>