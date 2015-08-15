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
require_once 'handlers/eventhandler.php';

if (isset($_GET['id']) &&
	is_numeric($_GET['id'])) {
	$compo = CompoHandler::getCompo($_GET['id']);

	if ($compo != null) {
		// Get the page from the database.
		$page = PageHandler::getPageByName($compo->getName());

		if ($page != null) {
			$event = EventHandler::getCurrentEvent();

			echo '<div class="contentTitleBox">';
				echo '<h3>' . $page->getTitle() . '</h3>';
			echo '</div>';

			echo '<article class="contentBox">';
				if ($event->getBookingTime() <= time()) {
					echo '<b>Påmeldingsfristen er ' . DateUtils::getDayFromInt(date('w', $compo->getRegistrationEndTime())) . ' ' . date('d.m.Y', $compo->getRegistrationEndTime()) . ' klokken ' . date('H:i', $compo->getRegistrationEndTime()) . '.</b>';
				} else {
					echo '<b>Påmeldingen åpner ' . DateUtils::getDayFromInt(date('w', $event->getBookingTime())) . ' ' . date('d.m.Y', $event->getBookingTime()) . ' klokken ' . date('H:i', $event->getBookingTime()) . '.</b>';
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
