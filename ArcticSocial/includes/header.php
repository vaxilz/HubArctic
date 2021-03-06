<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ArcticSocial - Let's Party!</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">
    <!-- brad added a css file for the sign in page -->
    <link href="css/signin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <?php
        session_start();
        function __autoload($class){
        require_once  'Classes/' . $class . '.php';
    }
    $dbh = new DBhandler();
    ?>
    <!-- Navigation -->
  
                     
                 
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">ArcticSocial </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="party.php">Party</a>
                    </li>   
                    <li>
                        <a href="about.php">About Us </a>
                    </li>
                    <li>
                        <a href="contact.php">Contact Us</a>
                    </li>
                      <li class="dropdown "> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                            <?php
                            if(empty($_SESSION['id']) ){
                                //NON-AUTHENTICATED USER 
                            ?>
                                <li><a href="/ArcticSocial/register.php">Register <span class='glyphicon glyphicon-user'></span></a></li>
                                <li><a href="/ArcticSocial/logins.php">Login <span class='glyphicon glyphicon-log-in'></span></a></li>                              
                          
                            <?php
                                } else{                          
                       
                                //REGISTERED USER IS LOGGED IN 
                            ?>
                                <li><a href="/ArcticSocial/logout.php">Logout <span class='glyphicon glyphicon-log-out'></span></a></li>                              
                            <?php
                                }
                         ?>
                            </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <?php
  
    
