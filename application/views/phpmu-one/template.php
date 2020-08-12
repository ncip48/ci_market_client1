<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="phpmu.com">
    <meta name="description" content="<?php echo $iden['meta_deskripsi']; ?>">
    <meta name="keywords" content="<?php echo $iden['meta_keyword']; ?>">
    <meta name="robots" content="all,index,follow">
    <meta http-equiv="Content-Language" content="id-ID">
    <meta NAME="Distribution" CONTENT="Global">
    <meta NAME="Rating" CONTENT="General">
    <link rel="canonical" href="<?php echo "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"/>
    <meta property="og:locale" content="id_ID" />
    <meta property="og:title" content="<?php echo $title; ?>" />
    <meta property="og:description" content="<?php echo $iden['meta_deskripsi']; ?>" />
    <meta property="og:url" content="<?php echo "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" />
    <meta property="og:site_name" content="<?php echo $iden['nama_website']; ?>" />

    <link rel="icon" type="image/x-icon" href="https://members.phpmu.com/asset/favicon.ico" />
    <link href="<?php echo base_url(); ?>asset/themes/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/themes/css/nprogress.css">
    <link href="<?php echo base_url(); ?>asset/themes/remixicon/remixicon.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/themes/css/prettyPhoto.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/themes/css/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/themes/css/revslider.css">
    <link href="<?php echo base_url(); ?>asset/themes/css/main.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/themes/css/responsive.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/themes/js/jquery-3.4.1.min.js"></script>
  </head>

  <body>
    <div class='root'>
    <?php include 'header.php' ?>
    <?php echo $contents; ?>
    
    <?php include 'footer.php' ?>

    <?php $this->model_main->kunjungan(); ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"></script>
    <script src="<?php echo base_url(); ?>asset/themes/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/themes/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/themes/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/themes/js/jquery.blockUI.js"></script>
    <script src="<?php echo base_url(); ?>asset/themes/js/nprogress.js"></script>
    <script src="<?php echo base_url(); ?>asset/themes/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/themes/js/isotope.pkgd.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/themes/js/ajax-form.js"></script>
    <script src="<?php echo base_url(); ?>asset/themes/js/jquery.counterup.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/themes/js/imagesloaded.pkgd.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/themes/js/scrollIt.js"></script>
    <script src="<?php echo base_url(); ?>asset/themes/js/jquery.scrollUp.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/themes/js/wow.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/themes/js/nice-select.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/themes/js/jquery.slicknav.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/themes/js/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/themes/js/plugins.js"></script>
    <script src="<?php echo base_url(); ?>asset/themes/js/gijgo.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/themes/js/main.js"></script>
    </div>
    <script src="<?php echo base_url(); ?>asset/themes/js/app.js"></script>
    <?php include "modal.php"; ?>
  </body>
</html>
