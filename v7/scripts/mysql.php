<?php
require_once 'settings.php';

class MySQL {
	private $settings;
	
	public function MySQL() {
        $this->settings = new Settings();
    }
	
	public function open() {
		// Create connection
		$con = mysqli_connect($this->settings->host, $this->settings->username, $this->settings->password, $this->settings->database);
		$con->set_charset("utf8");
		
		// Check connection
		if (mysqli_connect_errno($con)) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		
		// Create tables if not exists
		foreach ($this->settings->tablesSql as $value) {
			mysqli_query($con, $value);
		}
		
		// Insert default data to tables if not already exists.
		foreach ($this->settings->tablesDataSql as $value) {
			mysqli_query($con, $value);
		}
		
		return $con;
	}
	
	public function close($con) {
		mysqli_close($con);
	}
}
?>