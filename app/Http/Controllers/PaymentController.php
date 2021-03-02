<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function nonce(Request $request){

      $gateway = new \Braintree\Gateway([
        'environment' => 'sandbox',
        'merchantId' => 'jscy3g85t9nv768x',
        'publicKey' => '8jkw58cs4p8y3vdz',
        'privateKey' => '8a3e1ad0407ed3a5aeca4aa6569a4293'
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
