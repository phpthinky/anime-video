<?php

error_reporting(0); //Setting this to E_ALL showed that that cause of not redirecting were few blank lines added in some php files.

$config_file = '../config.ini.php';
$template_file = '../config.ini.template.php';

include 'core.ini.php';

$core = new core();
if($_POST){
        $database = $core->database($_POST);
        $system = $core->system($_POST,$template_file,$config_file);
      if($database == false){

        $message = "<p class='alert alert-warning'>Make sure your database information is correct.</p>";

      }elseif ($system == false) {
          $message = "<p class='alert alert-warning'>Please make the application/config/database.php file writable. <strong>Example</strong>:<br /><br /><code>chmod 777 application/config/database.php</code></p>";
      }else{

        $message = 'Processing...';
        header( "refresh:10;url=../index.php" );
      }

}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Install | COLOFTECH</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

  <meta property="og:url"           content="../index.php" />
  <meta property="og:type"          content="article" />
  <meta property="og:locale"          content="en_US" />
  <meta property="og:title"         content="Coloftech State of the Arts & technology" />
  <meta property="og:description"   content="Coloftech State of the Arts & Tecnology is a PHP code and tutorials blog passionately published by Roy Rita.  PHP, jQuery, MySql, Ajax, CodeIgniter framework are the main technologies in focus here. You can find code to make your web application better. Code present here are simple and easy to use with suitable examples and free source downloads. Welcome!" />
  <meta property="og:image"         content="../public/images/logo-only.png" />
  <meta property="fb:page_id" content="908155116011125" />
<meta name="author" content="Harold Rita" />
<meta name="keywords" content="coloftech, harold rita, bisu bilar, bohol island state university, thesis hub, research study compilation system and monitoring system.coloftech project  " />

<meta name="propeller" content="6db29e64f9cb4b5e95f5e9b6bd5fd21b" />


        <link href="../public/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../public/assets/bootstrap/css/font-awesome.css" rel="stylesheet">
        <link href="../public/assets/css/animate.css" rel="stylesheet">

        <link rel="icon" type="image/png" href="../favicon.png">
       

        <link href="../public/assets/styles.min.css" rel="stylesheet" type="text/css" />

    <style type="text/css">
    </style>
       

</head>
<body class="site">
<header class="wrapper" >
    <div class="container" >
        

        <div class="logo"><a href="../index.php"><img src="../public/images/logo-only.png"></div></a>
        <div class="title"><a href="../index.php"><h1 style="display:inline-block;color:#fff;"><span style='margin-top:-22px;position:absolute;font-size:1em;'>Coloftech <span style='font-size:10px;display: block;'>State of the Arts &amp; Technology</span></span></h1></a></div>
    </div>
    <div class="container">
   </div>
</header>

<div class="site-body" >
    <div class="wrapper site-wrapper">
	<div class="container site-container">

<div class="col-md-12 post-index">
	
<div class="col-md-9">

<div class="col-md-6">
  
    <center><h1>Install</h1></center>
    <?php if(is_writable($config_file)){?>

      <?php if(isset($message)) {echo '<p class="error">' . $message . '</p>';}?>

      <form id="install_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset>
          
          <div class="row">
          <legend>Database settings</legend>
          <br />
              <div class="form-group">
                
                <label for="hostname">Hostname</label><input type="text" id="hostname" value="localhost" class="form-control" name="hostname" required/>
              </div>
              <div class="form-group">
                  <label for="username">Username</label><input type="text" id="username" class="form-control" name="username" value="root" required/>
              </div>
              <div class="form-group">
                <label for="password">Password</label><input type="password" id="password" class="form-control" name="password" value="" />
            </div>
              <div class="form-group">
                <label for="database">Database Name</label><input type="text" id="database" class="form-control" name="database" value="test2" required/>
            </div>
        </div>

        <div class="row hidden">
          <br />
          <br />
          <legend>System settings</legend>
          <br />
              <div class="form-group">
              <label for="hostname">application path</label><input type="text" id="application" value="application" class="form-control" name="application" />
              </div>
              <div class="form-group">
                  <label for="username">system path</label><input type="text" id="system" value="system" class="form-control" name="system" />
              </div>
              <div class="form-group">
                <label for="password">upload path</label><input type="text" id="uploadpath" class="form-control" name="uploadpath"  value="public" />
            </div>

        </div>

        <div class="row">
          <br />

            <div class="form-group">
              <input type="submit" value="Install" id="submit"  class="btn btn-info" />
            </div>
        </div>
          </div>

        </fieldset>
      </form>

    <?php } else { ?>
      <p class="error">Please make the config.ini.php file writable. <strong>Example</strong>:<br /><br /><code>chmod 777 config.ini.php</code></p>
    <?php } ?>


</div>
</div>
<div class="col-md-3 side-bar">


</div>
</div>
	</div>
</div>

</div>


 <!-- CORE PLUGINS -->
        <script src="../public/assets/js/jquery-1.11.0.min.js" type="text/javascript"></script>
        <script src="../public/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    
</body>
</html>
