<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>All users</title>
	<href link="style.css" rel="stylesheet">
	<style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
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
		
		$stmt = $pdo->query('SELECT users.id as user_id, username, email, s.name as status FROM users JOIN status s ON users.status_id = s.id WHERE username LIKE \'e%\' AND s.id = \'2\' ORDER BY username ASC');
	?>
		<table> 
			<tr class=\"entete\"> 
				<th> Id </th> 
				<th> Username </th> 
				<th> Email </th> 
				<th> Status </th> 
			</tr>
	<?php
		while ($row = $stmt->fetch()) {
			echo "<tr> <td>" . $row['user_id'] . "</td> <td>" .$row['username'] . "</td> <td>" . $row['email']; 
			echo "</td> <td>" . $row['status']  . "</td> </tr>";
		}
		echo "</table>";
	?>
</body>
</html>