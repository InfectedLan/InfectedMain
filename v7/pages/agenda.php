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

	foreach ($agendaList as $agenda) { // 
		if ($day != date('d', $agenda->getDatetime())) {
			echo '</table>';
			echo '</article>';
			echo '<article class="contentBox">';
				echo '<h3>' . Utils::getDayFromInt(date('N', $agenda->getDatetime())) . ' ' . date('d.m', $agenda->getDatetime()) . '</h3>';
			
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
		
		if ($agenda == end($agendaList)) {
			echo '</table>';
			echo '</article>';
		} else {
			$day = date('d', $agenda->getDatetime());
		}
	}
} else {
	echo '<article class="contentBox">';
		echo '<p>Agenda\'en har ikke blitt publisert enda, men den kommer snart!</p>';
	echo '</article>';
}
?>