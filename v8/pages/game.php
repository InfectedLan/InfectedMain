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

require_once 'utils/dateutils.php';
require_once 'handlers/compohandler.php';
require_once 'handlers/pagehandler.php';
require_once 'handlers/eventhandler.php';

$event = EventHandler::getCurrentEvent();

$id = 0;


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $compo = CompoHandler::getCompo($_GET['id']);

    $page = PageHandler::getPageByName($compo->getName());

    $id = $_GET['id'];
}

$gameIcon = "images/games/";

if ($compo->getTitle() == "Counter-Strike: Global Offensive") {
    $gameIcon = $gameIcon . "csgo.png";
} else if ($compo->getTitle() == "League of Legends") {
    $gameIcon = $gameIcon . "lol.png";
}

echo '<div class="wrapper" style="text-align: center;">';
    echo '<div id="Overview_Post">';
        echo '<img class="Infected_logo" alt="Game Logo" src="'.$gameIcon.'" style=" padding:10px; padding-bottom:20px; border-bottom:white solid 1px;">';
        echo '<h1 style="color:white;"></h1>';

        if ($event->getBookingTime() <= time()) { // TODO: $event->isBookingTime() ?
            echo '<h3 style="color:white;">Påmeldingsfristen er ' . DateUtils::getDayFromInt(date('w', $compo->getRegistrationEndTime())) . ' ' . date('d.m.Y', $compo->getRegistrationEndTime()) . ' klokken ' . date('H:i', $compo->getRegistrationEndTime()) . '</h3>';
        } else {
            echo '<h3 style="color:white;">Påmeldingen åpner ' . DateUtils::getDayFromInt(date('w', $event->getBookingTime())) . ' ' . date('d.m.Y', $event->getBookingTime()) . ' klokken ' . date('H:i', $event->getBookingTime()) . '</h3>';
        }
    echo '</div>';
echo '</div>';

