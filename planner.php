<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Calendar {
    private $month;
    private $year;
    private $days_of_the_week;
    private $num_days;
    private $date_info;
    private $day_of_the_week;

    public function __construct($month, $year, $days_of_the_week = array('S','M','T','W','T','F','S'))
    {
        $this->month = $month;
        $this->year = $year;
        $this->days_of_the_week = $days_of_the_week;
        $this->num_days = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
        $this->date_info = getdate(strtotime('first day of', mktime(0,0,0,$this->month,1,$this->year)));
        $this->days_of_the_week = $this->date_info['wday'];
    }

    public function show() {
        $output = '';

        echo $output;

    }

}








$main_url = "http://www.darkelf.darktech.org/";
require_once("classlib.php");

$current = new current();


if(!isset($_SESSION['user_id']))
{
    $user = "Guest";

} else {
    if (isset($_GET['id']) && $_GET['id'] !="") {
        $contact = $current -> getContactById($_GET['id']);
        $user = $_GET['name'];
        $driver = 1;
    } else {
        $contact = $current -> getContactById($_SESSION['user_id']);
        $user = $contact['member']['name'];
        $driver = 0;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Nx Touring - Self drive Excutive Vehicle Hire</title>
    <!-- custom-theme -->

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
    <!--<link rel="stylesheet" href="css/newCliRegModal.css" type="text/css" media="all" />-->
    <link rel="stylesheet" href="css/responsive.css" type="text/css" media="all" />
    <!--// css -->
    <!-- font-awesome icons -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Aladin" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <!-- //font-awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <!-- Include Required Prerequisites -->

    <!-- Include Date Range Picker -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="Bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/serializeJSON.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script src="https://getaddress.io/js/jquery.getAddress-2.0.7.min.js"></script>
    <!--<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>-->

    <!-- Supportive-JavaScript -->
    <script src="js/modernizr.js"></script>
    <!-- //Supportive-JavaScript -->
    <script src='https://www.google.com/recaptcha/api.js'></script>

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
                    <h2><a class="navbar-brand nx-logo" href="index.php">NX Touring</a></h2>
                    <P>Luxury Vehicle Hire</P>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                        <li class="hidden"><a class="page-scroll" href="#page-top"></a>	</li>
                        <li><a class="page-scroll scroll" href="index.php#home">Home</a></li>
                        <li><a class="page-scroll scroll" href="index.php#about">About</a></li>
                        <li><a class="page-scroll scroll" href="index.php#vans">Vans</a></li>
                        <li><a class="page-scroll scroll" href="index.php#downloads">Downloads</a></li>
                        <li><a class="page-scroll scroll" href="index.php#testimonials">Testimonials</a></li>
                        <li><a class="page-scroll scroll" href="index.php#contact">Contact</a></li>

                        <?php if ($user == "Guest") {
                            echo '<li><a class="page-scroll scroll" data-toggle="modal" href="#modalLogIn">Log in</a></li>';
                        } else {
                            echo '<li><a href="#" data-toggle="dropdown" class="dropdown-toggle">Hello '.$user.'<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <!--<li><a href="#profileModal" data-target="#profileModal" data-toggle="modal">Profile</a></li>-->
                          <li><a href="profile.php">Profile</a></li>
                          <li><a href="drivers.php">Drivers</a></li>
                          <li><a href="bookings.php">Bookings</a></li>
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

    <body id="background">
   <?php
    /*$vehicles = $current->getVehiclesList();

    foreach ($vehicles['product_inventories'] as $key=>$value) {
        print_r($value['id']);
    }
$stock = $current->getStock();
    print_r ($stock);*/

   $live = $current->getOpportunity("", "live");
   $start = strtotime('2018/05/01');
   $end = strtotime('2018/06/01');
   $newStart = date('Y-m-d', $start);
   $newEnd = date('Y-m-d', $end);


   foreach ($live['opportunities'] as $key=>$value) {

       $time = strtotime($value['starts_at']);
       $time2 = strtotime($value['ends_at']);

       $newformat = date('Y-m-d', $time);
       $newformat2 = date('Y-m-d', $time2);


       if ($newformat > $newStart && $newformat < $newEnd) {
           $opp = $current->getOpportunityListItems($value['id']);
           print_r($opp);
           echo "<br>";
       }

       //echo $newformat . "  " . $new . "<br>";
//if ($newformat > $new) {echo $newformat."<br>";}

   }

    ?>
