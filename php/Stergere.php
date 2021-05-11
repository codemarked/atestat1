<?php
	include('config.php');
	require('Connect.php');
	
	echo "
	<style>
	big_text {
		font-family: 'Courier New', monospace;
		font-size: 30px;
		color: #0089C1;
		font-weight: bold;
		text-shadow: 2px 2px 1px black;
	}
	p {
		font-family: 'Courier New', monospace;
		color: #98CFDD;
		font-size: 25px;
		font-weight: bold;
		text-shadow: 1px 1px 1px black;
	}
	.container {
		padding: 20px;
	}
	body {
		margin: 0px;
		text-align: top;
		background-image: url('../img/blue-texture2.png');
		background-image-size: 100%;
		border-left: 2px solid #98CFDD;
		border-top: 2px solid #98CFDD;
	}
	</style>
	";
	
	$sql=mysqli_connect($host,$user,$password,$db);
	if (!$sql) {
		echo '
		<div class="container">
			<big_text>Eroare de conectare!</big_text>
		</div>
		';
		mysqli_close($sql);
		return;
	}
	
	$input=$_POST['input'];
	
	$query = "select * from $table where NUME='$input' or PRENUME='$input' or TELEFON='$input';";
	$res=mysqli_query($sql, $query);
	if (!$res) {
		echo '
		<div class="container">
			<big_text>Eroare de introducere!</big_text>
		</div>
		';
		mysqli_close($sql);
		return;
	}
	if (mysqli_num_rows($res) == 0) {
		echo '
		<div class="container">
			<big_text>Nu s-a gasit elementul pentru stergere!</big_text>
		</div>
		';
		mysqli_close($sql);
		return;
	}
	$row = mysqli_fetch_array($res);
	$del_query="delete from $table where NUME='".$row['NUME']."';";
	$del_res=mysqli_query($sql, $del_query);
	if (!$del_res){
		echo '
		<div class="container">
			<big_text>Eroare in timpul stergerii!</big_text>
		</div>
		';
		mysqli_close($sql);
		return;
	}
	echo '
	<div class="container">
		<big_text>Rezultatele stergerii:</big_text>
		
		<p>Nume: '.$row['NUME'].'</p>
		<p>Prenume: '.$row['PRENUME'].'</p>
		<p>Telefon: '.$row['TELEFON'].'</p>
	</div>
	';
	mysqli_close($sql);
?>