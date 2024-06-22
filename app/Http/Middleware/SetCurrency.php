<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetCurrency
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next)
    {
        // Get the selected country from the session
        $country = session('country', 'US'); // Default to 'US' if no country is selected

        // Set the currency and symbol based on the country
        switch ($country) {
            case 'US':
                session(['currency' => 'USD', 'currency_symbol' => '$', 'exchange_rate' => 1]);
                break;
            case 'IN':
                session(['currency' => 'INR', 'currency_symbol' => '₹', 'exchange_rate' => 74.50]); 
                break;
            case 'UK':
                session(['currency' => 'GBP', 'currency_symbol' => '£', 'exchange_rate' => 0.72]); 
                break;
            // Add more countries and their currencies as needed
            default:
                session(['currency' => 'USD', 'currency_symbol' => '$', 'exchange_rate' => 1]);
                break;
        }

        return $next($request);
    }
}
