<?Php 
	$selectAll = $bdd->query('SELECT id,titre FROM vehicules ORDER BY id ASC'); 

	if (isset($_POST['submitNumber'])) {
		if(!empty($_POST['number'])){
			
			$id = $_GET['id']; 
			$newId = htmlspecialchars($_POST['number']);

			$updateId = $bdd->prepare('UPDATE FROM vehicules SET id = ? WHERE id = ?'); 
			$updateId->execute(array($newId, $id)); 
		} 
	}


?>
<!DOCTYPE html>
<html>
<body>
	<section id="ordre">
		<?php if (isset($_GET['id'])) { ?>
			<form method="POST" action="">
				<center>Nouveau numéro</center>
				<center><input type="number" name="number"></center>
				<center><input type="submit" name="submitNumber"></center><br>
			</form>

		<?php}?>


		<table>
			<thead>
				<tr>
					<td>N°</td>
					<td>Véhicule</td>
				</tr>
			</thead>
			<tbody>
			<?php while ($vehicule = $selectAll->fetch()) { ?>
				<tr>
					<td><a href="index.php?gestion=modifier-ordre&id=<?= $vehicule['id']?>"><?= $vehicule['id']?></a></td>
					<td><?= $vehicule['titre']?></td>
				</tr>
			<?php } } ?> 
			</tbody>
		</table>
	</section>
</body>
</html>