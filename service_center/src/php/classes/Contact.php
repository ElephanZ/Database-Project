<?php

	require_once 'Database.php';

	class Contact {
		private $db;

		public function __construct() {
		    $this->db = new Database;
		}

		private function checkIfExists($value) {
		    $res = $this->db->getRows('contact', 'value', "value='$value'");
		    return $res && count($res) > 0;
		}

		public function insertIfNotExists($kind, $value) {
		    if ($this->checkIfExists($value)) return;
		    $this->db->insert('contact', 'kind, value', "'$kind', '$value'");
		}
		
	}

?>
