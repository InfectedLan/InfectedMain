<?php
require_once 'utils.php';
require_once 'settings.php';
require_once 'handlers/gamehandler.php';
require_once 'handlers/pagehandler.php';
require_once 'handlers/eventhandler.php';

class Site {
	// Variable definitions.
	private $pageName;
	
	public function __construct() {
		// Set the variables.
		$this->pageName = isset($_GET['page']) ? $_GET['page'] : null;
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
				echo '<meta name="author" content="' . implode(', ', Settings::$authors) . '">'; // TODO: Select all authors in this?
				echo '<meta charset="UTF-8">';
				echo '<link rel="stylesheet" type="text/css" href="style/style.css">';
				echo '<link rel="shortcut icon" href="images/favicon.ico">';
				echo '<style>';
					echo 'body {';
						echo 'background: #000000 url(\'' . $this->getBackground() . '\');';
						echo 'background-repeat: no-repeat;';
						echo 'background-attachment: fixed;';
						echo 'background-size: 100% auto;';
						echo 'background-position: center;';
					echo '}';
				echo '</style>';
				echo '<script src="../api/scripts/jquery.js"></script>';
				echo '<script src="../api/scripts/jquery.form.min.js"></script>';
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
									echo '<li><a href="pages/gameapplication.html"><span>Clan registrering</span></a></li>';
									
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
						if (isset($_GET['page'])) {
						// View the page specified by "pageName" variable.
							$this->viewPage($this->pageName);
						} else {
							// Since non page or article where specified, view the default page.
							$this->viewPage(reset(PageHandler::getPages())->getName());
						}
					echo '</section>';
					echo '<ul class="sponsors">';
						$sponsorList = array('<li><p>Sponsorer:</p></li>', 
											'<li><a href="http://www.paloaltonetworks.com/" target="_blank"><img src="images/sponsors/palo_alto.png" width="80%"></a></li>', 
											'<li><a href="http://www.kvantel.no/" target="_blank"><img src="images/sponsors/kvantel.png" width="50%"></a></li>', 
											'<li><a href="http://www.webhuset.no/" target="_blank"><img src="images/sponsors/webhuset.png" width="80%"></a></li>', 
											'<li><a href="http://www.cocio.no/" target="_blank"><img src="images/sponsors/cocio.png" width="40%"></a></li>', 
											'<li><a href="http://www.proisp.no/" target="_blank"><img src="images/sponsors/proisp.png" width="50%"></a></li>');
											
						$contributorList = array('<li><p>Samarbeidspartnere:</p></li>', 
											'<li><a href="http://www.bleiker.vgs.no/" target="_blank"><img src="images/sponsors/bleiker.png" width="80%"></a></li>', 
											'<li><a href="http://www.konsept-it.no/" target="_blank"><img src="images/sponsors/konsept_it.png" width="80%"></a></li>', 
											'<li><a href="http://www.askerkulturhus.no/huset/radar/" target="_blank"><img src="images/sponsors/radar.png" width="80%"></a></li>', 
											'<li><a href="http://www.asker.kommune.no/" target="_blank"><img src="images/sponsors/asker_kommune.png" width="80%"></a></li>');					
						
						// Choose sponsors or contributors.
						$sponsorOrContributor = isset($_SESSION['sponsors']) ? $_SESSION['sponsors'] : false;
						
						if (isset($_SESSION['sponsors'])) {
							$list = !$_SESSION['sponsors'] ? $sponsorList : $contributorList;
							$_SESSION['sponsors'] = !$_SESSION['sponsors'];
						} else {
							$list = $sponsorList;
							$_SESSION['sponsors'] = true;
						}
						
						// View the sponsors / contributors.
						for ($i = 0; $i < count($list); $i++) {
							echo $list[$i];
						}
					echo '</ul>';
				echo '</div>';
				echo '<footer>';
					echo '<div id="footer">';
						echo '<div class="logo">';
							echo '<a href="."><img src="images/infected_logo.png"></a>';
						echo '</div>';
						echo '<section class="infoText">';
							echo '<div class="infoTextNext">';
								$event = EventHandler::getCurrentEvent();
								$ticketText = $event->getTicketCount() > 1 ? 'billeter' : 'billett';
								
								echo '<p><b>Neste Lan er:</b><br>';
								echo date('d', $event->getStartTime()) . '. - ' . date('d', $event->getEndTime()) . '. ' . Utils::getMonthFromInt(date('m', $event->getEndTime())) . ' i ' . $event->getLocation()->getTitle() . '<br>';
								echo 'Det er ' . $event->getAvailableTickets() . ' av ' . $event->getParticipants() . ' ' . $ticketText . ' igjen<br>';
								echo 'Dørene åpner kl.' . date('H:i', $event->getStartTime()). '<br>';
								echo 'Pris per billett: ' . $event->getTicketType()->getPrice() . ',-</p>';
							echo '</div>';
							echo '<div class="infoTextContact">';
								echo '<p><b>Noe du lurer på?</b><br>';
								echo 'E-post: kontakt@infected.no<br>';
								echo 'Telefon: 99 76 77 45<br>';
								echo 'Addresse: Strøket 15a, Asker</p>';
							echo '</div>';
						echo '</section>';
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
