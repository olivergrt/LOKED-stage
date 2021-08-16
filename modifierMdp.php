<?php
  
		if (isset($_POST['submitMdp']) AND !empty($_POST['newMdp']) AND !empty($_POST['newMdpConfirm']) AND $_POST['newMdp']) {
			$newMdp = sha1($_POST['newMdp']); 
			$newMdpConfirm = sha1($_POST['newMdpConfirm']); 
			
			if ($newMdp === $newMdpConfirm) {
				$insertMdp = $bdd->prepare('UPDATE administrateur SET pwd = ? WHERE id = ?'); 
				$insertMdp->execute(array($newMdpConfirm, $idadmin)); 
				header("location: /loked/mon-compte");
			}
			else{
				echo "<center><span style = 'color : red;'>Les mots de passe ne correspondent pas<span></center>"; 
			}
		}
			

?>
<!DOCTYPE html>
<html>
	<table align="center" class="gestion">
		<form method="POST" action="">

			<tr class="gestion">	
				<td class="gestion">
				Nouveau Mot de passe
			</td>
				<td class="gestion">
					<input class="modif-titre" minlength="7" maxlength="100" type="password" name="newMdp">
				</td>
			</tr>

			<tr class="gestion">	
				<td class="gestion">
				 Confirmation Mot de passe
			</td>
				<td class="gestion">
					<input class="modif-titre" minlength="7" maxlength="100" type="password" name="newMdpConfirm">
				</td>
			</tr>

		
			<tr class="gestion">
				<td class="gestion">
				</td>
				<td class="gestion">
					<br>
					<input class="btn-modif-titre" type="submit" value="Enregistrer" name="submitMdp"> 
				 	<a href="/loked/mon-compte"><button class="btn-annuler">Annuler</a></button>
				 </td>
			</tr>
		</form>
	</table>
</html>