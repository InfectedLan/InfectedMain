<?php
require_once 'handlers/gamehandler.php';
?>

<div class="contentTitleBox">
	<h1>Clan registrering</h1>
</div>
<article class="contentBox">
	<script src="scripts/game-application.js"></script>
	<p>Registrer din clan her. Dere må registrere dere en gang per spill dere skal spille compo i.</p><br>
	
	<form class="game-application-add" name="input"  method="post">
		<table>
			<tr>
				<td>Clanen's navn:</td>
				<td><input type="text" name="name"></td>
			</tr>
			<tr>
				<td>Clan tag:</td>
				<td><input type="text" name="tag"></td>
			</tr>
			<tr>
				<td>Kontaktperson's navn:</td>
				<td><input type="text" name="contactname"></td>
			</tr>
			<tr>
				<td>Kontaktperson's nick:</td>
				<td><input type="text" name="contactnick"></td>
			</tr>
			<tr>
				<td>Telefon:</td>
				<td><input type="text" name="phone"></td>
			</tr>
			<tr>
				<td>E-post:</td>
				<td><input type="email" name="email"></td>
			</tr>
			<tr>
				<td>Spill:</td>
				<td>
					<?php
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
					?>
				</td>
			</tr>
			<tr>
				<td><input type="submit" value="Meld på"></td>
			</tr>
		</table>
	</form>
</article>