<!--
  ~ yasmf - Yet Another Simple MVC Framework (For PHP)
  ~     Copyright (C) 2019   Franck SILVESTRE
  ~
  ~     This program is free software: you can redistribute it and/or modify
  ~     it under the terms of the GNU Affero General Public License as published
  ~     by the Free Software Foundation, either version 3 of the License, or
  ~     (at your option) any later version.
  ~
  ~     This program is distributed in the hope that it will be useful,
  ~     but WITHOUT ANY WARRANTY; without even the implied warranty of
  ~     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  ~     GNU Affero General Public License for more details.
  ~
  ~     You should have received a copy of the GNU Affero General Public License
  ~     along with this program.  If not, see <https://www.gnu.org/licenses/>.
  -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All users</title>
</head>
<body>
<?php
spl_autoload_extensions(".php");
spl_autoload_register();

use yasmf\HttpHelper;
?>
<h1>All users</h1>
	<div>
		<form action="" method="GET">
			<input hidden name="action" value="setRecherche">
			<input hidden name="controller" value="allUsers">
			Nom commençant par la lettre: <input type="text" name="lettre">
			<br>Avec statut:
			<select name="statut">
				<option value="1">Waiting for account validation</option>
				<option value="2">Active account</option>
				<!--<option value="3">Waiting for account deletion</option>-->
			</select>
			<br><br><input type="submit" name="submit" value="Valider">
		</form>
	</div>
	<table>
		<tr>
			<th>Id</th>
			<th>Username</th>
			<th>Email</th>
			<th>Status</th>
		</tr>
		<?php
		if (isset($get)) {
			while ($fetch = $get->fetch()) {
				?>
				<tr>
					<td><?= $fetch["id"] ?></td>
					<td><?= $fetch["username"] ?></td>
					<td><?= $fetch["email"] ?></td>
					<td><?= $fetch["status_intitul"] ?></td>
					<?php
					
					if ($fetch["status_intitul"] != "Waiting for account deletion") {
						?>
						<!--
						<td><a href="./hello_world.php?action=deleteUser&controller=allUsers&status_id=3&user_id=<?= $fetch["id"] ?>&action2=askDeletion">Demander la suppression</a></td>
						-->
						<?php
					}
					
					?>
				</tr>
				<?php
			}
		}
		?>
	</table>


</body>
</html>