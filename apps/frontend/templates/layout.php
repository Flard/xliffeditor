<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <?php include_partial('global/topbar'); ?>
    <div class="container">

      <div class="content">
        <div class="page-header">
          <h1>
		<?php include_slot('page_title', 'Page title'); ?>
                <?php if (has_slot('page_sub_title')): ?>
                <small><?php include_slot('page_sub_title'); ?></small>
                <?php endif; ?>
          </h1>
        </div>
        <div class="row">
          <div class="span10">
            <?php echo $sf_content; ?>
          </div>
          <div class="span4">
            <h3>Secondary content</h3>
            <?php include_slot('sidebar'); ?>
          </div>
        </div>
      </div>

      <footer>
        <p>&copy; Company 2011</p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
