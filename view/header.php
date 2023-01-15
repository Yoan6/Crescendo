<header>
    <div id="firstStage"> 
        <a class="logo" href="../controller/accueil.ctrl.php"><img src="../design/image/logo_em.jpg"  alt="logo"></a>
        <form action="../controller/recherche.ctrl.php" method="GET" class="conteneur">
            <input name="recherche" class="searchBar" type="search" list="searchList" placeholder="Rechercher...">
            <datalist id="searchList">
                    <option value="The quick brown fox jumps over a lazy dog."></option>
            </datalist>
            <input value="" type="submit" id="loupe"><img src="../design/image/search.svg" alt="loupe">
        </form>
                    
  <?php if(isset($_SESSION['num_utilisateur']) ) : ?>
    <a id="creationArticle" href="../controller/creerEnchere.ctrl.php">Vends tes articles</a>
  <?php else : ?>
    <a id="creationArticle" href="../controller/login.ctrl.php">Vends avec crescendo</a>
  <?php endif; ?>
    
        

      <div class="container">
        <button class="btn" id="btn">
        <img src="../design/image/user.svg"  alt="profile">
          <i class="bx bx-chevron-down" id="arrow"></i>
        </button>

        <div class="dropdown" id="dropdown">
        <?php if(isset($_SESSION['num_utilisateur']) ) : ?>
          <a href="../view/parametres.php"> Modifier profil<i><img src="../design/image/settings.svg" alt="settings"></i>  </a>
          <a href="#draft">Favoris<i><img src="../design/image/heart.svg" alt=""></i></a>
          <a href="#move">Enchères remportées<i><img src="" alt=""></i></a>
          <a href="../view/monEspaceVendeur.php">Mon espace vendeur</a>
          <a href="#notification">Notifications</a>
          <a href="../controller/logout.ctrl.php">Se déconnecter</a>
        <?php else : ?>
          <a href="../controller/login.ctrl.php">Se connecter</a>
        <?php endif; ?>
          <div class="divToggleDarkMode">
            <p>Dark Mode</p>
          <label class="switch">
            <input type="checkbox" id="darkModeBouton">
            <span class="slider round"></span>
          </label>
          </div>
          
          
        </div>
      </div>
        
    </div>
    <form action="../controller/rechercheChoix.ctrl.php" method="POST">
        <ul class="conteneur"> 
            <li><button name="valeurChoix" value="AlaUne">A la une</button></li>
            <li><button name="valeurChoix" value="vetements">Vêtements</button></li>
            <li><button name="valeurChoix" value="instruments">Instruments</button></li>
            <li><button name="valeurChoix" value="accessoires">Accessoires</button></li>
            <input type="hidden" name="choix" value="categorie">
        </ul>
    </form>
</header>