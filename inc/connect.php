<?php 
	interface QL{
		static function connect();
		static function disconnect();
		function getDataAll($table);
		function getDataLimit($table, $page, $limit);
		function getRowByWhere($table, $id, $field);
		function getDataByWhere($table, $where, $field);
		function countData($table, $field);
		function insert($table, $data); 
		function remove($table, $id);
		function update($table, $id, $data);
	}
	
	/**
	 *  Connect to MYSQL (DB: QL_NHAHANG)
	 *  Author: VHM
	 */
	class Connection implements QL
	{
		private static $conn = NULL;
		private static $pre = NULL;
		private static $sql = NULL;
		public static $limit = 6;

		function __construct()
		{
			self::connect();
		}

		public static function connect()
		{
			if(self::$conn === NULL){
				try {
					self::$conn = new PDO('mysql:host=' . HOSTNAME . ';dbname=' . DBNAME, USERNAME, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'));
					self::$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					return self::$conn;
				} catch (PDOException $e) {
					echo $e -> getMessage();
				}
			}
		}

		public static function disconnect()
		{
			if(self::$conn !== NULL) self::$conn = NULL;
		}

		public function getDataAll($table, $orderBy = '', $sort = 'ASC')
		{
			if(self::$conn !== NULL){
				if($table === 'product'){
					$datas = [];
					if($orderBy !== ''){
						self::$sql = "SELECT * FROM {$table} ORDER BY {$orderBy} {$sort}";
					} else {
						self::$sql = "SELECT * FROM {$table}";
					}
					self::$pre = self::$conn -> prepare(self::$sql);
					self::$pre->execute();
					while ($row = self::$pre -> fetch(PDO::FETCH_OBJ)) {
						$datas[] = $row;
					}
					return $datas;
				}
			} else{ return 0; }
		}

		public function getRowByWhere($table, $where, $field)
		{
			if(self::$conn !== NULL){
				if($table === 'product'){
					if(is_array($field)){ $field = implode(',', $field); }
					self::$sql = "SELECT {$field} FROM {$table} WHERE {$where}";
					self::$pre = self::$conn -> prepare(self::$sql);
					self::$pre->execute();
					return self::$pre->fetch();
				}
			} else{ return 0; }
		}

		public function getDataByWhere($table, $where, $field)
		{
			if(self::$conn !== NULL){
				if($table === 'product'){
					$datas = [];
					if(is_array($field)){ $field = implode(',', $field); }
					self::$sql = "SELECT {$field} FROM {$table} WHERE {$where}";
					self::$pre = self::$conn -> prepare(self::$sql);
					self::$pre->execute();
					while ($row = self::$pre -> fetch(PDO::FETCH_OBJ)) {
						$datas[] = $row;
					}
					return $datas;
				}
			} else{ return 0; }
		}

		public function getDataLimit($table, $page = 0, $where = '')
		{
			if(self::$conn !== NULL){
				$limit = self::$limit;
				if($table === 'product'){
					$from = ($limit * $page) - $limit;
					$datas = [];
					if($page == 0){
						if($where !== ''){
							self::$sql = "SELECT * FROM {$table} WHERE {$where} LIMIT {$page}, {$limit}";
						} else{
							self::$sql = "SELECT * FROM {$table} LIMIT {$page}, {$limit}";
						}
					} else{
						if($where !== ''){
							self::$sql = "SELECT * FROM {$table} WHERE {$where} LIMIT {$from}, {$limit}";
						} else{
							self::$sql = "SELECT * FROM {$table} LIMIT {$from}, {$limit}";
						}
					}
					self::$pre = self::$conn -> prepare(self::$sql);
					self::$pre->execute();
					while ($row = self::$pre -> fetch(PDO::FETCH_OBJ)) {
						$datas[] = $row;
					}
					return $datas;
				}
			} else{ return 0; }
		}

		public function countData($table, $field)
		{
			if(self::$conn !== NULL){
				if($table === 'product'){
					self::$sql = "SELECT COUNT({$field}) FROM {$table}";
					self::$pre = self::$conn -> prepare(self::$sql);
					self::$pre -> execute();
					return self::$pre -> fetchColumn();
				}
			} else{ return 0; }
		}

		public function insert($table, $data)
		{
			if(self::$conn !== NULL){
				if($table === 'product'){
					self::$sql = "INSERT INTO {$table}(NAME, PRICE, IMAGE, DESCRIPTION, TYPE, STATUS) VALUES(?,?,?,?,?,?)";
					self::$pre = self::$conn -> prepare(self::$sql);
					return self::$pre->execute($data);
				}
				if($table === 'reports_revenue'){
					self::$sql = "INSERT INTO {$table}(MONTH, TOTAL_MONEY, TOTAL_AMOUNT, DATE_CREATE, DETAIL) VALUES(?,?,?,?,?)";
					self::$pre = self::$conn -> prepare(self::$sql);
					return self::$pre->execute($data);
				}
			} else{ return 0; }
		}

		public function remove($table, $id)
		{
			if(self::$conn !== NULL){
				if($table === 'product'){
					self::$sql = "DELETE FROM {$table} WHERE ID = :ID";
					self::$pre = self::$conn -> prepare(self::$sql);
					self::$pre -> bindParam(':ID', $id, PDO::PARAM_INT);
					return self::$pre -> execute();
				}
			} else{ return 0; }
		}

		public function update($table, $id, $data)
		{
			
		}
	}
	
?>