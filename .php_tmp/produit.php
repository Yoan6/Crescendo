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
				<div id="grandeImage">
					<img src="../design/image/accueil/vetement.jpg">
				</div>
				<div id="profil" class="conteneur">
					<label>NomDuVendeur</label>
					<label>600</label>
				</div>

				<label id="nomItem">Veste d'Elton John</label>
				<div id="prixActuel">
					<label>Prix actuel</label>
					<label>20 000,00 $</label>
					<input type="number" placeholder="Votre nouveau prix"> 
					<button>Valider</button>
				</div>
				<a id="lot">Cet article est en lot</a>

				<p id="description"><label>hello</label>hello</p>
				<p id="information"><label>hello</label>hello</p>
				<ul></ul>
</form>

		</main>
		
		
		
        <?php include(__DIR__.'/footer.php'); ?>	
	</body>
	<script src="../js/crescendo.js"></script>
    <script src="../js/header.js"></script>

</html>