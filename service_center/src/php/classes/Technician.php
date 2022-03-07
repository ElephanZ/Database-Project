<?php

	require_once 'Database.php';

    	session_start();

	class Technician {
		private $db;

		public function __construct() {
		    $this->db = new Database;
		}

		public function check($fcode, $psw) {
		    $res = $this->db->getRows('technician', 'fc', "fc = '$fcode' AND password = '$psw'");
		    return $res && count($res) == 1;
		}

		public function login() {
		    $_SESSION['isLogged'] = true;
		    $_SESSION['fc'] = $_POST['fc'];
		    header('Location: index.php');
		}
		
	}

?>
