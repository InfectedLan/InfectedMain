<?php
require_once 'database.php';

class Utils {
	private $database;
	
	public function Utils() {
		$this->database = new Database();
	}
	
	public function getCurrentEvent() {
		$event = end($this->database->getEvents());
	
		return $event;
	}
	
	public function getDayFromInt($day) {
		$dayList = array('Mandag', 
					'Tirsdag', 
					'Onsdag', 
					'Torsdag', 
					'Fredag', 
					'Lørdag',
					'Søndag');
		
		return $dayList[$day - 1];
	}
	
	public function getMonthFromInt($month) {
		$monthList = array('Januar', 
					'Februar', 
					'Mars', 
					'April', 
					'Mai', 
					'Juni', 
					'Juli', 
					'August', 
					'September', 
					'Oktober', 
					'November', 
					'Desember');
		
		return $monthList[$month - 1];
	}
	
	public function isAuthenticated() {
		return isset($_SESSION['user']);
	}
	
	public function getUser() {
		return $this->isAuthenticated() ? $_SESSION['user'] : null;
	}
	
	public function hasPermission($permission) {
		return $this->database->getPermission($this->getUser()->getUsername(), $permission);
	}
}
?>