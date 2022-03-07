<?php

	require_once 'Database.php';

	class Accessory {
		private $db;

		public function __construct() {
		    $this->db = new Database;
		}

		public function insert($name, $op_id, $dev_id, $descr) {
		    $this->db->insert(
					'accessory',
			'name, operation_id, device_id, note',
			"'$name', $op_id, '$dev_id', '$descr'"
		    );
		}
		
	}

?>
