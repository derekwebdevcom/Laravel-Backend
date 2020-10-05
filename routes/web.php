<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  $gateway = new Braintree\Gateway([
    'environment' => 'sandbox',
    'merchantId' => 'ng7dd4bngdzzyqtb',
    'publicKey' => '4j7dns5r9fqg9rg6',
    'privateKey' => '9f5bf9789595b1ea77d3523518efba86'
]);

    $token = $gateway->ClientToken()->generate();

    return view('welcome', [
        'token' => $token
    ]);
});

Route::post('/checkout', function (Request $request) {
    $gateway = new Braintree\Gateway([
        'environment' => 'sandbox',
        'merchantId' => 'ng7dd4bngdzzyqtb',
        'publicKey' => '4j7dns5r9fqg9rg6',
        'privateKey' => '9f5bf9789595b1ea77d3523518efba86'
    ]);

    $amount = $request->amount;
    $nonce = $request->payment_method_nonce;

    $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => $nonce,
        'customer' => [
            'firstName' => 'Tony',
            'lastName' => 'Stark',
            'email' => 'tony@avengers.com',
        ],
        'options' => [
            'submitForSettlement' => true
        ]
    ]);

    if ($result->success) {
        $transaction = $result->transaction;
        // header("Location: transaction.php?id=" . $transaction->id);

        return back()->with('success_message', 'Transaction successful. The ID is:'. $transaction->id);
    } else {
        $errorString = "";

        foreach ($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }

        // $_SESSION["errors"] = $errorString;
        // header("Location: index.php");
        return back()->withErrors('An error occurred with the message: '.$result->message);
    }
});

Route::get('/hosted', function () {
    $gateway = new Braintree\Gateway([
        'environment' => 'sandbox',
        'merchantId' => 'ng7dd4bngdzzyqtb',
        'publicKey' => '4j7dns5r9fqg9rg6',
        'privateKey' => '9f5bf9789595b1ea77d3523518efba86'
    ]);

    $token = $gateway->ClientToken()->generate();

    return view('hosted', [
        'token' => $token
    ]);
});