<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Crescendo</title>
    <link rel="stylesheet" type="text/css" href="../design/header.css">
    <link rel="stylesheet" type="text/css" href="../design/crescendo.css">
    <link rel="stylesheet" href="../design/créerEnchère.css">
</head>

<body class="dark-mode">
    <?php include(__DIR__ . '/header.php'); ?>

    <main>



        <form action="">
            <div>
                <div id="topForm">
                    <div id="divTopLeft">
                        <input type="file" name="images" id="btnImage" accept="image/*">
                        <label for="btnImage" id="labelAjout"><svg fill="#000000" version="1.1" id="Layer_1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g>
                                        <polygon
                                            points="272,128 240,128 240,240 128,240 128,272 240,272 240,384 272,384 272,272 384,272 384,240 272,240 ">
                                        </polygon>
                                        <path
                                            d="M256,0C114.609,0,0,114.609,0,256s114.609,256,256,256s256-114.609,256-256S397.391,0,256,0z M256,472 c-119.297,0-216-96.703-216-216S136.703,40,256,40s216,96.703,216,216S375.297,472,256,472z">
                                        </path>
                                    </g>
                                </g>
                            </svg><span>Choose a file…</span>
                        </label>


                        <div id="carousel">
                            <img class="carousel-img" id="current-image">
                            <svg id="buttonPrev" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"
                                fill="#ffffff">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <style type="text/css">
                                        .st0 {
                                            fill: #000000;
                                        }
                                    </style>
                                    <g>
                                        <path class="st0"
                                            d="M255.991,0C114.615,0,0,114.615,0,256.009C0,397.385,114.615,512,255.991,512 C397.385,512,512,397.385,512,256.009C512,114.615,397.385,0,255.991,0z M345.464,323.884l-89.473-89.456l-89.456,89.456 l-44.097-44.097l133.552-133.57l133.57,133.57L345.464,323.884z">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                            <svg id="buttonNext" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"
                                fill="#ffffff">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <style type="text/css">
                                        .st0 {
                                            fill: #000000;
                                        }
                                    </style>
                                    <g>
                                        <path class="st0"
                                            d="M255.991,0C114.615,0,0,114.615,0,256.009C0,397.385,114.615,512,255.991,512 C397.385,512,512,397.385,512,256.009C512,114.615,397.385,0,255.991,0z M345.464,323.884l-89.473-89.456l-89.456,89.456 l-44.097-44.097l133.552-133.57l133.57,133.57L345.464,323.884z">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                        </div>

                    </div>

                    <div id="divTopRight">
                        <input type="text" placeholder="INSERER TITRE">
                        <input type="text" placeholder="INSERER PRIX DE DEPART">
                        <input type="text" placeholder="DATE DE DEBUT D'ENCHERE">
                    </div>
                </div>



                <div id="middleForm">
                    <h3>
                        Description
                    </h3>

                    <textarea name="" id="" cols="30" rows="10" placeholder="INSERER DESCRIPTION"></textarea>
                </div>

                <div id="bottomForm">

                    <div id="divBottomLeft">
                        <h4>
                            Information sur l'événement
                        </h4>
                        <div>

                            <section>
                                <p>
                                    Artiste:
                                </p>
                                <input type="text" placeholder="Insérer artiste">
                            </section>
                            <section>
                                <p>
                                    Date du concert:
                                </p>
                                <input type="date">
                            </section>
                            <section>
                                <p>
                                    Lieu:
                                </p>
                                <input type="text" placeholder="Insérer lieu">
                            </section>
                            <section>
                                <p>
                                    Style musical:
                                </p>
                                <select>

                                    <option value="0">Selectionner Style</option>
                                    <option value="1">Rock</option>
                                    <option value="2">Moins aimés</option>

                                </select>
                            </section>



                        </div>
                    </div>


                    <div id="divBottomRight">
                        <h4>
                            Information sur l'article
                        </h4>
                        <div>
                            <section>
                                <p>
                                    Taille:
                                </p>
                                <select>

                                    <option value="0">Selectionner taille</option>
                                    <option value="1">Rock</option>
                                    <option value="2">Moins aimés</option>

                                </select>
                            </section>
                            <section>
                                <p>
                                    Etat:
                                </p>
                                <select>

                                    <option value="0">Selectionner Etat</option>
                                    <option value="1">Rock</option>
                                    <option value="2">Moins aimés</option>

                                </select>
                            </section>
                            <section>
                                <p>
                                    Catégorie:
                                </p>
                                <select>

                                    <option value="0">Selectionner Catégorie</option>
                                    <option value="1">Rock</option>
                                    <option value="2">Moins aimés</option>

                                </select>
                            </section>

                        </div>
                    </div>
                </div>





            </div>

            </div>


            <div id="buttons">
                <button type="button">Annuler</button>
                <button>Confirmer</button>
            </div>

        </form>

    </main>



    <?php include(__DIR__ . '/footer.php'); ?>
</body>
<script src="../js/crescendo.js"></script>
<script src="../js/header.js"></script>
<script src="../js/créerEnchère.js"></script>

</html>