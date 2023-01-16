<header>
  <div id="firstStage">
    <svg id="burgerButton" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
      <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
      <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC"
        stroke-width="0.192"></g>
      <g id="SVGRepo_iconCarrier">
        <rect width="48" height="48" fill="white" fill-opacity="0.01"></rect>
        <path d="M7.94977 11.9498H39.9498" stroke="#ffffff" stroke-width="2.16" stroke-linecap="round"
          stroke-linejoin="round"></path>
        <path d="M7.94977 23.9498H39.9498" stroke="#ffffff" stroke-width="2.16" stroke-linecap="round"
          stroke-linejoin="round"></path>
        <path d="M7.94977 35.9498H39.9498" stroke="#ffffff" stroke-width="2.16" stroke-linecap="round"
          stroke-linejoin="round"></path>
      </g>
    </svg>

    <svg id="crossButton" viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"
      stroke-width="0.00024000000000000003">
      <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
      <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC"
        stroke-width="0.288"></g>
      <g id="SVGRepo_iconCarrier">
        <path fill-rule="evenodd" clip-rule="evenodd"
          d="M5.46967 5.46967C5.76256 5.17678 6.23744 5.17678 6.53033 5.46967L18.5303 17.4697C18.8232 17.7626 18.8232 18.2374 18.5303 18.5303C18.2374 18.8232 17.7626 18.8232 17.4697 18.5303L5.46967 6.53033C5.17678 6.23744 5.17678 5.76256 5.46967 5.46967Z"
          fill="#ffffff"></path>
        <path fill-rule="evenodd" clip-rule="evenodd"
          d="M18.5303 5.46967C18.8232 5.76256 18.8232 6.23744 18.5303 6.53033L6.53035 18.5303C6.23745 18.8232 5.76258 18.8232 5.46969 18.5303C5.17679 18.2374 5.17679 17.7626 5.46968 17.4697L17.4697 5.46967C17.7626 5.17678 18.2374 5.17678 18.5303 5.46967Z"
          fill="#ffffff"></path>
      </g>
    </svg>

    <a class="logo" href="../controller/accueil.ctrl.php"><img src="../design/image/logo_em.jpg" alt="logo"></a>
    <form id="formRecherche" action="../controller/recherche.ctrl.php" method="GET" class="conteneur">
      <input name="recherche" class="searchBar" type="search" list="searchList" placeholder="Rechercher...">
      <datalist id="searchList">
        <option value="The quick brown fox jumps over a lazy dog."></option>
      </datalist>
      <div id="loupe">
        <input id="inputRecherche" value="" type="submit"><img src="../design/image/search.svg" alt="loupe">
      </div>

    </form>

    <?php if (isset($_SESSION['num_utilisateur'])): ?>
      <a id="creationArticle" href="../controller/creerEnchere.ctrl.php">Vends tes articles</a>
    <?php else: ?>
      <a id="creationArticle" href="../controller/login.ctrl.php">Vends avec crescendo</a>
    <?php endif; ?>



    <div class="divDropUser">

      <svg class="btn" id="btn" width="256px" height="256px" viewBox="0 0 24.00 24.00" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#ebebeb"
          stroke-width="0.576"></g>
        <g id="SVGRepo_iconCarrier">
          <path
            d="M18 18.7083C17.4832 16.375 15.5357 15 12.0001 15C8.46459 15 6.51676 16.375 6 18.7083M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21ZM12 12C13.3333 12 14 11.2857 14 9.5C14 7.71429 13.3333 7 12 7C10.6667 7 10 7.71429 10 9.5C10 11.2857 10.6667 12 12 12Z"
            stroke="#ffffff" stroke-width="0.8160000000000001" stroke-linecap="round" stroke-linejoin="round"></path>
        </g>
      </svg>
      <div class="dropdown" id="dropdown">
        <?php if (isset($_SESSION['num_utilisateur'])): ?>
          <a href="../controller/parametre.ctrl.php"> Modifier profil<i><img src="../design/image/settings.svg" alt="settings"></i>
          </a>
          <a href="#draft">Favoris<i><img src="../design/image/heart.svg" alt=""></i></a>
          <a href="#move">Enchères remportées<i><img src="" alt=""></i></a>
          <a href="../controller/rechercheChoix.ctrl.php?choixObligatoire[num_vendeur][]=<?=$_SESSION['num_utilisateur']?>">Mon espace vendeur</a>
          <a href="#notification">Notifications</a>
          <a href="../controller/logout.ctrl.php">Se déconnecter</a>
        <?php else: ?>
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
  <form id="lesCategories" action="../controller/rechercheChoix.ctrl.php" method="GET">
    <ul class="conteneur">
      <li class="liCategories"><button name="orderBy[]" value="AlaUne">A la une</button></li>
      <li class="liCategories"><button name="choixObligatoire[categorie][]" value="Vêtement">Vêtements</button></li>
      <li class="liCategories"><button name="choixObligatoire[categorie][]" value="Instrument">Instruments</button></li>
      <li class="liCategories"><button name="choixObligatoire[categorie][]" value="Accessoire">Accessoires</button></li>
    </ul>
  </form>
</header>