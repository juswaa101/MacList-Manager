<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMacAddressRequest;
use App\Http\Requests\UpdateMacAddressRequest;
use App\Models\MacAddress;
use Exception;

class MacAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mac-address.index', [
            'macAddresses' => MacAddress::query()
                ->when(request()->filled('search'), function ($query) {
                    $query->where('mac_address', 'like', '%'.request()->input('search').'%')
                        ->orWhere('description', 'like', '%'.request()->input('search').'%')
                        ->orWhere('type', 'like', '%'.request()->input('search').'%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mac-address.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMacAddressRequest $request)
    {
        try {
            // Create a new MAC address
            MacAddress::create($request->validated());

            return redirect()->route('mac-addresses.index')
                ->with('success', 'MAC address created successfully.');
        } catch (Exception $e) {
            logger()->error('Failed to create MAC address', [
                'error' => $e->getMessage(),
                'request' => $request->all(),
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'Failed to create MAC address: '.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MacAddress $macAddress)
    {
        return view('mac-address.show', [
            'macAddress' => $macAddress,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MacAddress $macAddress)
    {
        return view('mac-address.edit', [
            'macAddress' => $macAddress,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMacAddressRequest $request, MacAddress $macAddress)
    {
        try {
            // Update the MAC address
            $macAddress->updateOrFail($request->validated());

            return redirect()->route('mac-addresses.index')
                ->with('success', 'MAC address updated successfully.');
        } catch (Exception $e) {
            logger()->error('Failed to update MAC address', [
                'error' => $e->getMessage(),
                'mac_address_id' => $macAddress->id,
                'request' => $request->all(),
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'Failed to update MAC address: '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MacAddress $macAddress)
    {
        try {
            $macAddress->deleteOrFail();

            return redirect()->route('mac-addresses.index')
                ->with('success', 'MAC address deleted successfully.');
        } catch (Exception $e) {
            logger()->error('Failed to delete MAC address', [
                'error' => $e->getMessage(),
                'mac_address_id' => $macAddress->id,
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'Failed to delete MAC address: '.$e->getMessage()]);
        }
    }

    /**
     * Clear the all MAC addresses from the list.
     */
    public function clear()
    {
        try {
            MacAddress::query()->delete();

            return redirect()->route('mac-addresses.index')
                ->with('success', 'All MAC addresses cleared successfully.');
        } catch (Exception $e) {
            logger()->error('Failed to clear MAC addresses', [
                'error' => $e->getMessage(),
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'Failed to clear MAC addresses: '.$e->getMessage()]);
        }
    }
}
