<?php

namespace App\Http\Controllers;

use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;

class PaypalController extends Controller
{
    public function paypal(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $order = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.payment.success'),
                "cancel_url" => route('paypal.payment.cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "PHP",
                        "value" => $request->price
                    ]
                ]
            ]
        ]);
        //dd($order);
        if (isset($order['id']) && $order['id'] !== null) {
            foreach ($order['links'] as $link) {
                if ($link['rel'] == 'approve') {
                    session(['product_name' => $request->product_name]);
                    session(['quantity' => $request->quantity]);
                    return redirect()->away($link['href']);
                }
            }
        }
    }


    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $order = $provider->capturePaymentOrder($request->token);
        dd($order);
        if (isset($order['status']) && $order['status'] == 'COMPLETED') {
            //Proceed on saving it on your Database / Payments Table
            // save the paypal fee to the database
            // Gross amount, paypal fee, net amount
            return 'success';
        } else {
            return redirect()->route('paypal.payment.cancel');
        }

        //Unset Session data
    }



    public function cancel()
    {
        return 'cancelled';
    }
}
