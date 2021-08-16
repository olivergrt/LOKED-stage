<?php
	if (isset($_POST['submitAjout'])) {
		if (!empty($_POST['titre']) AND !empty($_POST['url']) AND !empty($_POST['description']) /*AND !empty($_POST['urlGetaround']) AND !empty($_POST['urlOuicars'])*/ AND !empty($_POST['prix_jour'])) {

			$titre = htmlspecialchars($_POST['titre']); 
			$url = htmlspecialchars($_POST['url']);
			$url2 = htmlspecialchars($_POST['url2']);  
			$url3 = htmlspecialchars($_POST['url3']); 
			$url4 = htmlspecialchars($_POST['url4']); 
			$url5 = htmlspecialchars($_POST['url5']); 
			$description = htmlspecialchars($_POST['description']); 
			$urlGetaround = htmlspecialchars($_POST['urlGetaround']);
			$urlOuicars = htmlspecialchars($_POST['urlOuicars']);
			$prix_jour = htmlspecialchars($_POST['prix_jour']);
			$prix_heure = htmlspecialchars($_POST['prix_heure']);
			
			$req = $bdd->prepare("INSERT INTO vehicules (titre, url, url2, url3, url4, url5, description, urlGetaround, urlOuicars,prix_jour,prix_heure) VALUES (?,?,?,?,?,?,?,?,?,?,?)"); 
			$req->execute(array($titre,$url,$url2,$url3,$url4,$url5,$description,$urlGetaround,$urlOuicars,$prix_jour,$prix_heure)); 
			header("location: /loked/accueil");
		}
		
		else{
			$message = "<center><h3 style='color: red;'>Tous les champs doivent être complétés</h3></center><br>";
		}
	}
?>

<!DOCTYPE html>
<html>
<?php 
	if (isset($message)) {
		echo $message;
	}
	?>
	<table align="center" class="gestion">
		<form method="POST" action="">

			<tr class="gestion">
				<td class="gestion">
					Titre
				</td>
				<td class="gestion">
					<input class="modif-titre" type="text" name="titre" placeholder="Nom du véhicule" required>
				</td>
			</tr>

			<tr class="gestion">
				<td class="gestion">
					URL image 1
				</td>
				<td class="gestion">
					<textarea class="modif-titre" type="text" rows="6" cols="50" name="url" placeholder="URL de l'image 1 du véhicule" required></textarea>
				</td>
			</tr>
			<tr class="gestion">
				<td class="gestion">
					URL image 2 (facultatif)
				</td>
				<td class="gestion">
					<textarea class="modif-titre" type="text" rows="6" cols="50" name="url2" placeholder="URL de l'image 2 du véhicule"></textarea>
				</td>
			</tr>
			<tr class="gestion">
				<td class="gestion">
					URL image 3 (facultatif)
				</td>
				<td class="gestion">
					<textarea class="modif-titre" type="text" rows="6" cols="50" name="url3" placeholder="URL de l'image 3 du véhicule"></textarea>
				</td>
			</tr>
			<tr class="gestion">
				<td class="gestion">
					URL image 4 (facultatif)
				</td>
				<td class="gestion">
					<textarea class="modif-titre" type="text" rows="6" cols="50" name="url4" placeholder="URL de l'image 4 du véhicule"></textarea>
				</td>	
			</tr>
			<tr class="gestion">
				<td class="gestion">
					URL image 5 (facultatif)
				</td>
				<td class="gestion">
					<textarea class="modif-titre" type="text" rows="6" cols="50" name="url5" placeholder="URL de l'image 5 du véhicule"></textarea>
				</td>
			</tr>
			<tr class="gestion">
				<td class="gestion">
					Description
				</td>
				<td class="gestion">
						<textarea class="modif-titre" type="text" rows="6" cols="50" name="description" placeholder="Description du véhicule" required></textarea>
				</td>
			</tr>
			<tr class="gestion">
				<td class="gestion">
					URL de l'annonce sur GETAROUND
				</td>
				<td class="gestion">
					<textarea class="getaround" type="text" rows="6" cols="50" name="urlGetaround"></textarea>
				</td>
			</tr>
			<tr class="gestion">
				<td class="gestion">
					URL de l'annonce sur OUICARS
				</td>
				<td class="gestion">
					<textarea class="ouicar" type="text" rows="6" cols="50" name="urlOuicars"></textarea>
				</td>
			</tr>
			<tr class="gestion">
				<td class="gestion">
					Prix / jour
				</td>
				<td class="gestion">
					<input class="modif-titre" type="number" name="prix_jour" maxlength="3" placeholder="Prix / jour" required>
				</td>
			</tr>
			<tr class="gestion">
				<td class="gestion">
					Prix / heure (falcutatif)
				</td>
				<td class="gestion">
					<input class="modif-titre" type="number" name="prix_heure" maxlength="3" placeholder="Prix / heure">
				</td>
			</tr>

			<tr class="gestion">
				<td class="gestion"></td>
				<td class="gestion"><br>
					<input class="btn-modif-titre" type="submit" value="Ajouter" name="submitAjout">
					<a href="/loked/accueil"><button class="btn-annuler">Annuler</a></button>
				</td>
			</tr>
		</form>
	</table>
</html>