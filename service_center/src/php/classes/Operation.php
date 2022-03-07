<?php

	require_once 'Database.php';

	class Operation {
		private $db;

		public function __construct() {
		    $this->db = new Database;
		}

		private function getId() {
		    return $this->db->lastId();
		}

		public function get($what) {
		    if ($what == 'all') $condition = "1=1";
		    else if ($what == 'finished') $condition = "o.date_delivery IS NOT NULL"; 
		    else if ($what == 'active') $condition = "o.date_delivery IS NULL";

		    $res = $this->db->getRows(
			"operation o JOIN device d ON o.device_id = d.sn JOIN slot s ON s.id = o.slot_id",
			"d.client_id, d.brand, d.model, d.sn, o.*, s.wall, s.row, s.colmn, (o.total_cost+o.labor)+(((o.total_cost+o.labor)*o.vat)/100) AS total",
			$condition
		    );

		    return $res;
		}

		public function insert($vat, $labor, $slot, $dev, $tech) {
		    $res = $this->db->insert(
			'operation',
			'vat, labor, slot_id, device_id, technician_id',
			"$vat, $labor, $slot, '$dev', '$tech'"
		    );

		    return ($res ? $this->getId() : null);
		}

		public function delivery($id) {
		    $res = $this->db->update(
			'operation',
			"date_delivery='" . date('Y-m-d H:i:s') . "'",
			"id = $id"
		    );

		    return $res;
		}

		public function stats_monthly_amount() {
		    $res = $this->db->getRows(
			"operation",
			"SUM(calculateVAT(total_cost, labor, vat)) AS costo_mensile",
			"MONTH(date_delivery) = MONTH(CURRENT_DATE()) AND date_delivery IS NOT NULL"
		    );

		    return ($res ? $res[0]['costo_mensile'] : null);
		}

		public function stats_active_technician() {
		    $res = $this->db->getRows(
			"operation",
			"technician_id",
			"1=1",
			"technician_id",
			"COUNT(id) = (
			    SELECT MAX(counting)
			    FROM (
				SELECT COUNT(id) AS counting
				FROM operation
				WHERE MONTH(date_pickup) = MONTH(CURRENT_DATE)
				GROUP BY technician_id
			    ) AS c
			)"
		    );

		    return ($res ? $res[0]['technician_id'] : null);
		}

		public function stats_monthly_mostexp() {
		    $res = $this->db->getRows(
			"operation",
			"*",
			"(calculateVAT(total_cost, labor, vat)) = (
			    SELECT MAX(total)
			    FROM (
				SELECT (calculateVAT(total_cost, labor, vat)) AS total
				FROM operation
				WHERE date_delivery IS NOT NULL AND MONTH(date_pickup) = MONTH(CURRENT_DATE)
			    ) AS t
			)"
		    );

		    return ($res ? $res[0]['id'] : null);
		}
		
	}

?>
