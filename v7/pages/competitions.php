<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/handlers/MainPageHandler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/handlers/GameHandler.php';

$page = MainPageHandler::getMainPageByName('competitions-general');

if ($page != null) {
	echo '<div class="contentTitleBox">';
		echo '<h1>' . $page->getTitle() . '</h1>';
	echo '</div>';
	echo '<article class="contentBox">';
		echo '<p><b>Det blir compoer i:</b></p>';
		echo '<ul>';
			$gameList = GameHandler::getGames();
			
			foreach ($gameList as $game) {
				echo '<li>' . $game->getTitle() . ' (' . $game->getMode() . ') ' . $game->getPrice() . ',- ' . $game->getDescription() . '</li>';
			}
		echo '</ul>';
	echo '</article>';
	
	echo $page->getContent();
}
?>