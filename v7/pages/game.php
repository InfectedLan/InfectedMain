<?php
require_once 'utils.php';
require_once 'handlers/pagehandler.php';
require_once 'handlers/eventhandler.php';
require_once 'handlers/gameapplicationhandler.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;

if (isset($_GET['id'])) {
	$game = GameHandler::getGame($id);
	
	if ($game != null && $game->isPublished()) {
		// Get the page from the database.
		$page = PageHandler::getPageByName($game->getName());
		
		if ($page != null) {
			if (isset($_GET['message'])) {
				echo '<article class="contentBox">';
					echo '<h3>Melding!</h3>';
					echo '<p>Clanen din er nå påmeldt ' . $game->getTitle() . ' compo.</p>';
				echo '</article>';
			}
			
			echo '<div class="contentTitleBox">';
				echo '<h3>' . $page->getTitle() . '</h3>';
			echo '</div>';
				
			echo '<article class="contentBox">';
				$now = strtotime(date('Y-m-d H:i:s'));
				
				if ($game->isBookingTime()) {
					echo '<b>Påmeldingsfristen er ' . Utils::getDayFromInt(date('w', $game->getEndTime())) . ' ' . date('d.m.Y', $game->getEndTime()) . ' klokken ' . date('H:i', $game->getEndTime()) . '.</b>';
				} else {
					echo '<b>Påmeldingen åpner ' . Utils::getDayFromInt(date('w', $game->getStartTime())) . ' ' . date('d.m.Y', $game->getStartTime()) . ' klokken ' . date('H:i', $game->getStartTime()) . '.</b>';
				}
			echo '</article>';
			
			echo $page->getContent();
		}

		// Add the application list for this game.
		$gameApplicationList = GameApplicationHandler::getGameApplicationsForEvent($game, EventHandler::getCurrentEvent());
		
		echo '<article class="contentBox">';
			echo '<h3>Påmeldte claner</h3>';
			
			if (!empty($gameApplicationList)) {
				echo '<p>Under vises en tabell over påmeldte claner i dette spillet.</p><br>';
				echo '<table class="table">';
					echo '<tr>';
						echo '<th>Clan:</th>';
						echo '<th>Tag:</th>';
						echo '<th>Nick:</th>';
					echo '</tr>';
					
					foreach ($gameApplicationList as $value) {
						echo '<tr>';
							echo '<td>' . $value->getName() . '</td>';
							echo '<td>' . $value->getTag() . '</td>';
							echo '<td>' . $value->getContactnick() . '</td>';
						echo '</tr>';
					}
				echo '</table>';
			} else {
				echo '<p>Ingen har meldt seg på compo i dette spillet enda.</p>';
			}
		echo '</article>';
	} else {
		echo '<article class="contentBox">';
			echo '<p>Dette spillet finnes ikke!</p>';
		echo '</article>';
	}
}
?>