<?php

	define("CONFIG_DB_HOST", "localhost");
	define("CONFIG_DB_USER", "root");
	define("CONFIG_DB_PASSWORD", "");
	define("CONFIG_DB_NAME", "service_center");

	class Database {
		private $_database;
		private $lastQuery;

		public function __construct() {
			$this->_database = new mysqli(CONFIG_DB_HOST, CONFIG_DB_USER, CONFIG_DB_PASSWORD, CONFIG_DB_NAME);
			if ($this->_database->connect_error) die();
			$this->_database->set_charset("utf8");
		}

		private function query($sql) {
			$this->lastQuery = $this->_database->query($sql);
			if ($this->lastQuery) return $this->lastQuery;
		}

		private function fetchResult($query) {
			$result = array();
			while ($row = $query->fetch_assoc()) {
				foreach ($row as $key => $value) {
					if (is_null($row[$key])) continue;
					$row[$key] = htmlentities($value);
				}
				$result[] = $row;
			}
			
			return $result;
		}

		public function getRows($table, $fields, $where = null, $groupby = null, $having = null) {
			$sql = "SELECT $fields FROM $table";
			if ($where != null) $sql .= " WHERE $where";
			if ($groupby != null) $sql .= " GROUP BY $where";
			if ($having != null) $sql .= " HAVING $where";

 			$this->query($sql);
			if ($this->lastQuery) return $this->fetchResult($this->lastQuery);
			return false;
		}

		public function delete($table, $where) {
			$sql = "DELETE FROM $table WHERE $where";
 			$this->query($sql);
			if ($this->lastQuery) return true;
			return false;
		}

		public function insert($table, $set, $values) {
			$sql = "INSERT INTO $table ($set) VALUES ($values)";
 			$this->query($sql);
			if ($this->lastQuery) return true;
			return false;
		}

		public function update($table, $set, $values) {
			$sql = "UPDATE $table SET $set WHERE $values";
 			$this->query($sql);
			if ($this->lastQuery) return true;
			return false;
		}
	}

?>