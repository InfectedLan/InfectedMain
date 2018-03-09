<?php
/**
 * This file is part of InfectedMain.
 *
 * Copyright (C) 2018 Infected <https://infected.no/>.
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

require_once 'handlers/compohandler.php';

echo '<div class="wrapper" style="text-align: center;">';
    echo '<div id="Overview_Post" class="subPageHeader">';
        echo '<i id="main_emblem" style=" padding:10px; padding-bottom:20px; border-bottom:white solid 1px; font-size:128px;" class="fa fa-gamepad Foreground2 TopSymbol" aria-hidden="true"></i>';
            echo '<h1 style="color:white;">Konkurranser</h1>';
            echo '<h3 style="color:white;">Reglene og spillene vises under</h3>';
        echo '</div>';
    echo '</div>';

    echo '<div style="padding-top:45px;" id="gen_information" class="Background2">';
        echo '<div class="Banner_Post" style="text-align: center;">';
            echo '<div style="margin:0 auto; display:inline-block; padding-top:25px; padding-bottom:25px; text-align: center;">';
                echo '<i class="fa fa-info-circle fa-5x Foreground1" aria-hidden="true"></i>';
                echo '<h2 style="color:black;">Generell informasjon</h2>';
                echo '<p style="text-align:center; color:black;">Det er viktig at spillerne er klare over reglene</p>';
                echo '<p style="text-align:center; color:black;">Vennligst <strong>les reglene</strong>, og gjør deg kjent med dem</p>';
            echo '</div>';
        echo '</div>';
        echo '<div class="information_content_container">';
            echo '<div class="information_content">';
                echo '<div class="information_content_textholder">';
                    echo '<h3>Generelt for alle spill</h3>';
                    echo '<p>Etter matchen må begge lagene melde resultatet til game crew.
                             Når du skal kontakte en game admin eller en som representerer det andre laget som spiller så introduser deg med nick så man vet hvem du er. Du må også si klart hvilket lag du spiller for.</p>';
                echo '</div>';
            echo '</div>';
        echo '<div class="information_content">';
            echo '<div class="information_content_textholder">';
                echo '<h3>Double-Elimination</h3>';
                echo '<p>Begge compoene blir det spilt double-elimination. Det er et spill oppsett som går på vanlig cup system, men du har mulighet til og tape en kamp. Alle starter i Higher bracket, men hvis du taper en match i higher går man ned i det som heter lower bracket. Taper du etter du har kommet ned i lower er du ute av compoen. For å komme til finalen må du enten vinne Higher bracket eller lower bracket. </p>';
            echo '</div>';
        echo '</div>';
        echo '<div class="information_content">';
            echo '<div class="information_content_textholder">';
                echo '<h3>Klager / annet</h3>';
                echo '<p>Hvis det er noe uklart ved disse reglene så er det ditt ansvar og spørre en i game crew for å finne ut av det du lurer på. Game crew vil være tilgjengelig til enhver tid.</p>';
            echo '</div>';
        echo '</div>';
        echo '<div class="information_content">';
            echo '<div class="information_content_textholder">';
                echo '<h3>Spillere</h3>';
                echo '<p>Bare spillere som er registrert på laget får lov til å spille. En spiller kan bare være på et lag, som betyr at du ikke kan spille på to forskjellige lag i en og samme compo. Mangler dere en person ved oppmøte så kan dere spørre game crew om dere får lov til å bruke en step til spilleren kommer tilbake. Eller spille med en mindre.</p>';
            echo '</div>';
        echo '</div>';
        echo '<div class="information_content">';
            echo '<div class="information_content_textholder">';
                echo '<h3>Oppmøte</h3>';
                echo '<p>Hvis det mangler spillere vil de ha 10 minutter på seg til og bli klare. Hvis et av lagene ikke har alle klar innen tiden så kan de spille med færre spillere.
                         Crew kan delta som andre deltagere.</p>';
            echo '</div>';
        echo '</div>';
        echo '<div class="information_content">';
            echo '<div class="information_content_textholder">';
                echo '<h3>Viktig</h3>';
                echo '<p>Infected forbeholder seg retten til å endre/heve/legge til regler på et hvilket som helst tidspunkt.
                         Vi forbeholder oss også retten til å vike fra å dømme etter reglene i veldig ekstreme situasjoner.</p>';
            echo '</div>';
        echo '</div>';
    echo '</div>';
echo '</div>';

$compoList = CompoHandler::getCompos();

if (!empty($compoList)) {
    echo '<div class="Banner_Post Background1" style="text-align: center;">';
        echo '<div style="margin:0 auto; display:inline-block; padding-top:25px; padding-bottom:25px; text-align: center;">';
            echo '<h2 class="Foreground2">Premier</h2>';

            foreach ($compoList as $compo) {
                echo '<div class="agenda_container_row Background1 Foreground2" style="display: table-row;">';
                    echo '<p class="agenda_container_row_text">' . $compo->getTitle() . '</p>';
                    echo '<p class="agenda_container_row_text">' . $compo->getDescription() . '</p>';

                    /*
                    echo '<p class="agenda_container_row_text">1. Plass 7500,-</p>';
                    echo '<p class="agenda_container_row_text">2. Plass 2500,-</p>';
                    echo '<p class="agenda_container_row_text">Max 16 lag</p>';
                    */
                echo '</div>';
            }

        echo '</div>';
    echo '</div>';
}

$compoList = CompoHandler::getCompos();

if (!empty($compoList)) {
    echo '<div class="Banner_Post Background2" style="text-align: center;">';
        echo '<div style="margin:0 auto; display:inline-block; padding-top:25px; padding-bottom:25px; text-align: center;">';
            echo '<h2 class="Foreground3">Spillene</h2>';
            echo '<div style=" padding-top:50px; padding-bottom:50px; min-height:100px; text-align: center;">';

			    foreach ($compoList as $compo) {
                    $gameIcon = "images/games/";

                    if ($compo->getTitle() == "Counter-Strike: Global Offensive") {
                        $gameIcon = $gameIcon . "csgo.png";
                    } else if ($compo->getTitle() == "League of Legends") {
                        $gameIcon = $gameIcon . "lol.png";
                    } else if ($compo->getTitle() == "Overwatch") {
                        $gameIcon = $gameIcon . "overwatch.png";
                    }

                echo '<div class="Banner_Info">';
                    echo '<img style="padding-bottom:20px;" class="GameLogo" src="'.$gameIcon.'"  />';
                    /*echo '<h3 class="Foreground2">'. $compo->getTitle() .'</h3>';*/
                    echo '<div class="Banner_Info_Desc">';
                        echo '<p style="text-align:center;" class="Foreground3">Ved å følge lenken under vil det vises hvordan spillet '. $compo->getTitle() .' skal settes opp.</p>';
                    echo '</div>';
                    echo '<a class="no_a Background1" href="pages/game/id/'. $compo->getId() .'.html" style=" margin:20px;">';
                        echo '<p class="Foreground2">Se informasjonen</p>';
                    echo '</a>';
                echo '</div>';
			}

            echo '</div>';
        echo '</div>';
    echo '</div>';
}
?>