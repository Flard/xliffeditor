<form method="POST" action="<?php echo url_for('sf_guard_signin'); ?>">
    <?php echo $form->renderUsing('Bootstrap'); ?>
    <div class="actions">
        <input type="submit" class="btn primary" value="Inloggen">&nbsp;
        <button type="reset" class="btn">Annuleren</button>
    </div>
</form>