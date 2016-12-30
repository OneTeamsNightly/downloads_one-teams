<?
ob_start('compressor');
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Europe/Istanbul');
$oneteam=1;
$brandDevices=json_decode(file_get_contents('data/devices.json'),true);
function sec($text)
{
	$text=preg_replace('/[^A-Za-z0-9\-_]/', '',filter_var($text,FILTER_SANITIZE_STRING));
	return $text;
}
function array_key_exists_r($needle, $haystack)
{
    $result = array_key_exists($needle, $haystack);
    if ($result) return $result;
    foreach ($haystack as $v) {
        if (is_array($v)) {
            $result = array_key_exists_r($needle, $v);
        }
        if ($result) return $result;
    }
    return $result;
}
$device=sec($_GET['device']);
$rom=sec($_GET['rom']);
$download=sec(base64_decode($_GET['download']));
$file=false;
if($device)
{
if($device=='main'){
	$file='main';
}elseif(array_key_exists_r($device, $brandDevices))
{
	$file='roms';
}
if($file && $rom)
{
	$file='roms_download';
}
if($file && $download)
{
	$file='OTA_Files/'.$device.'/'.$rom.'/'.$download.'.zip';
	if(file_exists($file))
	{
		header('Content-Type: application/octet-stream');
		header('Content-Transfer-Encoding: Binary');
		header('Content-disposition: attachment; filename="'.$download.'.zip"'); 
		echo readfile($file);
	}
	exit();
}
}
	if($file)
	{
		include('pages/'.$file.'.php');
	}
if($device)exit();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="One Team - İndirme Merkezi">
    <meta name="keywords" content="One Team - İndirme Merkezi">
	<link rel="shortcut icon" href="http://one-teams.com/favicon_material.ico"/>
    <title>One Team - İndirme Merkezi</title>
    <!-- CORE CSS-->    
    <link href="assets/css/theme.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="assets/css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
	<link href="assets/js/plugins/data-tables/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="assets/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">


</head>

<body>
    <!-- Start Page Loading -->
    <div id="loader-wrapper">
        <div id="loader"></div>        
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!-- End Page Loading -->
	<!-- START HEADER -->
    <header id="header" class="page-topbar">
        <!-- start header nav-->
        <div class="navbar-fixed">
            <nav class="navbar-color">
                <div class="nav-wrapper">
                    <ul class="left">                      
                      <li><h1 class="logo-wrapper"><a href="http://forum.one-teams.com/index.php" title="One Team" class="brand-logo darken-1"><img src="http://one-teams.com/img/logo_material.png" alt="One Team" title="One Team"></a> <span class="logo-text">One Team</span></h1></li>
                    </ul>
					<div class="header-search-wrapper hide-on-med-and-down">
                        <i class="mdi-action-search"></i>
                        <input type="text" id="deviceSearch" class="header-search-input z-depth-2" placeholder="Cihaz Ara."/>
						<div id="searchResults"></div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- end header nav-->
    </header>
    <!-- END HEADER -->
    <!-- START MAIN -->
    <div id="main">
        <!-- START WRAPPER -->
        <div class="wrapper">

            <!-- START LEFT SIDEBAR NAV-->
            <aside id="left-sidebar-nav">
                <ul id="slide-out" class="side-nav fixed leftside-navigation">
                <li><a href="#" data-device="main" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> <span>Ana Sayfa</span></a>
                </li>
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion" id="deviceNav">
					<?foreach($brandDevices as $brand=>$devices){?>
						<li class="brand"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-hardware-phone-android"></i> <span><?=$brand;?></span></a>
								<div class="collapsible-body">
								<ul>
								<?foreach($devices as $device_id=>$device){?>
                                    <li><a href="#" data-device="<?=$device_id;?>"><span><?=$device;?></span></a></li>
								<?}?>
                                    </ul>
                                    </div>
                                    </li>
									<li class="divider"></li>
					<?}?>
                    </ul>
                </li>       		
            </ul>
                <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
            </aside>
            <!-- END LEFT SIDEBAR NAV-->

            <!-- //////////////////////////////////////////////////////////////////////////// -->
      <!-- START CONTENT -->
      <section id="content">
        
        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title" id="pageHeader"></h5>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->
		
        <!--start container-->
        <div class="container" id="pageContent"></div>
        <!--end container-->
      </section>
      <!-- END CONTENT -->

        </div>
        <!-- END WRAPPER -->

    </div>
    <!-- END MAIN -->



    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- START FOOTER -->
    <footer class="page-footer">
        <div class="footer-copyright">
            <div class="container">
                Copyright © <?=date('Y');?> <a class="grey-text text-lighten-4" href="http://forum.one-teams.com" target="_blank">One Team</a> Tüm Hakları Saklıdır..
            </div>
        </div>
    </footer>
    <!-- END FOOTER -->


    <!-- ================================================
    Scripts
    ================================================ -->
    
    <!-- jQuery Library -->
    <script type="text/javascript" src="assets/js/plugins/jquery-1.11.2.min.js"></script>    
    <script type="text/javascript" src="assets/js/theme.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="assets/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/data-tables/js/jquery.dataTables.min.js"></script>
    <script>
	var devices=[];
	<?foreach($brandDevices as $brand=>$devices){foreach($devices as $device_id=>$device){?>
	devices['<?=$device_id;?>']='<?=$brand;?> > <?=$device;?>';
	<?}}?>
	</script>
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="assets/js/plugins.min.js"></script>
    <script type="text/javascript" src="assets/js/oneteam.min.js"></script>
    <!-- Toast Notification -->
</body>
</html>
<?
ob_end_flush();
function compressor($buffer)
{
    $search = ['/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s','/<!--(.*)-->/Uis'];
	$replace = ['>', '<', '\\1',''];
	$buffer = preg_replace($search, $replace, $buffer);
	return $buffer;
}
?>