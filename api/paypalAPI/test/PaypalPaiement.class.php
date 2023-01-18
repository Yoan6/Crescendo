
<?php
 /**
  * Fourni par paypal à https://developer.paypal.com/docs/checkout/standard/integrate/
  */

  
use Psr\http\Message\ServerRequestInterface as Request;

class PaypalPaiement {
    private const CLIENT_ID = 'AaTHiLLksQ4TPTNz-IPaU7e3HxHpHDP9cHhpnQiRDUGeGShsHw68W5DxDaOUpCJDc8w2QpHf9hYEzSBi';
    private const CLIENT_SECRET = 'EHVjwRd2XAkGfJ4xNkNoTzzLzzkaFoxfqTQTqleHKLY_MLvxLHlrYbavmtC-vdQGBw_SzvH4pHZ3DYvD';
        
   //Enchere $uneEnchère

    public function ui(int $prix, string $num_enchere): string 
    {
        $clientId = self::CLIENT_ID; 
        //$uneEnchère
        return <<<HTML

        <!-- l'ID du client est à envoyer client-id-->
        <script src="https://www.paypal.com/sdk/js?client-id={$clientId}&currency=EUR&intent=authorize"></script>

      <!--<script src="https://www.paypal.com/sdk/js?client-id=&currency=EUR"></script> -->

        
        <!-- Le conteneur du bouton-->
        <div id="paypal-button-container"> </div>

         <script>

        paypal.Buttons({

            // Sets up the transaction when a payment button is clicked


            style: {
                layout: "horizontal",
                color: "blue",
                shape: "pill",
                label: "paypal",
                tagline: "false"
            },


            createOrder: (data, actions) => {

                return actions.order.create({

                    purchase_units: [{

                        reference_id: {$num_enchere},

                        amount: {value: {$prix} // Le prix de l'offre de l'enchère
                        }
                    }]

                });

            },

            // Finaliser la transaction, une fois el paiement approuvé

            onApprove: async (data, actions) => {
                const authorization = await actions.order.authorize() 
                
                const authorizationId = authorization.purchase_units[0].payments.authorization[0].id
                
                await fetch('/paypal.php', {

                    method: 'post',
                    headers: {

                        'content-type': 'application/json'
        
                    },
                    body: JSON.stringify({
                        authorizationId: authorizationId
                    })
                    alert("votre requete a été prise en compte")
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




    public function handle(Request $request, $num_enchere): void {


        require_once(__DIR__ . '../vendor/autoload.php');
    
       
        $environnement = new \PayPalCheckoutSdk\Core\SandboxEnvironment(CLIENT_ID, CLIENT_SECRET);
        
        $client = new \PayPalCheckoutSdk\Core\PayPalHttpClient($environnement);
        $requestID = new OrdersGetRequest($_POST['orderID']);
        
        $response = $client->execute($requestID);
        dd($response);
        
        
        $requestAuth = new AuthorizationsGetRequest($_POST['authID']); 
        $responseAuth = $client->execute($requestAuth);
        $orderID = $responseAuth->result->supplementary_data->related_ids->order_id;
        



    }





}
?>


