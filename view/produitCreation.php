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
				
				<textarea class="commeUnlabel" id="nomItem">Veste d'Elton John</textarea>
				<textarea class="commeUnlabel" id="prixArticle">Prix actuel</textarea>
				<textarea class="commeUnlabel" id="date">Insérer date</textarea>
			

				<label class="conteneur" id="descriptionArticle">
					<h3>Description</h3>
					<textarea class="commeUnlabel">Inserer description</textarea>
				</label>

				<label class="conteneur information" id="informationEvenement">
					<h3>Informations sur l'événement</h3>
					<ul class="conteneur">
						<li>
							<h4>Artiste</h4>
							<textarea class="mettreInformation">Insérer artiste</textarea>
						</li>
						<li>
							<h4>Date</h4>
							<textarea class="mettreInformation">JJ/MM/AAAA</textarea>
						</li>
						<li>
							<h4>Lieu</h4>
							<textarea class="mettreInformation">Insérer lieu</textarea>
						</li>
						<li>
							<h4>Style</h4>
							<select class="mettreInformation" name="Selectionner style">
								<option value="rock">rock</option>
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
								<option value="S">S</option>
							</select>
						</li>
						<li>
							<h4>Etat</h4>
							<select class="mettreInformation" name="Selectionner état">
								<option value="Bon">Bon</option>
							</select>
						</li>
						<li>
							<h4>Catégorie</h4>
							<select class="mettreInformation" name="Selectionner catégorie">
								<option value="elton-john">Elton John</option>
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