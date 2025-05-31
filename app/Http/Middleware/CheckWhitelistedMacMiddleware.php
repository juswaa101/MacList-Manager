<?php

namespace App\Http\Middleware;

use App\Models\MacAddress;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response;

class CheckWhitelistedMacMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $clientMac = $this->getClientMacAddress();
        $developerMacs = $this->getDeveloperMacs();

        // Bypass the check for developer MAC addresses
        if (in_array($clientMac, $developerMacs)) {
            return $next($request);
        }

        // Check if the MAC address exists and is whitelisted
        $isWhitelisted = MacAddress::macAddressWhitelist($clientMac)->exists();

        if (! $isWhitelisted) {
            abort(HttpResponse::HTTP_FORBIDDEN, 'Access denied: MAC address not whitelisted.');
        }

        return $next($request);
    }

    // Get the developer MAC addresses from the configuration
    protected function getDeveloperMacs(): array
    {
        $developerMacs = explode(',', config('mac_address.developers_mac_addresses', ''));

        return array_map('trim', $developerMacs);
    }

    // Get the MAC address of the client via the command line
    protected function getClientMacAddress(): ?string
    {
        $output = [];
        exec('getmac', $output);

        foreach ($output as $line) {
            if (preg_match('/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})/', $line, $matches)) {
                // Replace dashes with colons and return
                return strtoupper(str_replace('-', ':', $matches[0]));
            }
        }

        return null;
    }
}
