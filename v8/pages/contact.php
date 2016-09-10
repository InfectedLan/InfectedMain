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

require_once 'handlers/sectionpagehandler.php';

echo '<center class="wrapper">';
  echo '<div id="Overview_Post">';
    echo '<i id="main_emblem" style="padding:10px; padding-bottom:20px; border-bottom:white solid 1px; font-size:128px;" class="fa fa-question Foreground2 TopSymbol" aria-hidden="true"></i>';
    echo '<h1 style="color:white;">Noe du lurer på?</h1>';
    echo '<h3 style="color:white;">Ta gjerne kontakt med oss!</h3>';
  echo '</div>';
echo '</center>';
echo '<div id="onsite_information" class="Background2">';

  $sectionPage = SectionPageHandler::getSectionPageByName('how-to-contact');

  if ($sectionPage != null) {
    echo $sectionPage->getSection();
  }

  echo '<center class="Background2" style="padding-top:50px; padding-bottom:50px; min-height:100px;">';
    echo '<div class="Banner_Info">';
      echo '<i class="fa fa-phone fa-4x Foreground1" aria-hidden="true"></i>';
      echo '<h3>Telefon</h3>';
      echo '<p style="text-align:center;">Du kan gjerne kontakte oss på telefon.</p>';
      echo '<p class="Background1 Foreground2" style="margin:20px; padding:10px; text-align: center;">99 76 77 45</p>';
    echo '</div>';
    echo '<div class="Banner_Info">';
      echo '<i class="fa fa-envelope-o fa-4x Foreground1" aria-hidden="true"></i>';
      echo '<h3>E-post</h3>';
      echo '<p style="text-align:center;">Du kan komme i kontakt med oss på e-post</p>';
      echo '<p class="Background1 Foreground2" style="margin:20px; padding:10px; text-align: center;">kontakt@infected.no</p>';
    echo '</div>';
  echo '</center>';
echo '</div>';
?>
