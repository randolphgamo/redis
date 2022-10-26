<html>
<head>
	<title>Notebook</title>
	<style>
		body {
			font-family: sans-serif;
			font-size: 13pt;
		}
	</style>
</head>

<body>
	<?php 
    //Connecting to Redis server 
   		$redis = new Redis();
   		$redis->connect("redis-db-6hfsz-redis-master.external.kinsta.app", "32377");
   		$redis->auth("9uKiIe9fIzkH8JPc");
	?>

	<div id="add">
		<h3>Add Note</h3>
		<form action="index.php" method="post">
			<textarea placeholder="Add Note" name="note"></textarea><br />
			<input type="submit" value="Submit">
		</form>
	</div>

	<?php 
		//add note
		if (isset($_POST['note'])) {
			$redis->lpush("notes", htmlspecialchars($_POST['note']));
			header("Refresh:0");
		}

	?>

	<div id="notes">
		<h3>Notes</h3>
		<?php 
		$arList = $redis->lrange("notes", 0 ,60); 
   		foreach ($arList as $ar) {
   			echo $ar . "<br />";
   		} 
		?>
	</div>
</body>

</html>
