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
      // dd($request->totalprice);

      $result = $gateway->transaction()->sale([
        'amount' => $total_price,
        'paymentMethodNonce' => $nonceFromTheClient,
        'options' => [
          'submitForSettlement' => True
        ]
      ]);


      return response()->json([$request->all()]);
    }
}
