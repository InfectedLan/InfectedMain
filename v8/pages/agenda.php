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
require_once 'handlers/agendahandler.php';
require_once 'handlers/eventhandler.php';


echo '<center id="wrapper">';
  echo '<div id="Overview_Post" style="margin-bottom:150px;">';
    echo '<i id="main_emblem" style="padding:10px; padding-bottom:20px; border-bottom:white solid 1px; font-size:128px;" class="fa fa-wpforms Foreground2" aria-hidden="true"></i>';
    echo '<h1 style="color:white;">Agenda</h1>';
    echo '<h3 style="color:white;">Her er oversikten over hva som vil foregå og når</h3>';
  echo '</div>';
echo '</center>';
echo '<div id="General_information" class="Background2">';
  echo '<center class="Banner_Post">';
    echo '<center style="margin:0 auto; display:inline-block; padding-top:25px; padding-bottom:25px;">';
      echo '<i class="fa fa-info-circle fa-5x Foreground1" aria-hidden="true"></i>';
      echo '<h2 style="color:black;">Agendaen</h2>';
      echo '<p style="text-align:center; color:black;">Her finner du agendaen for dette LAN-et</p>';
    echo '</center>';
  echo '</center>';

  $agendaList = AgendaHandler::getPublishedAgendas();

  if (!empty($agendaList)) {
  	$event = EventHandler::getCurrentEvent();
  	$day = 0;
    $variable = true;

    echo '<center style="padding-bottom:25px;">';
      echo '<h2 style="margin:0; padding-bottom:10px;">Fredag</h2>';
      echo '<div class="agenda_container">';

      	foreach ($agendaList as $agenda) {
          if ($variable) {
            echo '<div class="agenda_container_row Background1 Foreground2">';
              echo '<p class="agenda_container_row_text">' . date('H:i', $agenda->getStartTime()) . '</p>';
              echo '<p class="agenda_container_row_text">' . $agenda->getTitle() . '</p>';
              echo '<p class="agenda_container_row_text">' . $agenda->getDescription() . '</p>';
            echo '</div>';
          } else {
            echo '<div class="agenda_container_row Background2">';
              echo '<p class="agenda_container_row_text">' . date('H:i', $agenda->getStartTime()) . '</p>';
              echo '<p class="agenda_container_row_text">' . $agenda->getTitle() . '</p>';
              echo '<p class="agenda_container_row_text">' . $agenda->getDescription() . '</p>';
            echo '</div>';
          }
        }

      echo '</div>';
    echo '</center>';
  } else {
  	echo '<article class="contentBox">';
  		echo '<p>Agenda\'en for kommende arrangement har ikke blitt publisert enda!</p>';
  	echo '</article>';
  }

                /*
                <center style="padding-bottom:25px;">
                    <h2 style="margin:0; padding-bottom:10px;">Fredag</h2>
                    <div class="agenda_container">
                        <div class="agenda_container_row Background1 Foreground2">
                            <p class="agenda_container_row_text">19:30</p>
                            <p class="agenda_container_row_text">Påmeldingsfrist</p>
                            <p class="agenda_container_row_text">Påmeldingsfrist for både cs og lol</p>
                        </div>
                        <div class="agenda_container_row Background2">
                            <p class="agenda_container_row_text">20:15</p>
                            <p class="agenda_container_row_text">League of Legends</p>
                            <p class="agenda_container_row_text">Infomøte - Ved game</p>
                        </div>
                        <div class="agenda_container_row Background1 Foreground2">
                            <p class="agenda_container_row_text">20:30</p>
                            <p class="agenda_container_row_text">League of Legends</p>
                            <p class="agenda_container_row_text">Gruppespill Runde 1</p>
                        </div>
                        <div class="agenda_container_row Background2">
                            <p class="agenda_container_row_text">20:45</p>
                            <p class="agenda_container_row_text">CS:GO</p>
                            <p class="agenda_container_row_text">Infomøte - Ved game</p>
                        </div>
                        <div class="agenda_container_row Background1 Foreground2">
                            <p class="agenda_container_row_text">21:00</p>
                            <p class="agenda_container_row_text">CS:GO</p>
                            <p class="agenda_container_row_text">Gruppespill Runde 1</p>
                        </div>
                        <div class="agenda_container_row Background2">
                            <p class="agenda_container_row_text">21:30</p>
                            <p class="agenda_container_row_text">League of Legends</p>
                            <p class="agenda_container_row_text">Gruppespill Runde 2</p>
                        </div>
                        <div class="agenda_container_row Background1 Foreground2">
                            <p class="agenda_container_row_text">22:00</p>
                            <p class="agenda_container_row_text">CS:GO</p>
                            <p class="agenda_container_row_text">Gruppespill Runde 2</p>
                        </div>
                        <div class="agenda_container_row Background2">
                            <p class="agenda_container_row_text">22:30</p>
                            <p class="agenda_container_row_text">League of Legends</p>
                            <p class="agenda_container_row_text">Gruppespill Runde 3</p>
                        </div>
                    </div>
                </center>
                */
?>
