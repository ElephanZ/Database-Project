<?php

	require_once 'Database.php';

	class Client {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		private function checkIfExists($fc) {
		    $res = $this->db->getRows('client', 'fc', "fc='$fc'");
		    return $res && count($res) > 0;
		}

		public function insertIfNotExists($fc, $name, $sname, $dbirth) {
		    if ($this->checkIfExists($fc)) return;
		    $this->db->insert('client', 'fc, name, surname, date_birth', "'$fc', '$name', '$sname', '$dbirth'");
		}

		private function checkIfOwnContact($value, $fc) {
		    $res = $this->db->getRows('client c JOIN own o ON c.fc = o.client_id', 'contact_id', "contact_id='$value' AND client_id='$fc'");
		    return $res && count($res) == 1;
		}

		public function checkAndOwn($fc, $value) {
		    if ($this->checkIfOwnContact($value, $fc)) return;
		    $this->db->insert('own', 'contact_id, client_id', "'$value', '$fc'");
		}
		
	}

?>
