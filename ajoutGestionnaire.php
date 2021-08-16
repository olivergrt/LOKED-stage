<?php
  
		if (isset($_POST['submitAjoutGestionnaire']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['email']) AND !empty($_POST['pwd']) AND !empty($_POST['pwdConfirm'])) {

			$nom = htmlspecialchars($_POST['nom']); 
			$prenom = htmlspecialchars($_POST['prenom']);
			$email = htmlspecialchars($_POST['email']);
			$pwd = sha1($_POST['pwd']);
			$pwdConfirm = sha1($_POST['pwdConfirm']);

			if ($pwd === $pwdConfirm) {

			$insertNewGestionnaire = $bdd->prepare('INSERT INTO administrateur (nom, prenom, email, pwd) VALUES  (?,?,?,?)'); 
			$insertNewGestionnaire->execute(array($nom, $prenom, $email, $pwd)); 
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
				<td class="gestion">Nom</td>
				<td class="gestion">
					<input class="modif-titre" type="text" name="nom" placeholder="Nom" required="">
				</td>
			</tr>

			<tr class="gestion">	
				<td class="gestion">Prénom</td>
				<td class="gestion">
					<input class="modif-titre" type="text" name="prenom" placeholder="Prénom" required="">
				</td>
			</tr>

			<tr class="gestion">	
				<td class="gestion">Email</td>
				<td class="gestion">
					<input class="modif-titre" type="email" name="email" placeholder="Email" required="">
				</td>
			</tr>

			<tr class="gestion">	
				<td class="gestion">Mot de passe</td>
				<td class="gestion">
					<input class="modif-titre" minlength="7" maxlength="100" type="password" name="pwd" placeholder="Mot de passe" required="">
				</td>
			</tr>

			<tr class="gestion">	
				<td class="gestion">Confirmation mot de passe</td>
				<td class="gestion">
					<input class="modif-titre" type="password" minlength="7" maxlength="100" name="pwdConfirm" placeholder="Confirmation Mot de passe" required="">
				</td>
			</tr>

			<tr class="gestion">
				<td class="gestion">
				</td>
				<td class="gestion">
					<br>
					<input class="btn-modif-titre" type="submit" value="Ajouter" name="submitAjoutGestionnaire"> 
				 	<a href="/loked/mon-compte"><button class="btn-annuler">Annuler</a></button>
				 </td>
			</tr>
		</form>
	</table>
</html>