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

require_once 'handlers/grouphandler.php';

echo '<center class="wrapper">';
  echo '<div id="Overview_Post">';
    echo '<i id="main_emblem" style=" padding:10px; padding-bottom:20px; border-bottom:white solid 1px; font-size:128px;" class="fa fa-users Foreground2 TopSymbol" aria-hidden="true"></i>';
    echo '<h1 style="color:white;">Crew</h1>';
    echo '<h3 style="color:white;">Her vil du se hvilke crew som finnes, og informasjon om dem</h3>';
  echo '</div>';
echo '</center>';

echo '<div id="gen_information" class="Background2">';
  echo '<center class="Banner_Post">';
    echo '<center style="margin:0 auto; display:inline-block; padding-top:25px; padding-bottom:25px;">';
      echo '<i class="fa fa-info-circle fa-5x Foreground1" aria-hidden="true"></i>';
      echo '<h2 style="color:black;">Generelt om Crewene</h2>';
      echo '<p style="text-align:center; color:black;">Her vil du se hvilke crew som er hos infected</p>';
      echo '<p style="text-align:center; color:black;">Hvis du ønsker å delta i et crew, gå til crew siden.</p>';
      echo '<p style="text-align:center; color:black;">Det kan du gjøre ved å benytte crew linken på toppen av siden</p>';
    echo '</center>';
  echo '</center>';
  echo '<div class="information_content_container">';

  $groupList = GroupHandler::getGroups();

  if (!empty($groupList)) {
    foreach ($groupList as $group) {
      echo '<div class="information_content">';
        echo '<div class="information_content_textholder">';
          echo '<h3>' . $group->getTitle() . '</h3>';
          echo '<p>' . $group->getDescription() . '</p>';
        echo '</div>';
      echo '</div>';
    }
  } else {
    echo '<div class="information_content">';
        echo '<div class="information_content_textholder">';
          echo '<h3>Ingen crew ble funnet</h3>';
          echo '<p>Vennligst prøv igjen senere</p>';
        echo '</div>';
      echo '</div>';
  }

  echo '</div>';
echo '</div>';
?>
