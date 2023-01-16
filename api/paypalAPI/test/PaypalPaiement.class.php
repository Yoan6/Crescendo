
<?php
 /**
  * Fourni par paypal à https://developer.paypal.com/docs/checkout/standard/integrate/
  */

  


class PaypalPaiement {
    private const CLIENT_ID = 'A61y8Qjy85Ypd3AIKOFb5wmzfZxiAGlX1Ug0PxOxRs0Gdnx1WWEEJppr';

   //Enchere $uneEnchère

    public function ui(int $prix): string 
    {
        $clientId = self::CLIENT_ID; 
        //$uneEnchère
        return <<<HTML

        <!-- l'ID du client est à envoyer client-id-->
        <script src="https://www.paypal.com/sdk/js?client-id={$clientId}&currency=EUR"></script>

        
        <!-- Le conteneur du bouton-->
        <div id="paypal-button-container"> Enchérir</div>

         <script>

        paypal.Buttons({

            // Sets up the transaction when a payment button is clicked

            createOrder: (data, actions) => {

            return actions.order.create({

                purchase_units: [{

                amount: {
                    
                    value: {$prix} // Le prix de l'offre de l'enchère
                    
                }

                }]

            });

            },

            // Finaliser la transaction, une fois el paiement approuvé

            onApprove: (data, actions) => {

                actions.order.authorize().then(function(authorization) {
                    const authorizationId = authorization.purchase_units[0].payments.authorization[0].id
                })


                // exemple d'un message de remerciement
                // const element = document.getElementById('paypal-button-container');

                // element.innerHTML = '<h3>Thank you for your payment!</h3>';

                // Or go to another URL:  actions.redirect('thank_you.html');
           


            }

        

        }).render('#paypal-button-container');

        </script>
    HTML;
    }
}
?>


