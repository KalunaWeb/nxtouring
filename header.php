<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);    

require_once("classes.php");
require_once("classlib.php");
$database = new db();
$user = new Auth($database);
$current = new current();

$arr = $current -> getProductList();

foreach ($arr['products'] as $value=>$key) {
	$index = $arr['products'][$value]['custom_fields']['order'];
	$id[$index] = $arr['products'][$value]['id'];
	$name[$index]= $arr['products'][$value]['name'];
	$price[$index] = floor($arr['products'][$value]['rental_rate']['price']);
	$url[$index] = $arr['products'][$value]['icon']['url'];
	$desc1[$index] = $arr['products'][$value]['custom_fields']['desc1'];
	$desc2[$index] = $arr['products'][$value]['custom_fields']['desc2'];
	$desc3[$index] = $arr['products'][$value]['custom_fields']['desc3'];
	$desc4[$index] = $arr['products'][$value]['custom_fields']['desc4'];
	$main[$index] = $arr['products'][$value]['description'];
	$thumb_url[$index] = $arr["products"][$value]["icon"]["thumb_url"];

};
if(!isset($_SESSION['user_id']))
{
  $user = "Guest";

} else {

 $row = $user -> getUser($_SESSION['user_id']);
 $contact = $current -> getContactById($row['rms_id']);

  $user = $row['user_name'];


$clientname = str_replace(" ", "%20", $contact['member']['name']);

$live = $current->getOpportunity($clientname, "live");
$archive = $current->getOpportunity($clientname, "all");
$old = array_reverse($archive['opportunities']);

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Nx Touring - Self drive Excutive Vehicle Hire</title>
<!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="nxtouring, Self Drive Van Hire, Splitter Van, Tour Van, Crew Van, Mercedes Sprinter, NX Touring" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //custom-theme -->
    <link rel="apple-touch-icon" sizes="57x57" href="images/favi/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="images/favi/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/favi/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="images/favi/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/favi/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="images/favi/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="images/favi/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/favi/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/favi/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="images/favi/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favi/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="images/favi/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favi/favicon-16x16.png">
    <link rel="manifest" href="images/favi/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="images/favi/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

<!-- bootstrap-css -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />
<!--<link href="Bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />-->
<!--// bootstrap-css -->
<!-- css -->
<!-- flexslider -->
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
<!-- //flexslider -->
<!-- carousel slider -->  
<link href="css/owl.carousel.css" rel="stylesheet" type="text/css" media="all"> 
<!-- //carousel slider -->  
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/widget.css" type="text/css" media="all" />
<!--// css -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href="//fonts.googleapis.com/css?family=Aladin" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
<!-- //font-awesome icons -->

<!-- Include Required Prerequisites -->
 
<!-- Include Date Range Picker -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="Bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/serializeJSON.js"></script>
<script type="text/javascript" src="js/jquery_validate.js"></script>
<script type="text/javascript" src="js/additional_methods.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>

<!-- Supportive-JavaScript -->
<script src="js/modernizr.js"></script>
<!-- //Supportive-JavaScript -->
</head> 
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top" data-offset="90"> 

	<!-- banner -->
	<div id="home" class="nxls-banner"> 
		<!-- header -->
		<div class="header-nxlayouts"> 
			<!-- Navigation -->
			<nav class="navbar navbar-default navbar-fixed-top" id="nav-header">
				<div class="container">
					<div class="navbar-header page-scroll">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
							<span class="sr-only">travel</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<h2><a class="navbar-brand nx-logo" href="index.html">NX Touring</a></h2>
						<P>Luxury Vehicle Hire</P>
					</div> 
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav navbar-right">
							<!-- Hidden li included to remove active class from about link when scrolled up past about section -->
							<li class="hidden"><a class="page-scroll" href="#page-top"></a>	</li>
							<li><a class="page-scroll scroll" href="#home">Home</a></li>
							<li><a class="page-scroll scroll" href="#about">About</a></li>
							<li><a class="page-scroll scroll" href="#vans">Vans</a></li>
							<li><a class="page-scroll scroll" href="#gallery">Quote</a></li>			
							<li><a class="page-scroll scroll" href="#downloads">Downloads</a></li>
							<li><a class="page-scroll scroll" href="#testimonials">Testimonials</a></li>
							<li><a class="page-scroll scroll" href="#contact">Contact</a></li>

<?php if ($user == "Guest") {
    	echo '<li><a class="page-scroll scroll" data-toggle="modal" href="#modalLogIn">Log in</a></li>';
    } else {
    	echo '<li><a href="#" data-toggle="dropdown" class="dropdown-toggle">Hello '.$user.'<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="#profileModal" data-target="#profileModal" data-toggle="modal">Profile</a></li>
                          <li><a href="#currentModal" data-target="#currentModal" data-toggle="modal">Bookings</a></li>
                          <li class="divider"></li>
                          <li><a href="logout.php">Log Out</a></li>
                        </ul></li>';
	};?>
						</ul>
					</div>
					<!-- /.navbar-collapse -->
				</div>
				<!-- /.container -->
			</nav>  
		</div>	