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

require_once 'utils.php';
require_once 'handlers/pagehandler.php';
require_once 'handlers/eventhandler.php';

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
	} else {
		echo '<article class="contentBox">';
			echo '<p>Dette spillet finnes ikke!</p>';
		echo '</article>';
	}
}
?>