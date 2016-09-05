<?php
/**
 * This file is part of InfectedMain.
 *
 * Copyright (C) 2013-2016 Infected <http://infected.no/>.
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 3.0 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library.  If not, see <http://www.gnu.org/licenses/>.
 */

require_once 'settings.php';
require_once 'handlers/compohandler.php';
require_once 'handlers/pagehandler.php';
require_once 'handlers/eventhandler.php';
require_once 'utils/dateutils.php';

class Site {
	// Variable definitions.
	private $pageName;

	public function __construct() {
		// Set the variables.
		$this->pageName = isset($_GET['page']) ? $_GET['page'] : 'home';
	}

	// Execute the site.
	public function execute() {
		echo '<!DOCTYPE html>';
		echo '<html>';
			echo '<head>';
				echo '<base href="/v8/">';
				echo '<title>' . $this->getTitle() . '</title>';
				echo '<meta name="description" content="' . Settings::description . '">';
				echo '<meta name="keywords" content="' . Settings::keywords . '">';
				echo '<meta name="author" content="Brage, halvors and petterroea">';
				echo '<meta charset="UTF-8">';
				echo '<link rel="shortcut icon" href="images/favicon.ico">';
				echo '<meta name="viewport" content="width=device-width, inition-scale=1.0">';
				echo '<link href="Core.css" rel="stylesheet" type="text/css">';
				echo '<link href="Color.css" rel="stylesheet" type="text/css">';
				echo '<link href="Resources/css/font-awesome.min.css" rel="stylesheet" type="text/css">';
				echo '<script src="Resources/scripts/hamburger.js" type="text/javascript" ></script>';
				echo '<script>';
					echo '(function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){';
					echo '(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),';
					echo 'm=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)';
					echo '})(window,document,\'script\',\'//www.google-analytics.com/analytics.js\',\'ga\');';

					echo 'ga(\'create\', \'UA-54254513-1\', \'auto\');';
					echo 'ga(\'send\', \'pageview\');';
				echo '</script>';
			echo '</head>';
			echo '<body>';
			echo '<nav>';
				echo '<a class="Banner_Logo" href="/">';
					echo '<img class="Banner_Logo" style="padding:0;" src="Resources\img\infected_logo.png">';
				echo '</a>';
				echo '<span id="hamburger" style="float:right">';
					echo '<i style="padding:7px 10px 7px 10px; color:white; cursor: pointer;" class="fa fa-bars fa-2x" aria-hidden="true" onclick="LinksOnMobile(\'nav_Links_Top\')"></i>';
				echo '</span>';
				echo '<br style="clear:both;" />';
				echo '<center id="nav_Links_Top" class="nav_Links">';
					echo '<a class="Banner_Links" href="//tickets.' . Settings::domain . '/" target="_blank"><p class="Banner_Links_P">Billetter</p></a>';
					echo '<a class="Banner_Links" href="pages/agenda.html"><p class="Banner_Links_P">Agenda</p></a>';
					echo '<a class="Banner_Links" href="pages/competition.html"><p class="Banner_Links_P">Konkurranser</p></a>';
					echo '<a class="Banner_Links" href="pages/onsite.html"><p class="Banner_Links_P">Informasjon</p></a>';
					echo '<a class="Banner_Links" href="//compo.' . Settings::domain . '/"><p class="Banner_Links_P">Compo</p></a>';
					echo '<a class="Banner_Links" href="//crew.' . Settings::domain . '/" target="_blank"><p class="Banner_Links_P">Crew</p></a>';
				echo '</center>';
			echo '</nav>';

			// View the page specified by "pageName" variable.
			$this->viewPage($this->pageName);

			echo '<footer>';
				echo '<center style="padding-top: 25px;">';
					echo '<a href="pages/about.html"><p>Om</p></a>';
					echo '<span style="border: white solid 1px;"></span>';
					echo '<a href="pages/contact.html"><p>Kontakt</p></a>';
				echo '</center>';
				echo '<center style="padding-top:10px; padding-bottom:10px;">';
					echo '<h3 class="Sponsor_h3">Samarbeidspartnere</h3>';

					$sponsorList = ['<a href="http://bleiker.vgs.no/" target="_blank"><img class="sponsor_img" src="Resources\img\bleiker.png" alt="Bleiker Vidregående Skole"></a>',
													'<a href="http://askerkulturhus.no/huset/radar/" target="_blank"><img class="sponsor_img" src="Resources\img\radar.png" alt="Radar"></a>',
													'<a href="http://asker.kommune.no/" target="_blank"><img class="sponsor_img" src="Resources\img\asker_kommune.png" alt="Asker Kommune"></a>'];

					// Randomize the order of the list.
					shuffle($sponsorList);

					// Print every sponsor.
					foreach ($sponsorList as $sponsor) {
						echo $sponsor;
					}

				echo '</center>';
				echo '<center style="padding-bottom:25px;">';
					echo '<h3 style="color:white;">Infected Lan er også på</h3>';
					echo '<a href="https://www.facebook.com/infectedlan/?fref=ts" style="border:#3b5998 solid 1px; height: 1em; width:1em; background-color:#3b5998; border-radius:50%; margin:0 2.5px;">';
						echo '<i class="fa fa-facebook fa-1x" aria-hidden="true"></i>';
					echo '</a>';
					echo '<a href="https://twitter.com/infected_lan" style="border:#1da1f2 solid 1px; height: 1em; width:1em; background-color:#1da1f2; border-radius:50%; margin:0 2.5px;">';
						echo '<i class="fa fa-twitter fa-1x" aria-hidden="true"></i>';
					echo '</a>';
				echo '</center>';
				echo '<center style="padding-bottom:10px; padding-top:10px; background-color:rgb(10,10,10);">';
					echo '<p style="color:white; text-align:center;">Kopirett &copy; 2016 exeron, halvors og petterroea</p>';
				echo '</center>';
			echo '</footer>';
		echo '</body>';
	echo '</html>';
}

	// Picks randomly a background from the background directory.
	private function getBackground() {
		$directory = 'images/backgrounds/';
		$suffix = 'jpg';
		$list = glob($directory . '*.' . $suffix);

		return $list[rand(0, count($list) - 1)];
	}

	// Generates title based on current page / article.
	private function getTitle() {
		$theme = EventHandler::getCurrentEvent()->getTheme();
		$title = $theme != null ? Settings::name . ' ' . $theme : Settings::name;
		$space = ' - ';

		if (isset($_GET['page'])) {
			// Fetch the page object from the database.
			$page = PageHandler::getPageByName($this->pageName);

			if ($page != null) {
				$title .= $space . $page->getTitle();
			}
		}

		return $title;
	}

	private function viewPage($pageName) {
		// Fetch the page object from the database and display it.
		//$page = PageHandler::getPageByName($pageName);
		$page = null;

		if ($page != null) {
			// Format the page as HTML.
			echo '<div class="contentTitleBox">';
				echo '<h1>' . $page->getTitle() . '</h1>';
			echo '</div>';
			echo $page->getContent();
		} else {
			$directory = 'pages/';
			$fileName = $directory . $pageName . '.php';

			// If page doesn't exist in the database, check if there is a .php file that do. Else an error is shown.
			if (in_array($fileName, glob($directory . '*.php'))) {
				include $fileName;
			} else {
				echo '<article>';
					echo '<h1>Siden ble ikke funnet!</h1>';
					echo 'Siden du ser etter finnes ikke.';
				echo '</article>';
			}
		}
	}
}
?>
