<?php
require_once 'handlers/agendahandler.php';
require_once 'handlers/eventhandler.php';

echo '<div class="contentTitleBox">';
	echo '<h1>Agenda</h1>';
echo '</div>';

$agendaList = AgendaHandler::getAgendas();

if (!empty($agendaList)) {
	$event = EventHandler::getCurrentEvent();
	$day = 0;

	foreach ($agendaList as $agenda) {
		if ($day != date('d', $agenda->getStart())) {
			echo '</table>';
			echo '</article>';
			echo '<article class="contentBox">';
				echo '<h3>' . Utils::getDayFromInt(date('N', $agenda->getStart())) . ' ' . date('d.m', $agenda->getStart()) . '</h3>';
			
				echo '<table class="table">';
					echo '<tr>';
						echo '<th>Når?</th>';
						echo '<th>Hva?</th>';
						echo '<th>Informasjon:</th>';
					echo '</tr>';
		}
		
		echo '<tr>';
			echo '<td>' . date('H:i', $agenda->getStart()) . '</td>';
			echo '<td>' . $agenda->getTitle() . '</td>';
			echo '<td>' . $agenda->getDescription() . '</td>';
		echo '</tr>';
		
		if ($agenda == end($agendaList)) {
			echo '</table>';
			echo '</article>';
		} else {
			$day = date('d', $agenda->getStart());
		}
	}
} else {
	echo '<article class="contentBox">';
		echo '<p>Agenda\'en for kommende arrangement har ikke blitt publisert enda!</p>';
	echo '</article>';
}
?>