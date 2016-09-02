<!DOCTYPE html>
<html lang="no" xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, inition-scale=1.0" />
        <!--<meta http-equiv="refresh" content="1;">-->
        <link href="Core.css" rel="stylesheet" type="text/css" />
        <link href="Color.css" rel="stylesheet" type="text/css" />
        <link href="Resources/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <script src="Resources/scripts/hamburger.js" type="text/javascript" ></script>

    </head>
    <body>
        <nav>
            <a class="Banner_Logo" href="/">
                <img class="Banner_Logo" style="padding:0;" src="Resources\img\infected_logo.png" />
            </a>
            <span id="hamburger" style="float:right">
                <i style="padding:7px 10px 7px 10px; color:white;" class="fa fa-bars fa-2x" aria-hidden="true" onclick="LinksOnMobile('nav_Links_Top')"></i>
            </span>
            <br style="clear:both;" />
            <center id="nav_Links_Top" class="nav_Links">
                <a class="Banner_Links" href="https://tickets.infected.no">
                    <p class="Banner_Links_P">Billetter</p>
                </a>
                <a class="Banner_Links" href="#">
                    <p class="Banner_Links_P">Agenda</p>
                </a>
                <a class="Banner_Links" href="#">
                    <p class="Banner_Links_P">Konkurranser</p>
                </a>
                <a class="Banner_Links" href="?pages=onsite">
                    <p class="Banner_Links_P">Informasjon</p>
                </a>
                <a class="Banner_Links" href="https://crew.infected.no">
                    <p class="Banner_Links_P">Crew</p>
                </a>
            </center>

           
        </nav>

        <?php

            $pageName = isset($_GET['pages']) ? $_GET['pages'] : 'home';

            $pageDir = 'pages';
            $fileName = $pageDir . '/' . $pageName . '.' . 'html';
            $pageList = glob($fileName);

            if (in_array($fileName, $pageList))
            {
                include $fileName;
            } 


        ?>

        <footer>
            
            <center style="padding-top: 25px;">
                <a href="#">
                    <p>Om</p>
                </a>
                <span style="border: white solid 1px;"></span>
                <a href="#">
                    <p>Kontakt</p>
                </a>
            </center>
            
            <center style="padding-top:10px; padding-bottom:10px;">
                <h3 class="Sponsor_h3">Samarbeidspartnere</h3>

                <img class="sponsor_img" src="Resources\img\radar.png" />
                <img class="sponsor_img" src="Resources\img\bleiker.png" />
                <img class="sponsor_img" src="Resources\img\asker_kommune.png" />
                <img class="sponsor_img" src="Resources\img\meny.png" />

            </center>
            
            <center>
                
                <h3 style="color:white;">Infected Lan er også på</h3>
                
                <a href="https://www.facebook.com/infectedlan/?fref=ts" style="border:#3b5998 solid 1px; height: 1em; width:1em; background-color:#3b5998; border-radius:50%; margin:0 2.5px;">
                    <i class="fa fa-facebook fa-1x" aria-hidden="true"></i>
                </a>
                <a href="https://twitter.com/infected_lan" style="border:#1da1f2 solid 1px; height: 1em; width:1em; background-color:#1da1f2; border-radius:50%; margin:0 2.5px;">
                    <i class="fa fa-twitter fa-1x" aria-hidden="true"></i>
                </a>
            </center>

            <center>
                <p style="color:white; text-align:center; margin-top:25px;">© 2016 Brage</p>
            </center>
        </footer>

    </body>
</html>
