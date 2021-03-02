<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function nonce(Request $request){

      $gateway = new \Braintree\Gateway([
        'environment' => 'sandbox',
        'merchantId' => 'k54tfzv4g5h3mtyk',
        'publicKey' => 't2frnskb9x6thgtt',
        'privateKey' => '6f84fa26468f1afbc83f502fe8ed1f00'
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
