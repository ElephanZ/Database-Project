<?php

	require_once 'Database.php';

	class Reparation {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

        public function insert($trouble, $note, $op_id) {
            $this->db->insert(
				'reparation',
                'trouble, note, operation_id',
                "'$trouble', '$note', $op_id"
            );
        }
		
	}

?>