<?php
	//session_start();
    require 'exeron_org.php';


	$pageName = "";
    

	$pageName = isset($_GET['site']) ? $_GET['site'] : 'index';
	
	//$_SESSION['login_navigated'] = $_SERVER['REQUEST_URI'];

    $pageFormat = "html";

    if (isset($_GET['fmat'])) 
    {
        $pageFormat = $_GET['fmat'];
    }

    if ($pageFormat == '') {
        $pageFormat = "html";
    }

    //echo 'fmat = ' . $pageFormat;

?>


<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
    <!--<meta http-equiv="refresh" content="3" />-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Core.css" />
    <link rel="stylesheet" type="text/css" href="Resources/css/font-awesome.min.css">
</head>
<body>
    <center class="Header">
        <a class="ignore_a" href="http://exeron.org">
            <img class="LogoImage" src=".\Resources\img\SiteIcon.png" />
        </a>
    </center>


    <?php
        $pageDir = 'site';
        $fileName = $pageDir . '/' . $pageName . '.' . $pageFormat;
        $pageList = glob($fileName);

        if (in_array($fileName, $pageList))
        {
            include $fileName;
        } 
        /*else 
        {

        echo '<div class="DivBottomINFO">';
            echo '<h1>Can`t find page!</h1>';
            echo '<p>The Page You Are Looking For Does Not Exsist Or Has Been Deleted</p>';
            echo '<p>Please Check The Url/Link That You Have Entered Or Recieved</p>';
            echo '<a href="http://software.exeron.org/">Return Home</a>';
        echo '</div>';

        }*/

    ?>



    <footer>
        <a href="https://twitter.com/Brageskj">
            <i class="fa fa-twitter"></i>
        </a>
    </footer>

</body>
</html>