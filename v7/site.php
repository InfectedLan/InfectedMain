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
require_once 'handlers/compohandler.php';
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
				echo '<script src="../api/scripts/jquery-1.11.3.min.js"></script>';
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
							echo '<li><a href="//tickets.' . Settings::domain . '/" target="_blank"><span>Billetter</span></a></li>';
							echo '<li class="has-sub"><a href="pages/competitions.html"><span>Konkurranser</span></a>';
								echo '<ul>';
									echo '<li><a href="pages/competitions.html"><span>Generelt</span></a></li>';
									echo '<li><a href="//compo.' . Settings::domain . '/" target="_blank"><span>Composide</span></a></li>';

									$compoList = CompoHandler::getCompos();

									foreach ($compoList as $compo) {
										if ($compo != end($compoList)) {
											echo '<li><a href="pages/compo/id/' . $compo->getId() . '.html"><span>' . $compo->getTitle() . '</span></a></li>';
										} else {
											echo '<li class="last"><a href="pages/compo/id/' . $compo->getId() . '.html"><span>' . $compo->getTitle() . '</span></a></li>';
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

							echo '<li class="last"><a href="//crew.' . Settings::domain . '/" target="_blank"><span>Crew</span></a></li>';
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

						$sponsorList = ['<li><a href="http://bleiker.vgs.no/" target="_blank"><img src="images/sponsors/bleiker.png" alt="Bleiker VGS" style="width: 80%;"></a></li>',
											 			'<li><a href="http://askerkulturhus.no/huset/radar/" target="_blank"><img src="images/sponsors/radar.png" alt="Radar Cafe" style="width: 80%;"></a></li>',
											 			'<li><a href="http://asker.kommune.no/" target="_blank"><img src="images/sponsors/asker_kommune.png" alt="Asker Kommune" style="width: 80%;"></a></li>',
														'<li><a href="http://meny.no/" target="_blank"><img src="images/sponsors/meny.svg" alt="Meny" style="width: 80%;"></a></li>'];

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
								$ticketText = $event->getTicketCount() > 1 ? 'billetter' : 'billett';

								echo '<p>';
									echo '<b>Neste Lan er:</b><br>';

									echo date('d', $event->getStartTime()) . '. ' . (date('m', $event->getStartTime()) != date('m', $event->getEndTime()) ? DateUtils::getMonthFromInt(date('m', $event->getStartTime())) : null) . ' - ' . date('d', $event->getEndTime()) . '. ' . DateUtils::getMonthFromInt(date('m', $event->getEndTime())) . ' i ' . $event->getLocation()->getTitle() . ', dørene åpner kl. ' . date('H:i', $event->getStartTime()) . '<br>';
									echo 'Pris per billett: <i>' . $event->getTicketType()->getPrice() . ',-</i> (Inkluderer medlemskap i Radar)' . '<br>';

									if ($event->isBookingTime()) {
										if (!empty($event->getAvailableTickets())) {
											echo 'Det er <b>' . $event->getAvailableTickets() . '</b> av <b>' . $event->getParticipants() . '</b> ' . $ticketText . ' igjen';
										} else {
											echo 'Det er ingen billetter igjen';
										}
									} else {
										$currentDate = date('Y-m-d');
										$tomorrowDate = date('Y-m-d', strtotime('+1 day', strtotime($currentDate)));
										$bookingDate = date('Y-m-d', $event->getBookingTime());
										$bookingDateFormattedText = date('d', $event->getBookingTime()) . '. ' . DateUtils::getMonthFromInt(date('m', $event->getBookingTime()));
										$ticketSaleStartDate = $currentDate == $bookingDate ? 'i dag' : ($tomorrowDate == $bookingDate ? 'i morgen' : $bookingDateFormattedText);

										echo 'Billettsalget starter ' . $ticketSaleStartDate . ' kl. '  . date('H:i', $event->getBookingTime());
									}
								echo '</p>';
							echo '</div>';
							echo '<div class="infoTextContact">';
								echo '<p><b>Noe du lurer på?</b><br>';
								echo 'E-post: erling@nortiktak.no<br>';
								echo 'Telefon: 95 01 83 05<br>';
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
