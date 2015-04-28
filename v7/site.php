<?php
/**
 * This file is part of InfectedMain.
 *
 * Copyright (C) 2015 Infected <http://infected.no/>.
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
require_once 'handlers/gamehandler.php';
require_once 'handlers/pagehandler.php';
require_once 'handlers/eventhandler.php';
require_once 'utils/dateutils.php';

class Site {
	// Variable definitions.
	private $pageName;
	
	public function __construct() {
		// Set the variables.
		$this->pageName = isset($_GET['page']) ? $_GET['page'] : reset(PageHandler::getPages())->getName();
	}
	
	// Execute the site.
	public function execute() {
		echo '<!DOCTYPE html>';
		echo '<html>';
			echo '<head>';
				echo '<base href="/v7/">';
				echo '<title>' . $this->getTitle() . '</title>';
				echo '<meta name="description" content="' . Settings::description . '">';
				echo '<meta name="keywords" content="' . Settings::keywords . '">';
				echo '<meta name="author" content="halvors and petterroea">';
				echo '<meta charset="UTF-8">';
				echo '<link rel="shortcut icon" href="images/favicon.ico">';
				echo '<link rel="stylesheet" type="text/css" href="styles/style.css">';
				echo '<style>';
					echo 'body {';
						echo 'background: #000000 url(\'' . $this->getBackground() . '\');';
						echo 'background-repeat: no-repeat;';
						echo 'background-attachment: fixed;';
						echo 'background-size: 100% auto;';
						echo 'background-position: center;';
					echo '}';
				echo '</style>';
				echo '<script src="../api/scripts/jquery-1.11.1.min.js"></script>';
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
				echo '<header>';
					echo '<nav id="menu">';
						echo '<ul>';
							echo '<li class="has-sub"><a href="pages/information.html"><span>Informasjon</span></a>';
								echo '<ul>';
									echo '<li><a href="pages/information.html"><span>Generelt</span></a></li>';
									echo '<li><a href="pages/rules-and-security.html"><span>Regler og sikkerhet</span></a></li>';
									echo '<li><a href="pages/parents-and-guardians.html"><span>For foreldre og foresatte</span></a></li>';
									echo '<li class="last"><a href="pages/packing-list.html"><span>Pakkeliste</span></a></li>';
								echo '</ul>';
							echo '</li>';
							echo '<li><a href="https://tickets.infected.no/" target="_blank"><span>Billetter</span></a></li>';
							echo '<li class="has-sub"><a href="pages/competitions.html"><span>Konkurranser</span></a>';
								echo '<ul>';
									echo '<li><a href="pages/competitions.html"><span>Generelt</span></a></li>';
									echo '<li><a href="https://compo.infected.no/index.php"><span>Compo side</span></a></li>';
									
									$gameList = GameHandler::getPublishedGames();
									
									foreach ($gameList as $game) {
										if ($game != end($gameList)) {
											echo '<li><a href="pages/game/id/' . $game->getId() . '.html"><span>' . $game->getTitle() . '</span></a></li>';
										} else {
											echo '<li class="last"><a href="pages/game/id/' . $game->getId() . '.html"><span>' . $game->getTitle() . '</span></a></li>';
										}
									}
								echo '</ul>';
							echo '</li>';
							if ($this->pageName == 'agenda') {
								echo '<li><a class="active" href="pages/agenda.html"><span>Agenda</span></a></li>';
							} else {
								echo '<li><a href="pages/agenda.html"><span>Agenda</span></a></li>';
							}
							
							if ($this->pageName == 'about') {
								echo '<li><a class="active" href="pages/about.html"><span>Om Infected</span></a></li>';
							} else {
								echo '<li><a href="pages/about.html"><span>Om Infected</span></a></li>';
							}
							
							if ($this->pageName == 'contact') {
								echo '<li><a class="active" href="pages/contact.html"><span>Kontakt</span></a></li>';
							} else {
								echo '<li><a href="pages/contact.html"><span>Kontakt</span></a></li>';
							}
							
							echo '<li class="last"><a href="https://crew.infected.no/" target="_blank"><span>Crew</span></a></li>';
						echo '</ul>';
					echo '</nav>';
				echo '</header>';
				echo '<div id="main">';
					echo '<section class="content">';
						// View the page specified by "pageName" variable.
						$this->viewPage($this->pageName);
					echo '</section>';
					echo '<ul class="sponsors">';
						echo '<li><p>Samarbeidspartnere</p></li>';
						
						$sponsorList = array('<li><a href="http://www.webhuset.no/" target="_blank"><img src="images/sponsors/webhuset.png" alt="Webhuset" style="width: 80%;"></a></li>',
											 '<li><a href="http://www.kvantel.no/" target="_blank"><img src="images/sponsors/kvantel.png" alt="Kvantel" style="width: 50%;"></a></li>', 
											 '<li><a href="http://www.bleiker.vgs.no/" target="_blank"><img src="images/sponsors/bleiker.png" alt="Bleiker VGS" style="width: 80%;"></a></li>', 
											 '<li><a href="http://www.konsept-it.no/" target="_blank"><img src="images/sponsors/konsept_it.png" alt="Konsept IT" style="width: 80%;"></a></li>', 
											 '<li><a href="http://www.askerkulturhus.no/huset/radar/" target="_blank"><img src="images/sponsors/radar.png" alt="Radar Cafe" style="width: 80%;"></a></li>', 
											 '<li><a href="http://www.asker.kommune.no/" target="_blank"><img src="images/sponsors/asker_kommune.png" alt="Asker Kommune" style="width: 80%;"></a></li>');					
						
						// Randomize the order of the list.
						shuffle($sponsorList);
						
						// Print every sponsor.
						foreach ($sponsorList as $sponsor) {
							echo $sponsor;
						}
					echo '</ul>';
				echo '</div>';
				echo '<footer>';
					echo '<div id="footer">';
						echo '<div class="logo">';
							echo '<a href="."><img src="images/infected_logo.png" alt="Infected"></a>';
						echo '</div>';
						echo '<div class="infoText">';
							echo '<div class="infoTextNext">';
								$event = EventHandler::getCurrentEvent();
								$ticketText = $event->getTicketCount() > 1 ? 'billeter' : 'billett';
								
								echo '<p>';
									echo '<b>Neste Lan er:</b><br>';
									echo date('d', $event->getStartTime()) . '. - ' . date('d', $event->getEndTime()) . '. ' . DateUtils::getMonthFromInt(date('m', $event->getEndTime())) . ' i ' . $event->getLocation()->getTitle() . '<br>';
									echo 'Dørene åpner kl. ' . date('H:i', $event->getStartTime()). '<br>';
									
									if ($event->isBookingTime()) {
										if (!empty($event->getAvailableTickets())) {
											echo 'Det er <b>' . $event->getAvailableTickets() . '</b> av <b>' . $event->getParticipants() . '</b> ' . $ticketText . ' igjen<br>';
											echo 'Pris per billett: ' . $event->getTicketType()->getPrice() . ',- inkludert medlemskap i Radar.';
										} else {
											echo 'Det er ingen billetter igjen.';
										}
									} else {
										echo 'Billettsalget starter ' . date('d', $event->getBookingTime()) . '. ' . DateUtils::getMonthFromInt(date('m', $event->getBookingTime())) .' kl. '  . date('H:i', $event->getBookingTime());
									}
								echo '</p>';
							echo '</div>';
							echo '<div class="infoTextContact">';
								echo '<p><b>Noe du lurer på?</b><br>';
								echo 'E-post: kontakt@infected.no<br>';
								echo 'Telefon: 99 76 77 45<br>';
								echo 'Addresse: Strøket 15a, Asker</p>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
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
		$page = PageHandler::getPageByName($pageName);
		
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
