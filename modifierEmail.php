<?php
  
		if (isset($_POST['submitEmail']) AND !empty($_POST['newEmail']) AND $_POST['newEmail'] ) {
			$newEmail = htmlspecialchars($_POST['newEmail']); 
			$insertEmail = $bdd->prepare('UPDATE administrateur SET email = ? WHERE id = ?'); 
			$insertEmail->execute(array($newEmail, $idadmin)); 
			header("location: /loked/mon-compte");
		}

?>
<!DOCTYPE html>
<html>
	<table align="center" class="gestion">
		<form method="POST" action="">

			<tr class="gestion">	
				<td class="gestion">
				Email
			</td>
				<td class="gestion">
					<input class="modif-titre" type="email" name="newEmail" value="<?= $InfoUser['email'] ?>">
				</td>
			</tr>

		
			<tr class="gestion">
				<td class="gestion">
				</td>
				<td class="gestion">
					<br>
					<input class="btn-modif-titre" type="submit" value="Enregistrer" name="submitEmail"> 
				 	<a href="/loked/mon-compte"><button class="btn-annuler">Annuler</a></button>
				 </td>
			</tr>
		</form>
	</table>
</html>