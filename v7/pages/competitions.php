<?php
require_once 'handlers/pagehandler.php';
require_once 'handlers/gamehandler.php';

$page = PageHandler::getPageByName('competitions-general');

if ($page != null) {
	echo '<div class="contentTitleBox">';
		echo '<h1>' . $page->getTitle() . '</h1>';
	echo '</div>';
	echo '<article class="contentBox">';
		echo '<p><b>Det blir compoer i:</b></p>';
		
		$gameList = GameHandler::getGames();
		
		if (!empty($gameList)) {
			echo '<ul>';
				foreach ($gameList as $game) {
					echo '<li>' . $game->getTitle() . ' (' . $game->getMode() . ') ' . $game->getPrice() . ',- ' . $game->getDescription() . '</li>';
				}
			echo '</ul>';
		} else {
			echo '<p>Ingen spill er lagt til i systemet enda.</p>';
		}
	echo '</article>';
	
	echo $page->getContent();
}
?>