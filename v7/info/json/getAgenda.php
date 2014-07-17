<?php
require_once '../../scripts/database.php';
require_once '../../scripts/utils.php';

// Instanciate
$database = new Database();
$utils = new Utils();

$agendaList = $database->getAgendasBetween(1, 5);

echo '{';
	echo '"agendas":';
	echo '[';
		$i = 0;
		$len = count($agendaList);
		foreach($agendaList as $agenda) {
			echo '{';
				echo '"name":"' . $agenda->getName() . '",';
				echo '"datetime":"' . $utils->getDayFromInt(date('N', $agenda->getDatetime())) . ' ' . date('H:i', $agenda->getDatetime()) . '",';
				echo '"description":"' . $agenda->getDescription() . '",';
				echo '"isHappening":"' . $agenda->isHappening() . '"';
			echo '}';
			if($i!=$len-1)
			{
				echo ",";
			}
			$i++;
		}
	echo ']';
echo '}';
?>