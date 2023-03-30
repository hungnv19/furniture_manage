<?php

namespace App\Components;

use Illuminate\Support\Facades\Log;
use Stripe\StripeClient;

class StripeComponent
{
    public static function createCustomer($email, $name)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        try {
            return $stripe->customers->create([
                'email' => $email,
                'name' => $name,
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return false;
        }
    }

    public static function createCharge($total_price, $customer_id, $description)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        try {
            $ret = $stripe->charges->create([
                'amount' => $total_price,
                'customer' => $customer_id,
                'currency' => 'jpy',
                'description' => $description,
            ]);
            if ($ret->status != 'succeeded') {
                return false;
            }

            return true;
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return false;
        }
    }

    public static function getDefaultSourceCard($customerId)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));

        return $stripe->customers->retrieve(
            $customerId,
            []
        )->default_source;
    }

    public static function addCustomerCard($customerId, $tokenCard)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        try {
            return $stripe->customers->createSource(
                $customerId,
                ['source' => $tokenCard]
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return false;
        }
    }

    public static function addCustomerCardDefault($customerId, $tokenCard)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        try {
            return $stripe->customers->update(
                $customerId,
                ['default_source' => $tokenCard]
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return false;
        }
    }

    public static function createTokenCard($request)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        try {
            return $stripe->tokens->create([
                'card' => [
                    'number' => $request->cardNumber,
                    'exp_month' => $request->cardExpireMonth,
                    'exp_year' => $request->cardExpireYear,
                    'cvc' => $request->cardCvc,
                ],
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return false;
        }
    }

    public static function createPlan($amount, $interval, $product)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        try {
            return $stripe->plans->create([
                'amount' => $amount,
                'currency' => 'usd',
                'interval' => $interval,
                'product' => $product,
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return false;
        }
    }

    public static function createProduct($productName)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        try {
            return $stripe->products->create([
                'name' => $productName,
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return false;
        }
    }

    public static function createPrice($amount, $product, $recurring = null)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        $request = [
            'unit_amount' => $amount,
            'currency' => 'jpy',
            'product' => $product,
        ];

        if ($recurring) {
            $request['recurring'] = ['interval' => 'day'];
        }

        try {
            return $stripe->prices->create([
                'unit_amount' => $amount,
                'currency' => 'jpy',
                'product' => $product,
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return false;
        }
    }

    public static function createSessionCheckout($customer_id, $from)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));

        try {
            return $stripe->checkout->sessions->create([
                'customer' => $customer_id,
                'success_url' => route('register_card.success', ['from' => $from]).'&session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('login.index'),
                'mode' => 'setup',
                'payment_method_types' => ['card'],
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return false;
        }
    }

    public static function searchProductByName($productName)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        try {
            $products = $stripe->products->search([
                'query' => 'active:\'true\' AND name:\''.$productName.'\'',
            ]);

            return $products['data'][0];
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return false;
        }
    }

    public static function searchPriceByProduct($productId)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        try {
            $prices = $stripe->prices->search([
                'query' => 'active:\'true\' AND product:\''.$productId.'\'',
            ]);

            return $prices['data'];
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return false;
        }
    }

    public static function retrieveCheckoutSession($session_id)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        try {
            return $stripe->checkout->sessions->retrieve($session_id);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return false;
        }
    }

    public static function retrieveCustomer($customer)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        try {
            return $stripe->customers->retrieve($customer);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return false;
        }
    }

    public static function getAllCardOfCustomer($customer)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        try {
            $cards = $stripe->customers->allSources(
                $customer,
                ['object' => 'card', 'limit' => 3]
            );

            return $cards['data'];
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return false;
        }
    }

    public static function updateCustomer($customer, $updateData)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        try {
            return $stripe->customers->update(
                $customer,
                $updateData
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return false;
        }
    }

    public static function getAllPaymentMethodOfCustomer($customer)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        try {
            $paymentMethods = $stripe->customers->allPaymentMethods(
                $customer,
                ['type' => 'card']
            );

            return $paymentMethods['data'];
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return false;
        }
    }

    public static function createPaymentIntents($total_price, $customer_id, $description)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        try {
            return $stripe->paymentIntents->create(
                [
                    'customer' => $customer_id,
                    'amount' => $total_price,
                    'currency' => 'jpy',
                    'payment_method_types' => ['card'], ]
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return false;
        }
    }

    public static function detachPaymentMethod($paymentMethodId)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        try {
            return $stripe->paymentMethods->detach(
                $paymentMethodId,
                []
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return false;
        }
    }
}
