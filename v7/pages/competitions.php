<?php
/**
 * This file is part of InfectedMain.
 *
 * Copyright (C) 2015 Infected <http://infected.no/>.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

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