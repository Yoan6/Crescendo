<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Crescendo Test Paypal</title>
	</head>
    <body>
       <?php
       ini_set('display_errors', 1);
       ini_set('display_startup_errors', 1);
       error_reporting(E_ALL);
       require_once(__DIR__ . '/PaypalPaiement.class.php');
       $paiementPaypal = new PaypalPaiement();
       echo $paiementPaypal->ui(100);
       

       ?>
    </body>
</html>