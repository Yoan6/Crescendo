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
		
		<main>
			<form action="../controler/encherir.ctrl.php" method="post" class="conteneur" id="pageProduit">
				<div id="produitGrandeImage">
					<img src="../design/image/accueil/vetement.jpg">
				</div>
				<div id="profil" class="conteneur">
					<label><img src="../design/image/profile/chat.png">NomDuVendeur</label>
				</div>
				<div id="favorisLikeDislike" class="conteneur">
					<button class="iconTaille"><img src="../design/image/icon/heart white.png"></button>
					<label><button class="iconTaille"><img src="../design/image/icon/thumb up.png"></button> 600 <button class="iconTaille"><img src="../design/image/icon/thumb down.png" class="iconTaille"></button></label>
				</div>
				

				<label id="nomItem">Veste d'Elton John</label>
				<div id="prixArticle">
					<label>Prix actuel</label>
					<output>20 000,00 $</output>
					<input type="number" placeholder="Votre nouveau prix"> 
					<button id="btnPaypal">Valider <img src="../design/image/paypal/PayPal_Logo_Icon_2014.svg" class="iconTaille"></button>
				</div>
				<a id="lot" class="conteneur">Cet article est en lot <img src="../design/image/icon/goTo.png" class="iconTaille"></a>

				<label class="conteneur" id="descriptionArticle">
					<h3>Description</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint ...</p>
				</label>
				<label class="conteneur information" id="informationTotal">
					<h3>Informations</h3>
					<ul class="conteneur">
						<li>Artiste:--------</li>
						<li>Date:--------</li>
						<li>Lieu:--------</li>
						<li>Taille:--------</li>
						<li>Etat:--------</li>
						<li>Catégorie:--------</li>
						<li>Ajouté:--------</li>
						<li>Modifié:--------</li>
					</ul>
				</label>
					
			</form>

		</main>
		
		
		
        <?php include(__DIR__.'/footer.php'); ?>	
	</body>
	<script src="../js/crescendo.js"></script>
    <script src="../js/header.js"></script>

</html>