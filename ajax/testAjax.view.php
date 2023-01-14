<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Test</title>
</head>
<body onload="reactualiserPrixActuel(<?=$numEnchere?>)">
    <p>PrixActuel = <span id="prixActuelText"></span></p>
</body>
<script src="../ajax/getPrixActuel.js" defer></script>
</html>