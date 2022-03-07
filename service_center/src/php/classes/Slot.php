<?php

	require_once 'Database.php';

	class Slot {
		private $db;

		public function __construct() {
		    $this->db = new Database;
		}

		public function getId($wall, $row, $col) {
		    $res = $this->db->getRows(
			'slot',
			'id',
			"wall=$wall AND row=$row AND colmn=$col"
		    );

		    return ($res && count($res) > 0 ? $res[0]['id'] : null);
		}

	}

?>
