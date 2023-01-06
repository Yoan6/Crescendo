<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Crescendo</title>
		<link rel="stylesheet" type="text/css" href="../design/historique.css">
    <link rel="stylesheet" type="text/css" href="../design/header.css">
		<link rel="stylesheet" type="text/css" href="../design/crescendo.css">
    <link rel="stylesheet" type="text/css" href="../design/article.css">
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
        <div class="article">
                    
          <div id="heart">
              <img src="../design/image/heart.svg">
          </div>
          <div id="responsive">
              <div id="photo">
                  <img src="../design/image/articles/veste-elton-john.png">
              </div>
              <div id="center">
                  <div>
                      <h3>Veste d'Elton John</h3>
                      <h3>10 000 $</h3>
                  </div>
                  <section>
                      <p>Concert à New York d’Elton John, le 22 février 2022. Veste queue de pie à imprimé floral, sur la blablablabaalblabalbalablalbalbalbbalbalabablalblbaablabablablblbablalabblabalalbababll </p>
                  </section>
                  <a href="">Voir l'enchère</a>
              </div>
          </div>
          
          <div id="likes">
              <img src="../design/image/icon/thumb up white.png">
              <p>654</p>
              <img src="../design/image/icon/thumb down white.png">
          </div>

        </div>

        <div class="article">
                    
          <div id="heart">
              <img src="../design/image/heart.svg">
          </div>
          <div id="responsive">
              <div id="photo">
                  <img src="../design/image/articles/veste-elton-john.png">
              </div>
              <div id="center">
                  <div>
                      <h3>Veste d'Elton John</h3>
                      <h3>10 000 $</h3>
                  </div>
                  <section>
                      <p>Concert à New York d’Elton John, le 22 février 2022. Veste queue de pie à imprimé floral, sur la blablablabaalblabalbalablalbalbalbbalbalabablalblbaablabablablblbablalabblabalalbababll </p>
                  </section>
                  <a href="">Voir l'enchère</a>
              </div>
          </div>
          
          <div id="likes">
              <img src="../design/image/icon/thumb up white.png">
              <p>654</p>
              <img src="../design/image/icon/thumb down white.png">
          </div>

        </div>

        <div class="article">
                    
          <div id="heart">
              <img src="../design/image/heart.svg">
          </div>
          <div id="responsive">
              <div id="photo">
                  <img src="../design/image/articles/veste-elton-john.png">
              </div>
              <div id="center">
                  <div>
                      <h3>Veste d'Elton John</h3>
                      <h3>10 000 $</h3>
                  </div>
                  <section>
                      <p>Concert à New York d’Elton John, le 22 février 2022. Veste queue de pie à imprimé floral, sur la blablablabaalblabalbalablalbalbalbbalbalabablalblbaablabablablblbablalabblabalalbababll </p>
                  </section>
                  <a href="">Voir l'enchère</a>
              </div>
          </div>
          
          <div id="likes">
              <img src="../design/image/icon/thumb up white.png">
              <p>654</p>
              <img src="../design/image/icon/thumb down white.png">
          </div>

        </div>

        

      </div>
		</main>	

    <?php include(__DIR__.'/footer.php'); ?>	
	</body>
	<script src="../js/crescendo.js"></script>
  <script src="../js/header.js"></script>
</html>