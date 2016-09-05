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


$ical = $ical . "BEGIN:VTIMEZONE
TZID:W. Europe Standard Time
BEGIN:STANDARD
DTSTART:16011028T030000
TZOFFSETFROM:+0200
TZOFFSETTO:+0100
END:STANDARD
BEGIN:DAYLIGHT
DTSTART:16010325T020000
TZOFFSETFROM:+0100
TZOFFSETTO:+0200
END:DAYLIGHT
END:VTIMEZONE\r\n";
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
DTSTART;TZID=W. Europe Standard Time:".$date."T".$startTime."00
DTEND;TZID=W. Europe Standard Time:".$date."T".$endTime."00
SUMMARY:".$subject."
DESCRIPTION:".$desc."
LOCATION:Asker Kulturhus, Strøket 15a, Asker
SEQUENCE:0
BEGIN:VALARM
TRIGGER:-PT30M
ACTION:DISPLAY
DESCRIPTION:Reminder
END:VALARM
END:VEVENT\r\n";



      }

      $ical = $ical . "END:VCALENDAR\r\n";
}





    header('Content-type: text/calendar; charset=utf-8');
    header('Content-Disposition: inline; filename=calendar.ics');
    echo $ical;
    exit;

?>
