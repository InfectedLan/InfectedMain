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

require_once 'utils/dateutils.php';
require_once 'handlers/compohandler.php';
require_once 'handlers/pagehandler.php';

if (isset($_GET['id']) &&
	is_numeric($_GET['id'])) {
	$compo = CompoHandler::getCompo($_GET['id']);
	
	if ($compo != null) {
		// Get the page from the database.
		$page = PageHandler::getPageByName($compo->getName());
		
		if ($page != null) {
			echo '<div class="contentTitleBox">';
				echo '<h3>' . $page->getTitle() . '</h3>';
			echo '</div>';
				
			echo '<article class="contentBox">';
				$now = strtotime(date('Y-m-d H:i:s'));
				
				if ($game->isBookingTime()) {
					echo '<b>Påmeldingsfristen er ' . DateUtils::getDayFromInt(date('w', $game->getEndTime())) . ' ' . date('d.m.Y', $game->getEndTime()) . ' klokken ' . date('H:i', $game->getEndTime()) . '.</b>';
				} else {
					echo '<b>Påmeldingen åpner ' . DateUtils::getDayFromInt(date('w', $game->getStartTime())) . ' ' . date('d.m.Y', $game->getStartTime()) . ' klokken ' . date('H:i', $game->getStartTime()) . '.</b>';
				}
			echo '</article>';
			
			echo $page->getContent();
		} else {
			echo '<div class="contentTitleBox">';
				echo '<h3>En feil oppstod:</h3>';
			echo '</div>';
			echo '<article class="contentBox">';
				echo '<p>Siden til denne compo\'en finnes ikke.</p>';
			echo '</article>';
		}
	} else {
		echo '<div class="contentTitleBox">';
			echo '<h3>En feil oppstod:</h3>';
		echo '</div>';
		echo '<article class="contentBox">';
			echo '<p>Denne compo\'en finnes ikke!</p>';
		echo '</article>';
	}
}
?>