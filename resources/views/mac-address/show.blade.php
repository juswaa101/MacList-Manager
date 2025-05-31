@extends('layouts.app')

@section('title', 'MAC Addresses - View')

@section('content')
    <div class="container py-4">
        <h1 class="h3 mb-4">View MAC Address</h1>

        @if ($errors->has('error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-center"
                role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <span>{{ $errors->first('error') }}</span>
                </div>
                <button type="button" class="btn-close ms-3" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- MAC Address --}}
        <div class="mb-3">
            <label class="form-label fw-bold">MAC Address:</label>
            <div class="form-control-plaintext">{{ $macAddress->mac_address }}</div>
        </div>

        {{-- Type --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Type:</label>
            <div class="form-control-plaintext">
                <span @class([
                    'badge',
                    'p-2',
                    'fw-bold',
                    'bg-success' => $macAddress->type === \App\Enum\MacTypeEnum::WHITELIST,
                    'bg-danger' => $macAddress->type === \App\Enum\MacTypeEnum::BLACKLIST,
                ])>
                    {{ ucfirst($macAddress->type) }}
                </span>
            </div>
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Description:</label>
            <div class="form-control-plaintext">
               <p style="word-wrap: break-word;">
                {{ $macAddress->description ?? '-' }}
                </p>    
            </div>
        </div>

        {{-- Back Button --}}
        <div class="d-flex justify-content-end">
            <a href="{{ route('mac-addresses.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>
@endsection
