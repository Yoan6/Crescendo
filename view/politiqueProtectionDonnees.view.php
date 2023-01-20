<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Crescendo</title>
    <link rel="stylesheet" type="text/css" href="../design/header.css">
    <link rel="stylesheet" type="text/css" href="../design/crescendo.css">
    <link rel="stylesheet" type="text/css" href="../design/politiqueProtectionDonnees.css">
</head>

<body class="dark-mode">
    <?php include(__DIR__ . '/header.php'); ?>

    <main id="protectionDonnees">
        <h1>Politique de protection des données</h1>
        <div>
            <h2>1 - Identité et coordonnées du responsable des traitements</h2>
            <p>Le responsable de traitement est le développeur Cyprien Boscher. 
                Vous pouvez le contacter via son adresse mail : 
                cyprien.boscher@etu.univ-grenoble-alpes.fr.</p>
        </div>

        <div>
            <h2>2 - Finalités du traitement : </h2>
            <p>Nous recueillons vos données personnelles lorsque vous créez un compte Crescendo et UNIQUEMENT dans 
                ce cas-ci. Si vous êtes amené à recevoir une demande de données personnelles qui ne font pas partie 
                des éléments ci-dessous, contactez notre responsable de la sécurité (voir champs “<strong>Mesures liées à 
                la sécurité des données</strong>”).</p>
            <ul>
                <li>- Nous utilisons le prénom, le nom, le pseudo et l’adresse mail de l’utilisateur afin de pouvoir 
                    le reconnaître et l’identifier et vérifier le caractère univoque du traitement à tout moment. </li>
                <li>- Nous utilisons l’<strong>adresse mail</strong> afin de pouvoir contacter l’utilisateur en cas de problème. </li>
                <li>- Nous utilisons l'<strong>âge de l’utilisateur</strong> pour être certain de pouvoir faire la collecte de données 
                    avec un simple consentement (âge supérieur à 18 ans).</li>
                <li>- Nous utilisons l’<strong>adresse postale</strong> afin que nous puissions faire livrer l’objet ou le lot au 
                    client.</li>
                <li>- Nous utilisons la <strong>date de consentement</strong> afin que le responsable des traitements puisse démontrer 
                    la validité du traitement à tout moment.</li>
            </ul>
        </div>

        <div>
            <h2>3 - Durée de conservation des données : </h2>
            <ul>
                <li>- Prénom : 2 ans </li>
                <li>- Nom : 2 ans</li>
                <li>- Adresse mail : 2 ans</li>
                <li>- Age : 2 ans</li>
                <li>- Pseudo : 2 ans</li>
                <li>- Mot de passe : 2 ans</li>
                <li>- Adresse postale : 2 ans</li>
                <li>- Date de consentement : 2 ans</li>
                <li>- Adhésion aux cookies : 2 ans</li>
                <li>- Numéro d'utilisateur : 2 ans</li>
            </ul>
        </div>

        <div>
            <h2> 4 - Existence du droit de demander l’accès aux données, leur rectification ou effacement : </h2>
            <p>Sur votre profil, vous avez un bouton “accéder à mes données”, un bouton “modifier mes données” et un 
                bouton “supprimer mes données”. Ce dernier est sensible donc il y aura un message d’alerte qui vous 
                informera sur l’importance des données.</p>
            <p> Information : tout compte sera supprimé au bout de 2 ans en cas d'inactivité.</p>
        </div>

        <div>
            <h2>5 - Existence et modalités d’exercice du droit de retrait :  </h2>
            <p>Selon les dispositions du RGPD sur le traitement des données, vous pouvez à tout moment retirer vos 
                données récoltées. Pour ce faire, </p>
            <ol> 
                <li>Cliquez sur l'icône profil en haut à droite de la page principale</li>
                <li>Cliquer sur le bouton “supprimer mes données personnelles“</li>
                <li>Connectez-vous si cela n'est pas déjà fait</li>
                <li>Cliquer sur "supprimer mon compte", ce qui aura pour conséquence de supprimer vos données personnelles 
                    (ATTENTION : il existe des risques à faire cette action voir partie “Conséquence de la non-fourniture 
                    des données par la personne”).</li>
            </ol>
            <h4>5.1 - Droit d’introduire une réclamation auprès de l’autorité de contrôle : </h4>
            <p>Si vous avez une réclamation concernant les données ou une question, vous pouvez à tout moment 
                contacter l’autorité de contrôle via ce <a class="lien" href="https://www.cnil.fr/fr/cnil-direct
                /question/adresser-une-reclamation-plainte-la-cnil-quelles-conditions-et-comment">lien</a>.</p>

            <h4>5.2 - Conséquence de la non-fourniture des données par l’utilisateur : </h4>
            <p>Si l’utilisateur ne fournit pas ses données, alors il ne pourra pas créer de compte et sera donc limité 
                dans les fonctionnalités du site web. De ce fait, la seule chose qu’il pourra faire est voir les 
                articles et lots sans pouvoir enchérir.</p>
            
            <h4>5.3 - Mesures liées à la sécurité des données </h4>
            <p>Vos données sont conservées dans une base de données sur notre serveur. Si vous avez des questions 
                concernant la sécurité des données, vous pouvez contacter le développeur Jallyl Tourougui via son 
                adresse mail : jallyl.tourougui@etu.univ-grenoble-alpes.fr</p>
        </div>

    </main>

<?php include(__DIR__ . '/footer.php'); ?>
</body>
<script src="../js/crescendo.js"></script>
<script src="../js/header.js"></script>
</html>