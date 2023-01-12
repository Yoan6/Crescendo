<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Crescendo</title>
        <link rel="stylesheet" type="text/css" href="../design/header.css">
		<link rel="stylesheet" type="text/css" href="../design/crescendo.css">
	</head>
	<body class="dark-mode">
        <?php include(__DIR__.'/header.php'); ?>
		
		<main id="pageProduitCreation">
			<form action="../controler/encherir.ctrl.php" method="post" class="conteneur" id="pageProduit">
				<div id="produitGrandeImage">
					<input id="addImage" type="file" placeholder="Ajouter des Images">
				</div>
				<div>
				<p>Titre</p>
				<input class="commeUnlabel" id="nomItem" placeholder="Veste d'Elton John"></textarea>
				</div>
				<div>
				<p>
				Prix de départ
				</p>
				<input class="commeUnlabel" id="prixArticle"placeholder="Prix actuel"></textarea>
				</div>
				<div>
					<p>
						Date 
					</p>
				<input class="commeUnlabel" id="date" placeholder="Insérer date"></textarea>

				</div>
			

				<label class="conteneur" id="descriptionArticle">
					<h3>Description</h3>
					<textarea class="commeUnlabel">Inserer description</textarea>
				</label>

				<label class="conteneur information" id="informationEvenement">
					<h3>Informations sur l'événement</h3>
					<ul class="conteneur">
						<li>
							<h4>Artiste</h4>
							<input class="mettreInformation">Insérer artiste</textarea>
						</li>
						<li>
							<h4>Date</h4>
							<input class="mettreInformation">JJ/MM/AAAA</textarea>
						</li>
						<li>
							<h4>Lieu</h4>
							<input class="mettreInformation">Insérer lieu</textarea>
						</li>
						<li>
							<h4>Style</h4>
							<select class="mettreInformation" name="Selectionner style">
								<option value="blues">Blues</option>
								<option value="classique">Classique</option>
								<option value="disco">Disco</option>
								<option value="electro">Electro</option>
								<option value="funk">Funk</option>
								<option value="hip-hop">Hip-hop</option>
								<option value="jazz">Jazz</option>
								<option value="metal">Metal</option>
								<option value="film">Musique de film</option>
								<option value="pop">Pop</option>
								<option value="reggae">Reggae</option>
								<option value="rock">Rock</option>
								<option value="techno">Techno</option>
							</select>
						</li>
					</ul>
				</label>
				<label class="conteneur information" id="informationArticle" >
					<h3>Informations sur l'article</h3>
					<ul class="conteneur">
						<li>
							<h4>Taille</h4>
							<select class="mettreInformation" name="Selectionner taille">
								<option value="XS">XS</option>
								<option value="S">S</option>
								<option value="M">M</option>
								<option value="L">L</option>
								<option value="XL">XL</option>
							</select>
						</li>
						<li>
							<h4>Etat</h4>
							<select class="mettreInformation" name="Selectionner état">
								<option value="TMauvais">Très mauvais</option>
								<option value="mauvais">Mauvais</option>
								<option value="moyen">Moyen</option>
								<option value="bon">Bon</option>
								<option value="TB">Très bon</option>
							</select>
						</li>
						<li>
							<h4>Catégorie</h4>
							<select class="mettreInformation" name="Selectionner catégorie">
								<option value="vetement">Vêtement</option>
								<option value="instrument">Instrument</option>
								<option value="accessoire">Accessoire</option>
							</select>
						</li>
					</ul>
				</label>
				<div id="grilleBoutonsValiderAnnuler" class="conteneur">
					<a class="commeUnlabel" id="annulerModif">Annuler les modifications</a>
					<button class="highlight commeUnlabel" type="submit">Valider</button>
				</div>
					
			</form>

		</main>
		
		
		
        <?php include(__DIR__.'/footer.php'); ?>	
	</body>
	<script src="../js/crescendo.js"></script>
    <script src="../js/header.js"></script>
	<script src="../js/produitCreation.js"></script>

</html>