<?php
include('config.php');

$sql=mysqli_connect($host,$user,$password);
if (!$sql) {
	echo "Conexiune esuata!";
	mysqli_close($sql);
	return;
}
$q1=mysqli_query($sql, "create database if not exists $db;");
mysqli_select_db($sql, $db);
$query="create table if not exists $table (NUME varchar(64), PRENUME varchar(64), TELEFON varchar(32));";

$res=mysqli_query($sql,$query);
if (!$res) {
	echo "Eroare: DB";
	mysqli_close($sql);
}

?>