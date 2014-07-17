<?php
require_once '../../scripts/database.php';
require_once '../../scripts/utils.php';

// Instanciate
$database = new Database();
$utils = new Utils();

$slideList = $database->getSlides();

echo '{';
	echo '"slides":';
	echo '[';
		$i = 0;
		$len = count($slideList);
		foreach($slideList as $slide) {
			echo '{';
				echo '"start":"' . $utils->getDayFromInt(date('N', $slide->getStart())) . ' ' . date('H:i', $slide->getStart()) . '",';
				echo '"end":"' . $utils->getDayFromInt(date('N', $slide->getEnd())) . ' ' . date('H:i', $slide->getEnd()) . '",';
				echo '"title":"' . $slide->getTitle() . '",';
				echo '"content":"' . trim(preg_replace('/\s\s+/', ' ', $slide->getContent())) . '",';
				echo '"isPublished":"' . $slide->isPublished() . '"';
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