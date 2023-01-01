<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Crescendo</title>
		<link rel="stylesheet" type="text/css" href="../design/historique.css">
	</head>
	<body class="dark-mode">	

    <?php include(__DIR__.'/header.php'); ?>

		<main>
			<aside class="filtre">
				<h3>Filtres</h3>

				<p>Style musical :</p>
				<select name="style-musical">
          <option value""></option>
					<option value="regae">Regae</option>
					<option value="pop">Pop</option>
					<option value="rock">Rock</option>
					<option value="metal">Metal</option>
					<option value="rap">Rap</option>
				</select>

        <p>Artiste :</p>
				<select class="artiste" name="artiste">
          <option value""></option>
					<option value="maitre-gims">Maitre Gims</option>
					<option value="Vald">Vald</option>
					<option value="elvis-presley">Elvis Presley</option>
					<option value="arianna-grande">Arianna Grande</option>
					<option value="elton-john">Elton John</option>
				</select>

        <input type="submit" value="Chercher">
			</aside>

      <div class="historique-objet">
        <article class="objet">
          <a href=""> <img class="image-article" src="../design/image/icon/heart white.png"></a>
          <img src="../design/image/articles/veste-elton-john.png">
          <div class="infos">
            <div class="libelle-prix">
              <p class="libelle">Veste d'Elton John</p>
              <p class="prix">10k €</p>
            </div>
            <p class="description">Concert à New York d'Elton John, le 22 février 2022. 
              Veste queue de pie à imprimé floral, sur la... </p>
            <button class="voir-enchere" href="">Voir l'enchère</button>
          </div>

          <div class="like">
            <a href="" ><img class="image-article" src="../design/image/icon/thumb up white.png"> </a>
            <p>536</p>
            <a href=""><img class="image-article" src="../design/image/icon/thumb down white.png"> </a>
          </div>
        </article>

        <article class="objet">
          <a href=""> <img class="image-article" src="../design/image/icon/heart white.png"></a>
          <img src="../design/image/articles/veste-elton-john.png">
          <div class="infos">
            <div class="libelle-prix">
              <p class="libelle">Veste d'Elton John</p>
              <p class="prix">10k €</p>
            </div>
            <p class="description">Concert à New York d'Elton John, le 22 février 2022. 
              Veste queue de pie à imprimé floral, sur la... </p>
            <button class="voir-enchere" href="">Voir l'enchère</button>
          </div>

          <div class="like">
            <a href="" ><img class="image-article" src="../design/image/icon/thumb up white.png"> </a>
            <p>536</p>
            <a href=""><img class="image-article" src="../design/image/icon/thumb down white.png"> </a>
          </div>
        </article>

        

      </div>
		</main>	

    <?php include(__DIR__.'/footer.php'); ?>	
	</body>
	<script src="../js/crescendo.js"></script>
</html>