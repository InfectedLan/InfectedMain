<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/handlers/gamehandler.php';
?>

<div class="contentTitleBox">
	<h1>Clan registrering</h1>
</div>
<article class="contentBox">
	<p>Registrer din clan her. Dere må registrere dere en gang per spill dere skal spille compo i.</p><br>

	<form name="input" action="scripts/process_gameApplication.php?action=1" method="post">
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
					
					foreach ($gameList as $game) {
						if ($game->getDeadline() > date('U')) {
							echo '<input type="radio" name="game" value="' . $game->getId() . '">' . $game->getTitle() . '<br>';
						} else {
							echo $game->getTitle() . ' (Påmeldingsfristen er ute!)<br>';
						}
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