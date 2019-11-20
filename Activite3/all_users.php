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

	<?php
		function get($name) {
			return isset($_GET[$name]) ? $_GET[$name] : null;
		}
	?>
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
	?>
		<form action="all_users.php" method="POST">
			<p> Un utilisateur dont la première lettre est 
				<input type="text" id="premiereLettre" name="premiereLettre" <?php echo get("premiereLettre") ?> >
				et dont le statut est 
				<select name="statut" id="statut">
					<option value="2" <?php if (get(name:"statut") == 2) echo 'selected' ?> >Active Account</option>
					<option value="1" <?php if (get(name:"statut") == 1) echo 'selected' ?> >Waiting for account validation</option>
				</select>
			 <input type="submit" value="OK">
			</p>
		</form>
	<?php	
		$lettre = htmlspecialchars(get(name:"premiereLettre"));
		$statut = (int)get(name:"statut");
		$stmt = $pdo->query('SELECT users.id as user_id, username, email, s.name as status FROM users JOIN status s ON users.status_id = s.id WHERE username LIKE \'$lettre%\' AND s.id = \'$statut\' ORDER BY username ASC');
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