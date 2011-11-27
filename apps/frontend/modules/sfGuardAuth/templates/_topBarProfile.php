<ul class="nav secondary-nav">
    <li data-dropdown="dropdown">
        <a href="#" class="dropdown-toggle"><?php echo $sf_user->getUsername(); ?></a>
        <ul class="dropdown-menu">
            <li><?php echo link_to(__('Profile'), 'profile'); ?></li>
            <li class="divider"></li>
            <li><?php echo link_to(__('Signout'), 'sf_guard_signout'); ?></li>
        </ul>
    </li>
</ul>
