<?php
/**
 * This file is part of InfectedCrew.
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

require_once 'session.php';
require_once 'settings.php';
require_once 'handlers/eventhandler.php';

echo '<html><head><script src="api/scripts/jquery-1.11.3.min.js"></script></head><body>';
echo '<script>function error(message) {alert(message);} function info(message) {alert(message);}</script>';
echo '<script src="api/scripts/event-checkin.js"></script>';
echo '<h3>Sjekk inn billett</h3>';

$event = EventHandler::getCurrentEvent();
$season = date('m', $event->getStartTime()) == 2 ? 'VINTER' : 'HØST';
$eventName = !empty($event->getTheme()) ? $event->getTheme() : $season;

echo strtoupper(Settings::name . '_' . $eventName . '_' . date('Y', $event->getStartTime()) . '_') . '<input id="ticketId" type="text" autofocus>';
echo '<br>';
echo '<input type="button" value="Sjekk inn" onClick="loadData()"/>';
echo '<br>';
echo '<div id="ticketDetails"></div>';
echo '</body></html>';

?>