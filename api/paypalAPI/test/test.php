<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Crescendo Test Paypal</title>
	</head>
    <body>
       <?php
       require_once(__DIR__ . '/PaypalPaiement.class.php');
       $paiementPaypal = new PaypalPaiement();
       $paiementPaypal->ui(100);
       ?>
    </body>
</html>