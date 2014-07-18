<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/Utils.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/handlers/MainPageHandler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/handlers/GameApplicationHandler.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;

if (isset($_GET['id'])) {
	$game = GameHandler::getGame($id);
	
	if ($game != null && $game->isPublished()) {
		// Get the page from the database.
		$page = MainPageHandler::getPageByName($game->getName());
		
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
				echo '<b>Påmeldingsfristen er ' . Utils::getDayFromInt(date('N', $game->getDeadLine())) . ' ' . date('d.m.Y', $game->getDeadLine()) . ' klokken ' . date('H:i', $game->getDeadLine()) . '.</b>';
			echo '</article>';
			
			echo $page->getContent();
		}

		// Add the application list for this game.
		$gameApplicationList = GameApplicationHandler::getGameApplications($game->getId());
		
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