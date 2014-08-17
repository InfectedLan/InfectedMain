<?php
require_once 'handlers/gamehandler.php';

echo '<div class="contentTitleBox">';
	echo '<h1>Clan registrering</h1>';
echo '</div>';
echo '<article class="contentBox">';
	echo '<script src="scripts/game-application.js"></script>';
	echo '<p>Registrer din clan her. Dere må registrere dere en gang per spill dere skal spille compo i.</p><br>';
	
	echo '<form class="game-application-add" method="post">';
		echo '<table>';
			echo '<tr>';
				echo '<td>Clanen\'s navn:</td>';
				echo '<td><input type="text" name="name" required></td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>Clan tag:</td>';
				echo '<td><input type="text" name="tag" required></td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>Kontaktperson\'s navn:</td>';
				echo '<td><input type="text" name="contactname" required></td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>Kontaktperson\'s nick:</td>';
				echo '<td><input type="text" name="contactnick" required></td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>Telefon:</td>';
				echo '<td><input type="tel" name="phone" required></td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>E-post:</td>';
				echo '<td><input type="email" name="email" required></td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>Spill:</td>';
				echo '<td>';
					$gameList = GameHandler::getPublishedGames();
					
					if (!empty($gameList)) {
						foreach ($gameList as $game) {
							if ($game->getDeadline() > date('U')) {
								echo '<input type="radio" name="gameId" value="' . $game->getId() . '">' . $game->getTitle() . '<br>';
							} else {
								echo $game->getTitle() . ' (Påmeldingsfristen er ute!)<br>';
							}
						}
					} else {
						echo '<article class="contentBox">';
							echo '<p>Ingen spill publisert enda, prøv igjen senere.</p>';
						echo '</article>';
					}
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td><input type="submit" value="Meld på"></td>';
			echo '</tr>';
		echo '</table>';
	echo '</form>';
echo '</article>';
?>