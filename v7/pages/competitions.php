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

require_once 'handlers/pagehandler.php';
require_once 'handlers/compohandler.php';

$page = PageHandler::getPageByName('competitions-general');

if ($page != null) {
	echo '<div class="contentTitleBox">';
		echo '<h1>' . $page->getTitle() . '</h1>';
	echo '</div>';
	echo '<article class="contentBox">';
		echo '<p><b>Det blir compoer i følgende spill:</b></p>';

		$compoList = CompoHandler::getCompos();

		if (!empty($compoList)) {
			echo '<ul>';
				foreach ($compoList as $compo) {
					echo '<li>' . $compo->getTitle() . ' ' . $compo->getDescription() . '</li>';
				}
			echo '</ul>';
		} else {
			echo '<p>Ingen spill er lagt til i systemet enda.</p>';
		}
	echo '</article>';

	echo $page->getContent();
}
?>
