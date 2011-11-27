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

        <?php echo $sf_content; ?>

      <footer>
        <p>&copy; Devvert.nl 2011</p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
