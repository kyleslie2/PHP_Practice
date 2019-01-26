
<?php
session_start(); 	// start PHP session!


?>
<!DOCTYPE html>
<html lang="en" style="position: relative; min-height: 100%;">
<head>
    <title>Algonquin College Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="Contents/Main.css"/>
<!--    <link rel="stylesheet" type="text/css" href="Contents/Registration.css" />-->
    <link href="../../AlgCommon/Contents/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <style type="text/css">
        .carousel{
            background: #2f4357;
            margin-top: 20px;
        }
        .carousel .item{
            min-height: 280px; /* Prevent carousel from being distorted if for some reason image doesn't load */
        }
        .carousel .item img{
            margin: 0 auto; /* Align slide image horizontally center */
        }
        .bs-example{
            margin: 20px;
        }
    </style>

    </head>
    <body style="padding-top: 50px; margin-bottom: 60px; background-color: lightblue;">
    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" style="padding: 10px" href="http://www.algonquincollege.com">
                <img src="../../AlgCommon/Contents/img/AC.png"
                     alt="Algonquin College" style="max-width:100%; max-height:100%;"/>
            </a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li> <a href="Index.php">Home </a></li>
                <li> <a href="MyPictures.php">My Pictures </a></li>
                <li ><a href="UploadPictures.php">Upload Pictures </a></li>
            </ul>
        </div>
    </div>
</nav>

