<?php
  
		if (isset($_POST['submitNom']) AND !empty($_POST['newNom']) AND $_POST['newNom']) {
			$newNom = htmlspecialchars($_POST['newNom']); 
			$insertNom = $bdd->prepare('UPDATE administrateur SET nom = ? WHERE id = ?'); 
			$insertNom->execute(array($newNom, $idadmin)); 
			header("location: /loked/mon-compte");
		}

?>
<!DOCTYPE html>
<html>
	<table align="center" class="gestion">
		<form method="POST" action="">

			<tr class="gestion">	
				<td class="gestion">
				Nom
			</td>
				<td class="gestion">
					<input class="modif-titre" type="text" name="newNom" value="<?= $InfoUser['nom'] ?>">
				</td>
			</tr>

		
			<tr class="gestion">
				<td class="gestion">
				</td>
				<td class="gestion">
					<br>
					<input class="btn-modif-titre" type="submit" value="Enregistrer" name="submitNom"> 
				 	<a href="/loked/mon-compte"><button class="btn-annuler">Annuler</a></button>
				 </td>
			</tr>
		</form>
	</table>
</html>