<!DOCTYPE html>
<html>
<head>
    <title><?=$site_title;?></title>
        <link rel="shortcut icon" href="<?=base_url();?>public/images/logo-only-icon.png"/>

        <link href="<?=base_url('public/assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
        <link href="<?=base_url('public/assets/bootstrap');?>/css/font-awesome.css" rel="stylesheet">
        <link href="<?=base_url('public/assets/plugin/bootstrap-tagsinput/dist/bootstrap-tagsinput.css');?>" rel="stylesheet">


        <?php // add css files
        $this->minify->css(array('admin.css','anime.css'));
        echo $this->minify->deploy_css(false,'admin.style.css');
        ?>
        <script src="<?=base_url('public/assets/js/jquery-1.11.0.min.js')?>" type="text/javascript"></script>
        <script src="<?=base_url('public/assets/bootstrap/js/bootstrap.min.js')?>" type="text/javascript"></script>
        <script src="<?=base_url('public/assets/plugin/bootstrap-tagsinput/dist/bootstrap-tagsinput.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('public/assets/js/notify/dist/notify.js');?>" type="text/javascript"></script>
</head>
<body>
<div class="col-md-12">
	<div class="notify pull-right"><div class="notification">notification</div></div>
</div>
<header>
    <div class="wrapper menu-header">
     <?php require_once 'common/admin_menu.php'; ?>
     </div>
</header>
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row  main">
              <div class="wrapper admin-wrapper create">
                <div class="col-md-12"><span class="show-notify pull-right"></span></div>

                <div class="col-md-12" style="padding:1px;">
                  
              
            <?php echo $body; ?>

                </div>


            </div>

             

            </div>

        </div>
        </div>

    </div>

    
</body>
</html>