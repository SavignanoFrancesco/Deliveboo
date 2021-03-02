<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function nonce(Request $request){

      $gateway = new \Braintree\Gateway([
        'environment' => 'sandbox',
        'merchantId' => 'zyvj6svb8sp5858q',
        'publicKey' => '3gmtvwk4ks6z9wmx',
        'privateKey' => 'c67246f6e7c46d376f96cb4f66d36e4b'
      ]);

      $nonceFromTheClient = $request->nonce;
      $total_price = $request->totalprice;
      $guest_firstName = $request->firstName;
      $guest_lastName = $request->lastName;
      $guest_phone = $request->phone;
      $guest_email = $request->email;
      $guest_address = $request->streetAddress;
      $guest_postalCode = $request->postalCode;


      $result = $gateway->transaction()->sale([
        'amount' => $total_price,
        'paymentMethodNonce' => $nonceFromTheClient,
        'customer' => [
            'firstName' => $guest_firstName,
            'lastName' => $guest_lastName,
            'phone' => $guest_phone,
            'email' => $guest_email
          ],
          'billing' => [
            'firstName' => $guest_firstName,
            'lastName' => $guest_lastName,
            'streetAddress' => $guest_address,
            'postalCode' => $guest_postalCode,
            'locality' => 'BoolNation'
          ],
          'shipping' => [
            'firstName' => $guest_firstName,
            'lastName' => $guest_lastName,
            'streetAddress' => $guest_address,
            'postalCode' => $guest_postalCode,
            'locality' => 'BoolNation'
          ],
        'options' => [
          'submitForSettlement' => True
        ]
      ]);

      return response()->json([$request->all()]);
    }
}
