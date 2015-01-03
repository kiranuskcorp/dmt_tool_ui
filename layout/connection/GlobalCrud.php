<?php
$path = $_SERVER ['DOCUMENT_ROOT'];
$path .= "/layout/connection/database.php";
include_once ($path);

$path = $_SERVER ['DOCUMENT_ROOT'];
$path .= "/layout/connection/SqlConstants.php";
include_once ($path);
class GlobalCrud {
	public static function getData($value) {
		$pdo = Database::connect ();
		$sql = SqlConstants::$allSelect [$value];
		$data = $pdo->query ( $sql );
		return $data;
		Database::disconnect ();
	}
	public static function delete($value, $id) {
		$pdo = Database::connect ();
		$pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$sql = SqlConstants::$allSelect [$value];
		$q = $pdo->prepare ( $sql );
		$q->execute ( array (
				$id 
		) );
		Database::disconnect ();
	}
	public static function setData($value, $sqlValues) {
		$pdo = Database::connect ();
		$pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$sql = SqlConstants::$allSelect [$value];
		$q = $pdo->prepare ( $sql );
		$q->execute ( $sqlValues );
		Database::disconnect ();
	}
	public static function update($value, $sqlValues) {
		$pdo = Database::connect ();
		$pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$sql = SqlConstants::$allSelect [$value];
		$q = $pdo->prepare ( $sql );
		$q->execute ( $sqlValues );
		Database::disconnect ();
	}
	public static function selectById($value, $sqlValues) {
		$pdo = Database::connect ();
		$pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$sql = SqlConstants::$allSelect [$value];
		$q = $pdo->prepare ( $sql );
		$q->execute ( $sqlValues );
		$data = $q->fetch ( PDO::FETCH_ASSOC );
		return $data;
		Database::disconnect ();
	}
	public static function getConstants($value) {
		$constants = SqlConstants::$totalConstants [$value];
		return $constants;
	}
	
}
?>