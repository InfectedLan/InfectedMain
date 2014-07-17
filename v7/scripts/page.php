<?php
require_once 'utils.php';

class Page {
	private $utils;

	private $id;
	private $name;
	private $title;
	private $content;
	
	public function Page($id, $name, $title, $content) {
		$this->utils = new Utils();
		
		$this->id = $id;
		$this->name = $name;
		$this->title = $title;
		$this->content = $content;
	}
	
	public function display() {
		// Format the page with HTML.
		echo '<div class="contentTitleBox">';
			echo '<h1>';
				
				if ($this->utils->isAuthenticated()) {
					if ($this->utils->hasPermission('admin') || $this->utils->hasPermission('site-admin')) {
						echo '<form name="input" action="index.php?viewPage=edit-page&pageId=' . $this->getId() . '" method="post">';
							echo $this->getTitle();
							echo '<input style="float: right;" type="submit" value="Endre">';
						echo '</form>';
					}
				} else {
					echo $this->getTitle();
				}
			echo '</h1>';
		echo '</div>';
		
		echo $this->getContent();
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function getTitle() {
		return $this->title;
	}
	
	public function getContent() {
		return $this->content;
	}
}
?>