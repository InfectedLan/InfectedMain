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

require_once 'handlers/agendahandler.php';
require_once 'handlers/eventhandler.php';

echo '<div class="contentTitleBox">';
	echo '<h1>Agenda</h1>';
echo '</div>';

$agendaList = AgendaHandler::getPublishedAgendas();

if (!empty($agendaList)) {
	$event = EventHandler::getCurrentEvent();
	$day = 0;

	foreach ($agendaList as $agenda) {
		if ($day != date('d', $agenda->getStartTime())) {
			echo '</table>';
			echo '</article>';
			echo '<article class="contentBox">';
				echo '<h3>' . Utils::getDayFromInt(date('w', $agenda->getStartTime())) . ' ' . date('d.m', $agenda->getStartTime()) . '</h3>';
			
				echo '<table class="table">';
					echo '<tr>';
						echo '<th>Når?</th>';
						echo '<th>Hva?</th>';
						echo '<th>Informasjon:</th>';
					echo '</tr>';
		}
		
		echo '<tr>';
			echo '<td>' . date('H:i', $agenda->getStartTime()) . '</td>';
			echo '<td>' . $agenda->getTitle() . '</td>';
			echo '<td>' . $agenda->getDescription() . '</td>';
		echo '</tr>';
		
		if ($agenda == end($agendaList)) {
			echo '</table>';
			echo '</article>';
		} else {
			$day = date('d', $agenda->getStartTime());
		}
	}
} else {
	echo '<article class="contentBox">';
		echo '<p>Agenda\'en for kommende arrangement har ikke blitt publisert enda!</p>';
	echo '</article>';
}
?>