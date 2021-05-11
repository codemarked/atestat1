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
	
	$nume=$_POST['nume'];
	$prenume=$_POST['prenume'];
	$numar=$_POST['numar'];
	
	if (is_numeric($nume) || is_numeric($prenume) || !is_numeric($numar) || strlen($numar) > 10 || strlen($nume) > 30 || strlen($prenume) > 50){
		echo 'Valorile au fost introduse incorect!';
		return;
	}
	$query="insert into ".$table." values ('".$nume."','".$prenume."','".$numar."');";
	$result=mysqli_query($sql,$query);
	if (!$result) {
		echo '
		<div class="container">
			<big_text>Eroare de insertie!</big_text>
		</div>
		';
		mysqli_close($sql);
		return;
	}
	echo '
	<body>
		<div class="container">
			<big_text>Adaugare Reusita!</big_text>
			<br>
			<p>Nume: '.$nume.'</p>
			<p>Prenume: '.$prenume.'</p>
			<p>Telefon: '.$numar.'</p>
		</div>
	</body>
	';
	mysqli_close($sql);
?>