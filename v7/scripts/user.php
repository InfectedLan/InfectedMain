<?php
class User {
	private $id;
	private $firstname;
	private $lastname;
	private $username;
	private $password;
	private $email;
	
	public function User($id, $firstname, $lastname, $username, $password, $email) {
		$this->id = $id;
		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->username = $username;
		$this->password = $password;
		$this->email = $email;
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function getFirstname() {
		return $this->firstname;
	}
	
	public function getLastname() {
		return $this->lastname;
	}
	
	public function getUsername() {
		return $this->username;
	}
	
	public function getPassword() {
		return $this->password;
	}
	
	public function getEmail() {
		return $this->email;
	}
}
?>