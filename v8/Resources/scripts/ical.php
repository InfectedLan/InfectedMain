<?php

    /*$date       = $_GET['date'];
    $startTime  = $_GET['startTime'];
    $endTime    = $_GET['endTime'];
    $subject    = $_GET['subject'];
    $desc       = $_GET['desc'];*/

require_once 'utils/dateutils.php';
require_once 'handlers/agendahandler.php';
require_once 'handlers/eventhandler.php';

$agendaList = AgendaHandler::getPublishedAgendas();

if (!empty($agendaList))
{
  	$event = EventHandler::getCurrentEvent();


      $ical = "BEGIN:VCALENDAR
      VERSION:2.0
      PRODID:-//infected/agendacal//NO
      METHOD:PUBLISH\r\n";

      foreach ($agendaList as $agenda)
      {

          $startTime = date('Hi', $agenda->getStartTime());
          $date = date('Ymd', $agenda->getStartTime());

          $subject = $agenda->getTitle();
          $desc = $agenda->getDescription();

          $endTime = date('Hi', $agenda->getStartTime());


            $ical = $ical . "BEGIN:VEVENT
            UID:" . md5(uniqid(mt_rand(), true)). "infected.no
            DTSTAMP:" . gmdate('Ymd').'T'. gmdate('His') . "Z
            DTSTART:".$date."T".$startTime."00Z
            DTEND:".$date."T".$endTime."00Z
            SUMMARY:".$subject."
            DESCRIPTION:".$desc."
            SEQUENCE:0
            END:VEVENT\r\n";



      }

      $ical = $ical . "END:VCALENDAR\r\n";
}





    header('Content-type: text/calendar; charset=utf-8');
    header('Content-Disposition: inline; filename=calendar.ics');
    echo $ical;
    exit;

?>
