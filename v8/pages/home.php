<?php
/**
 * This file is part of InfectedMain.
 *
 * Copyright (C) 2013-2016 Infected <http://infected.no/>.
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

echo '<center class="wrapper">';
  echo '<div id="Overview_Post">';
    echo '<img class="Infected_logo" alt="Infected Logo" src="Resources\img\infected_logo.png" style=" padding:10px; padding-bottom:20px; border-bottom:white solid 1px;">';
    echo '<h1 style="color:white;">Delta på ett av Akershus største LAN-party</h1>';
    echo '<h3 style="color:white;">Vi ønsker alle som er interresert, velkommen!</h3>';

    $event = EventHandler::getCurrentEvent();

    echo '<center style="padding: 10px;">';
      echo '<div style="display: inline-block;">';

        if ($event->isBookingTime()) {
          if (!empty($event->getAvailableTickets())) {
            echo '<a class="no_a Background1" href="https://tickets.infected.no" style="margin:20px;">';
              echo '<p style="padding:10px; text-align: center;">Bestill billett</p>';
            echo '</a>';

            echo '<div>';


              echo '<p style="text-align:center; font-size:32px; display:inline-block; vertical-align: super" class="Foreground2">';
                echo $event->getAvailableTickets();
              echo '</p>';

              echo '<p style="text-align:center; font-size:64px; display:inline-block; vertical-align: sub; margin-left:10px; margin-right:10px;" class="Foreground2">/</p>';

              echo '<p style="text-align:center; font-size:32px; display:inline-block; vertical-align: super" class="Foreground2">';
                echo $event->getParticipants();
              echo '</p>';

            echo '</div>';

          } else {
            echo '<p style="color:white;background-color: #990000; padding: 20px;margin-bottom: 10px;text-align: center; cursor: default;">Arrangemanget er utsolgt</p>';
            echo '<p style="color:white;padding-top: 5px;text-align: center;">Billettene til LAN-et er utsolgt</p>';
          }
        } else {
          echo '<p style="color:white;background-color: #696969; padding: 20px;margin-bottom: 10px;text-align: center; cursor: default;">Billetter er ikke tilgjengelig</p>';
          echo '<p style="color:white;padding-top: 5px;text-align: center;">Billettene til LAN-et er ikke tilgjengelig enda</p>';
        }

      echo '</div>';
    echo '</center>';
  echo '</div>';
  echo '<center class="Banner_Post Background1">';
    echo '<center style="margin:0 auto; display:inline-block; padding-top:25px; padding-bottom:25px;">';
      echo '<h2 style="color: white;">Arrangementet</h2>';

      $event = EventHandler::getCurrentEvent();
      $ticketText = $event->getTicketCount() > 1 ? 'billett' : 'billetter';

      echo '<p style=" text-align: center; color: white; margin: 5px 0;">';
        echo 'Holdes fra ' . DateUtils::getDayFromInt(date('w', $event->getStartTime())) . ' ' . date('d', $event->getStartTime()) . '. ' . (date('m', $event->getStartTime()) != date('m', $event->getEndTime()) ? DateUtils::getMonthFromInt(date('m', $event->getStartTime())) : null) . ' til ' . DateUtils::getDayFromInt(date('w', $event->getEndTime())) . ' ' . date('d', $event->getEndTime()) . '. ' . DateUtils::getMonthFromInt(date('m', $event->getEndTime())) . '.';
      echo '</p>';
      echo '<p class="Foreground2" style="text-align:center; margin: 5px 0;">Arrangementet vil foregå i ' . $event->getLocation()->getTitle() . ', dørene åpner kl. ' . date('H:i', $event->getStartTime()) . '.</p>';
      echo '<p style="text-align: center; color: white; margin: 5px 0;">';
        echo 'Pris per billett er <strong>' . $event->getTicketType()->getPrice() . ',-</strong> (Inkluderer medlemskap i Radar).' . '<br>';
      echo '</p>';
      echo '<p style="text-align: center; color: white;">';

        if ($event->isBookingTime()) {
          if (!empty($event->getAvailableTickets())) {
            echo 'Det er <b>' . $event->getAvailableTickets() . '</b> av <b>' . $event->getParticipants() . '</b> ' . $ticketText . ' igjen.';
          } else {
            echo 'Det er ingen billetter igjen';
          }
        } else {
          $currentDate = date('Y-m-d');
          $tomorrowDate = date('Y-m-d', strtotime('+1 day', strtotime($currentDate)));
          $bookingDate = date('Y-m-d', $event->getBookingTime());
          $bookingDateFormattedText = date('d', $event->getBookingTime()) . '. ' . DateUtils::getMonthFromInt(date('m', $event->getBookingTime()));
          $ticketSaleStartDate = $currentDate == $bookingDate ? 'i dag' : ($tomorrowDate == $bookingDate ? 'i morgen' : $bookingDateFormattedText);

          echo 'Billettsalget starter ' . $ticketSaleStartDate . ' kl. '  . date('H:i', $event->getBookingTime());
        }

      echo '</p>';

    echo '</center>';
  echo '</center>';
  ?>
  <div id="General_information" class="Background2">
    <center class="Banner_Post">
      <center style="margin:0 auto; display:inline-block; padding-top:25px; padding-bottom:25px;">
        <i class="fa fa-info-circle fa-5x Foreground1" aria-hidden="true"></i>
        <h2 style="color:black;">Informasjon</h2>
        <p style="text-align:center; color:black;">Vi har noen regler og forslag.</p>
        <p style="text-align:center; color:black;">Det er viktig at du er klar over reglene til arrangemanget</p>
      </center>
    </center>
    <center style=" padding-top:50px; padding-bottom:50px; min-height:100px;">
      <div class="Banner_Info">
        <i class="fa fa-shield fa-4x Foreground1" aria-hidden="true"></i>
        <h3 style="color:black;">Regler og sikkerhet</h3>
        <div class="Banner_Info_Desc">
          <p style="text-align:center;">Rader er et <strong>rusfritt</strong> området, dette <strong style="color:red;">inkluderer snus og røyk</strong>. Det er ikke lov å røyke eller snuse under Infected</p>
        </div>
        <a class="no_a Background1" href="pages/security.html" style=" margin:20px;">
          <p>Les mer</p>
        </a>
      </div>
      <div class="Banner_Info" >
        <i class="fa fa-suitcase fa-4x Foreground1" aria-hidden="true"></i>
        <h3 style="color:black">Pakkeliste</h3>
        <div class="Banner_Info_Desc">
          <p style="text-align:center;">Vi i infected crewet har laget en hendig pakkliste over ting mang bør ha med på LAN</p>
          <p style="text-align:center;">Klikk les mer for å se listen</p>
        </div>
        <a class="no_a Background1" href="pages/packing.html" style=" margin:20px;">
          <p>Les mer</p>
        </a>
      </div>
      <div class="Banner_Info">
        <i class="fa fa-child fa-4x Foreground1" aria-hidden="true"></i>
        <h3 style="color:black">For foreldre og foresatte</h3>
        <div class="Banner_Info_Desc">
          <p style="text-align:center;">Nervøs for å sende barnet ditt på sitt første LAN? Nyskjerrig på hva et LAN er? Klikk les mer, for mer informasjon</p>
        </div>
        <a class="no_a Background1" href="pages/guardians.html" style=" margin:20px;">
          <p>Les mer</p>
        </a>
      </div>
    </center>
  </div>
  <center class="Banner_Post Background1">
    <center style="margin:0 auto; display:inline-block; padding-top:25px; padding-bottom:25px;">
      <h2 style="color:white;">Gjennomføring</h2>
      <p class="Banner_Post_P" style="text-align:center; color:White;">Arrangementet gjennomføres første helg av høstferien og vinterferien. Dørene åpner 18:00, men det lønner seg å komme i god tid før dette om du ønsker å komme raskt i gang. Det tar tid å komme inn, og du må beregne litt ventetid.</p>
    </center>
  </center>
  <center class="Background2" style="padding-top:50px; padding-bottom:50px; min-height:100px;">
    <div class="Banner_Info">
      <i class="fa fa-trophy fa-4x Foreground1" aria-hidden="true"></i>
      <h3>Konkurranser</h3>
      <div class="Banner_Info_Desc">
        <p style="text-align:center;">Under LAN-et vil det arrageres konkurranser, oversikten over spillene det er konkurranse i vil være tilgjengelig her</p>
      </div>
      <a class="no_a Background1" href="pages/competition.html" style=" margin:20px;">
        <p style="padding:10px;">Se konkurransene</p>
      </a>
    </div>
    <div class="Banner_Info" >
      <i class="fa fa-ticket fa-4x Foreground1" aria-hidden="true"></i>
      <h3>Billetter</h3>
      <div class="Banner_Info_Desc">
        <p style="text-align:center;">Billetter til infected kan bestilles på vår ticket side</p>
        <p style="text-align:center;">Prisen per billett er på: <strong><?php echo $event->getTicketType()->getPrice(); ?>,-</strong></p>
        <?php
          echo '<p style="text-align:center;">';
          if ($event->isBookingTime()) {
            if (!empty($event->getAvailableTickets())) {
              echo 'Det er <strong>' . $event->getAvailableTickets() . '</strong> av <strong>' . $event->getParticipants() . '</strong> ' . $ticketText . ' igjen';
            } else {
              echo 'Det er ingen billetter igjen';
            }
          } else {
            $currentDate = date('Y-m-d');
            $tomorrowDate = date('Y-m-d', strtotime('+1 day', strtotime($currentDate)));
            $bookingDate = date('Y-m-d', $event->getBookingTime());
            $bookingDateFormattedText = date('d', $event->getBookingTime()) . '. ' . DateUtils::getMonthFromInt(date('m', $event->getBookingTime()));
            $ticketSaleStartDate = $currentDate == $bookingDate ? 'i dag' : ($tomorrowDate == $bookingDate ? 'i morgen' : $bookingDateFormattedText);

            echo 'Billettsalget starter ' . $ticketSaleStartDate . ' kl. '  . date('H:i', $event->getBookingTime());
          }
          echo '</p>';
        ?>

      </div>
      <a class="no_a Background1" href="https://tickets.infected.no" style=" margin:20px;">
        <p style="padding:10px;">Bestill billett</p>
      </a>
      <?php
          /*echo '<p style="display: table; text-align:center;">';

          echo '</p>';*/
      ?>
    </div>
    <div class="Banner_Info">
      <i class="fa fa-calendar-o fa-4x Foreground1" aria-hidden="true"></i>
      <h3>Agenda</h3>
      <div class="Banner_Info_Desc">
        <p style="text-align:center;">Agendaen vil vis hva som skjer på infected og når det vil skje. Dette inkluderer konkurranser og frister</p>
      </div>
      <a class="no_a Background1" href="pages/agenda.html" style=" margin:20px;">
        <p style="padding:10px;">Se agendaen</p>
      </a>
    </div>
  </center>
</center>
