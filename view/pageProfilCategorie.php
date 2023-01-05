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
			<h1><img src="../design/image/user.png"  alt="profile" class="iconTaille"> Mon compte</h1>
            <div class="conteneur" id="pageProfil">
                <div class="conteneur">
                     <img src="../design/image/profile/chat.png">
                     <h2>NomDuProfil</h2>
                    <button class="danger">Supprimer mon compte</button>
                </div>
                <nav>
                    <ul class="conteneur">
                        <li><a href=""> <img src="../design/image/icon/heart white.png" class="iconTaille"> <h2>Favoris</h2></a></li>
                        <li><a href=""> <img src="../design/image/icon/heart white.png" class="iconTaille"> <h2>Modifier ses informations</h2></a></li>
                        <li><a href=""> <img src="../design/image/icon/heart white.png" class="iconTaille"> <h2>Enchères remportés</h2></a></li>
                        <li><a href=""> <img src="../design/image/icon/heart white.png" class="iconTaille"> <h2>Modifier mes articles</h2></a></li>
                        <li><a href=""> <img src="../design/image/icon/heart white.png" class="iconTaille"> <h2>Mes ventes</h2></a></li>
                        <li><a href=""> <img src="../design/image/icon/heart white.png" class="iconTaille"> <h2>Avis</h2></a></li>
                    </ul>
                </nav>
            </div>
		</main>
		
		
		
        <?php include(__DIR__.'/footer.php'); ?>	
	</body>
	<script src="../js/crescendo.js"></script>
    <script src="../js/header.js"></script>

</html>