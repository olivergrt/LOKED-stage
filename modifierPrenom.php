<?php
  
		if (isset($_POST['submitPrenom']) AND !empty($_POST['newPrenom']) AND $_POST['newPrenom']) {
			$newPrenom = htmlspecialchars($_POST['newPrenom']); 
			$insertPrenom = $bdd->prepare('UPDATE administrateur SET prenom = ? WHERE id = ?'); 
			$insertPrenom->execute(array($newPrenom, $idadmin)); 
			header("location: /loked/mon-compte");
		}

?>
<!DOCTYPE html>
<html>
	<table align="center" class="gestion">
		<form method="POST" action="">

			<tr class="gestion">	
				<td class="gestion">
				Prénom
			</td>
				<td class="gestion">
					<input class="modif-titre" type="text" name="newPrenom" value="<?= $InfoUser['prenom'] ?>">
				</td>
			</tr>

		
			<tr class="gestion">
				<td class="gestion">
				</td>
				<td class="gestion">
					<br>
					<input class="btn-modif-titre" type="submit" value="Enregistrer" name="submitPrenom"> 
				 	<a href="/loked/mon-compte"><button class="btn-annuler">Annuler</a></button>
				 </td>
			</tr>
		</form>
	</table>
</html>