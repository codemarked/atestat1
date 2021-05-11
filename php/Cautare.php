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
	table_top {
		font-family: 'Courier New', monospace;
		color: #98CFDD;
		font-size: 25px;
		font-weight: bold;
		text-shadow: 1px 1px 1px black;
	}
	table {
		border: 1px solid black;
		border-collapse: collapse;
	}
	td, tr, th {
		border: 3px solid #98CFDD;
		padding: 10px;
		text-align: center;
	}
	p {
		font-family: 'Courier New', monospace;
		color: #98CFDD;
		font-size: 21px;
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
	
	$cauta=$_POST['cauta'];
	$query="none";
	if ($cauta == NULL){
		$query = "select * from $table;";
	} else {
		$query = "select * from $table where NUME='$cauta' or PRENUME='$cauta' or TELEFON='$cauta';";
	}
	
	$res=mysqli_query($sql, $query);
	if (!$res) {
		echo '
		<div class="container">
			<big_text>Eroare de initializare!</big_text>
		</div>
		';
		mysqli_close($sql);
		return;
	}
	
	if (mysqli_num_rows($res) > 0)  {
		echo '
			<div class="container">
				<big_text>Rezultatele cautarii:</big_text>
				<br>
				<table>';
				echo "<tr><td><table_top>NUME</table_top></td><td><table_top>PRENUME</table_top></td><td><table_top>TELEFON</table_top></td></tr>";
					while($row = mysqli_fetch_array($res)) {
						echo "<tr><td><p>".$row['NUME']."</p></td><td><p>".$row['PRENUME']."</p></td><td><p>".$row['TELEFON']."</p></td></tr>";
					}
			echo "</table>
			</div>";
	} else {
		echo '
			<div class="container">
				<big_text>Nu au fost gasite rezultate</big_text>
			</div>
			';
	}
	mysqli_close($sql);
?>