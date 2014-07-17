<?php
require_once '/../../../api/handlers/AgendaHandler.php';
require_once '/../../../api/handlers/EventHandler.php';

echo '<div class="contentTitleBox">';
	echo '<h1>Agenda</h1>';
echo '</div>';

$agendaList = AgendaHandler::getAgendas();

if (!empty($agendaList)) {
	$event = EventHandler::getCurrentEvent();
	$currentDay = 0;

	foreach ($agendaList as $agenda) { // 
		if ($agenda->getDatetime() >= $event->getStartTime() &&
			$agenda->getDatetime() + 2 * 60 * 60 <= $event->getEndTime()) {
			if ($currentDay != date('d', $agenda->getDatetime())) {
				echo '</table>';
				echo '</article>';
				echo '<article class="contentBox">';
					echo '<h3>' . $utils->getDayFromInt(date('N', $agenda->getDatetime())) . ' ' . date('d.m', $agenda->getDatetime()) . '</h3>';
				
					echo '<table class="table">';
						echo '<tr>';
							echo '<th>Når?</th>';
							echo '<th>Hva?</th>';
							echo '<th>Informasjon:</th>';
						echo '</tr>';
			}
			
			echo '<tr>';
				echo '<td>' . date('H:i', $agenda->getDatetime()) . '</td>';
				echo '<td>' . $agenda->getName() . '</td>';
				echo '<td>' . $agenda->getDescription() . '</td>';
			echo '</tr>';
			
			if ($agenda === end($agendaList)) {
				echo '</table>';
				echo '</article>';
			} else {
				$currentDay = date('d', $agenda->getDatetime());
			}
		}
	}
} else {
	echo '<article class="contentBox">';
		echo '<p>Agenda\'en har ikke blitt publisert enda, men den kommer snart!</p>';
	echo '</article>';
}
?>