/// This checks the id, this should only be here while there is no real database content in test env.
if ($id == 7) {
echo '<div id="gen_information" class="Background2">';
    echo '<div class="Banner_Post" style="text-align: center;">';
        echo '<div style="margin:0 auto; display:inline-block; padding-top:25px; padding-bottom:25px; text-align: center;">';
            echo '<i class="fa fa-info-circle fa-5x Foreground1" aria-hidden="true"></i>';
            echo '<h2 style="color:black;">Regler</h2>';
            echo '<p style="text-align:center; color:black;">Det er viktig at spillerne er klare over reglene</p>';
            echo '<p style="text-align:center; color:black;">Vennligst <strong>les reglene</strong>, og gjør deg kjent med dem</p>';
        echo '</div>';
    echo '</div>';

    echo '<div class="information_content_container">';
        echo '<div class="information_content">';
            echo '<div class="information_content_textholder" style="padding-bottom:25px;">';
                echo '<h3 style="padding-bottom:25px;">Spill oppsett</h3>';
                echo '<div style="text-align:left;">';
                    echo '<i class="fa fa-caret-right bulletpoint_point" aria-hidden="true"></i>';
                    echo '<p class="bulletpoint_p">Konkurranse Mode: 5 on 5</p>';
                echo '</div>';
                echo '<div style="text-align:left;">';
                    echo '<i class="fa fa-caret-right bulletpoint_point" aria-hidden="true"></i>';
                    echo '<p class="bulletpoint_p">Maps: Dust2, Cache, Train, Mirage, Cobblestone, Nuke, Overpass</p>';
                echo '</div>';
                echo '<div style="text-align:left;">';
                    echo '<i class="fa fa-caret-right bulletpoint_point" aria-hidden="true"></i>';
                    echo '<p class="bulletpoint_p">Tickrate: 128</p>';
                echo '</div>';
                echo '<div style="text-align:left;">';
                    echo '<i class="fa fa-caret-right bulletpoint_point" aria-hidden="true"></i>';
                    echo '<p class="bulletpoint_p">Mode: Double Elimination</p>';
                echo '</div>';
                echo '<div style="text-align:left;">';
                    echo '<i class="fa fa-caret-right bulletpoint_point" aria-hidden="true"></i>';
                    echo '<p class="bulletpoint_p">Maks <strong>16 lag</strong></p>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</div>';


    echo '<div class="information_content_container">';
        echo '<div class="information_content">';
            echo '<div class="information_content_textholder">';
                echo '<h3>Generelt</h3>';
                echo '<p>Hver spiller skal ta Demo av matchen ved hjelp av Console kommandoen: record (Navn på record).</p>';
                echo '<p>Turneringen er i Double Elimination bracket-system. Dette betyr at alle lag kan tape én kamp uten å ryke ut av turneringen.</p>';
                echo '<p>Infected stiller med server til compoen.</p>';
                echo '<p>Spesial-filer er ikke tillatt. Spesial-filer er alle filer som forandrer eller erstatter de originale in-game-grafiske elementene, *gfc-filer eller lyder. Dette betyr også forandring av HUD, scoreboard og lyder.</p>';
                echo '<p>Hvis en bug eller ander ting blir misbrukt i spillet, blir dette sett på som regelbrudd og fører til tap av tre runder eller diskvalifisering. Game chief avgjør dette ut fra hvor grov hendelsen er.</p>';
                echo '<p>Bruk av jumpscript eller bruk av tredjeparts programmer som tukler med spillets funksjoner er forbudt, og kan føre til utestengelse.</p>';
                echo '<p>En kamp avsluttes når et lag har vunnet 16 runder. </p>';
            echo '</div>';
        echo '</div>';
    echo '</div>';
echo '</div>';
echo '<div id="gen_information" class="Background1">';
    echo '<div class="information_content_container" style="padding-top:25px; padding-bottom:25px;">';
        echo '<div class="information_content">';
            echo '<div class="information_content_textholder">';
                echo '<h3>Rates</h3>';
                echo '<p>Alle må ha riktige verdier i cfg fil, dette kan også gjøres gjennom konsoll.</p>';
                echo '<p>Dette kan du gjøre ved å skrive kommandoene rett inn i konsollen på cs:go.</p>';
                echo '<p>Slik gjør du det mulig å åpne konsollen</p>';
            echo '</div>';
        echo '</div>';
    echo '</div>';
echo '</div>';
?>

<div id="onsite_information" class="Background2">
    <div class="Banner_Post" style="text-align: center;">
        <div style="margin:0 auto; display:inline-block; padding-top:25px; padding-bottom:25px; text-align: center;">
            <i class="fa fa-exclamation-triangle fa-5x Foreground1" aria-hidden="true"></i>
            <h2 style="color:black;">Viktig</h2>
        </div>
    </div>
    <div class="information_content_container">
        <div class="information_content">
            <div class="information_content_textholder">
                <h3>Generelt for alle spill</h3>
                <p>Etter matchen må begge lagene melde resultatet til game crew. Når du skal kontakte en game admin eller en som representerer det andre laget som spiller så introduser deg med nick så man vet hvem du er. Du må også si klart hvilket lag du spiller for.</p>
            </div>
        </div>
        <div class="information_content">
            <div class="information_content_textholder">
                <h3>Generelt for alle spill</h3>
                <p>Etter matchen må begge lagene melde resultatet til game crew. Når du skal kontakte en game admin eller en som representerer det andre laget som spiller så introduser deg med nick så man vet hvem du er. Du må også si klart hvilket lag du spiller for.</p>
            </div>
        </div>
        <div class="information_content">
            <div class="information_content_textholder" style="padding-bottom:25px;">
                <p>Følgende oppførsel vil ikke bli tolerert, og vil få konsekvenser avhengig av hfor alvorlig tilffelt er.</p>
                <div style="text-align:left;">
                    <i class="fa fa-caret-right bulletpoint_point" aria-hidden="true"></i>
                    <p class="bulletpoint_p">Datamaskin med alt tilbehør.</p>
                </div>
                <div style="text-align:left;">
                    <i class="fa fa-caret-right bulletpoint_point" aria-hidden="true"></i>
                    <p class="bulletpoint_p">Nettverkskabel med en minumumslengde på fem meter.</p>
                </div>
                <div style="text-align:left;">
                    <i class="fa fa-caret-right bulletpoint_point" aria-hidden="true"></i>
                    <p class="bulletpoint_p">Strømpad, beregnet ett støpsel per person.</p>
                </div>
                <div style="text-align:left;">
                    <i class="fa fa-caret-right bulletpoint_point" aria-hidden="true"></i>
                    <p class="bulletpoint_p">Tannbørste og andre hygieneartikler.</p>
                </div>
                <div style="text-align:left;">
                    <i class="fa fa-caret-right bulletpoint_point" aria-hidden="true"></i>
                    <p class="bulletpoint_p">Penger.</p>
                </div>
                <div style="text-align:left;">
                    <i class="fa fa-caret-right bulletpoint_point" aria-hidden="true"></i>
                    <p class="bulletpoint_p">Vann eller brus.</p>
                </div>
                <div style="text-align:left;">
                    <i class="fa fa-caret-right bulletpoint_point" aria-hidden="true"></i>
                    <p class="bulletpoint_p">Eventuelle medisiner hvis man trenger det (Ta kontakt med crew hvis det er noe vi bør vite).</p>
                </div>
                <div style="text-align:left;">
                    <i class="fa fa-caret-right bulletpoint_point" aria-hidden="true"></i>
                    <p class="bulletpoint_p">Din billett.</p>
                </div>
                <div style="text-align:left;">
                    <i class="fa fa-caret-right bulletpoint_point" aria-hidden="true"></i>
                    <p class="bulletpoint_p">Sovepose.</p>
                </div>
                <div style="text-align:left;">
                    <i class="fa fa-caret-right bulletpoint_point" aria-hidden="true"></i>
                    <p class="bulletpoint_p">Legitimasjon.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
} else if ($id == 8) {
    echo '<div id="gen_information" class="Background2">';
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
}
?>