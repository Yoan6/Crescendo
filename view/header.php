<header>
    <div id="firstStage"> 
        <a class="logo" href="accueil.php"><img src="../design/image/crescendo_logo_black.svg"  alt="logo"></a>
        <form action="recherche.php" method="GET" class="conteneur">
            <input class="searchBar" type="search" list="searchList" placeholder="Rechercher...">
            <datalist id="searchList">
                    <option value="concert"></option>
                    <option value="Elvis Presley"></option>
                    <option value="The quick brown fox jumps over a lazy dog."></option>
            </datalist>
            <a id="loupe" href="recherche.php"><img src="../design/image/search.svg" alt="loupe"></a>
        </form>
                    
  <a id="creationArticle" href="créerEnchère.php">Vends tes articles</a>
        

<div class="container">
  <button class="btn" id="btn">
  <img src="../design/image/user.svg"  alt="profile">
    <i class="bx bx-chevron-down" id="arrow"></i>
  </button>

  <div class="dropdown" id="dropdown">
  <a href="parametres.php">
      Paramètres
      <i><img src="../design/image/settings.svg" alt="settings"></i>

    </a>
    <a href="#draft">
      Favoris
      <i><img src="../design/image/heart.svg" alt=""></i>

    </a>
    <a href="#move">
      Enchères remportés
      <i><img src="" alt=""></i>

    </a>
    <a href="#profile">
      Mon espace vente
    </a>
    <a href="#notification">
      Notification
    </a>
    <a href="../view/logout.php">
      Se déconnecter
    </a>
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
    <nav>
        <ul class="conteneur"> 
            <li><a href="Vetements.php">A la une</a></li>
            <li><a href="Vetements.php">Vêtements</a></li>
            <li><a href="Vetements.php">Instruments</a></li>
            <li><a href="Vetements.php">Accessoires</a></li>
        </ul>
    </nav>
</header>