<?php

	require_once 'Database.php';

	class Device {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		private function checkIfExists($sn) {
            $res = $this->db->getRows('device', 'sn', "sn='$sn'");
            return $res && count($res) > 0;
        }

        public function insertIfNotExists($sn, $brand, $model, $kind, $fc) {
            if ($this->checkIfExists($sn)) return;
            $this->db->insert('device', 'sn, brand, model, kind, client_id', "'$sn', '$brand', '$model', '$kind', '$fc'");
        }
		
	}

?>