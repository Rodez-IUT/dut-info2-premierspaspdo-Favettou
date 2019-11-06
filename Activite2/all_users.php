<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>All users</title>
</head>
<body>
	<h1> All users </h1>
	
	<?php
	
		/* initialisation des différentes variables du PDO */
		$host = 'localhost';
		$db   = 'my_activities';
		$user = 'root';
		$pass = 'root';
		$charset = 'utf8';
		
		/* définition du PDO */
		$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
		
		$options = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false,
		];
		
		try {
			/* création de l'accès à la BD */
			$pdo = new PDO($dsn, $user, $pass, $options);
		} catch (PDOException $e) {
			throw new PDOException($e->getMessage(), (int)$e->getCode());
		}
		
		$stmt = $pdo->query('SELECT * FROM users JOIN status ON users.status_id = status.id ORDER BY username ASC');
		
		while ($row = $stmt->fetch())
		{
			echo "<p>" . $row['id'] . "     " .$row['username'] . "     " . $row['email'] . "     " . $row['name']  . "</br>" . "</p>";
		}
	?>
</body>
</html>