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
      // dd($request->totalprice);

      $result = $gateway->transaction()->sale([
        'firstName' => 'Alberto',
        'lastName' => 'Bertollo',
        'email' => 'mike.jones@example.com',
        'phone' => '281.330.8004',
        'amount' => $total_price,
        'paymentMethodNonce' => $nonceFromTheClient,
        'options' => [
          'submitForSettlement' => True,
          'storeInVaultOnSuccess' => True,
          'storeInVault' => True
        ]
      ]);


      return response()->json([$request->all()]);
    }
}
