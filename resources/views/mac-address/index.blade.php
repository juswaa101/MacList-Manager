@extends('layouts.app')

@section('title', 'MAC Addresses')

@section('content')
    <div class="container py-4">

        @session('success')
            <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center"
                role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" class="btn-close ms-3" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endsession

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

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 mb-0">MAC Addresses</h1>
            <div>
                <a href="{{ route('mac-addresses.create') }}" class="btn btn-primary me-2">
                    <i class="fas fa-plus-circle me-1"></i> Add New
                </a>
                @if (!$macAddresses->isEmpty())
                    <form action="{{ route('mac-addresses.clear') }}" method="POST" class="d-inline-block"
                        onsubmit="return confirm('Are you sure you want to clear all MAC addresses?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger me-2">
                            <i class="fas fa-trash-alt me-1"></i> Clear MAC Addresses
                        </button>
                    </form>
                @endif
                <a href="{{ route('mac-addresses.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-sync-alt me-1"></i> Reset
                </a>
            </div>
        </div>

        {{-- Search Form --}}
        <form action="{{ route('mac-addresses.index') }}" method="GET" class="row g-2 mb-4">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" name="search" id="search" class="form-control"
                        placeholder="Search MAC Address..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
            </div>
        </form>

        {{-- Data Table --}}
        @if ($macAddresses->isEmpty())
            <div class="alert alert-info">No MAC addresses found.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>MAC Address</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th style="width: 160px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($macAddresses as $mac)
                            <tr>
                                <td>{{ $loop->iteration + ($macAddresses->currentPage() - 1) * $macAddresses->perPage() }}
                                </td>
                                <td>{{ $mac->mac_address }}</td>
                                <td>
                                    <span @class([
                                        'badge',
                                        'fw-bold',
                                        'p-2',
                                        'bg-success' => $mac->type === 'whitelist',
                                        'bg-danger' => $mac->type === 'blacklist',
                                    ])>
                                        {{ ucfirst($mac->type) }}
                                    </span>
                                </td>
                                <td>
                                    {{ Str::limit($mac->description, 50, '...') }}
                                </td>
                                <td>
                                    <a href="{{ route('mac-addresses.show', $mac->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('mac-addresses.edit', $mac->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('mac-addresses.destroy', $mac->id) }}" method="POST"
                                        class="d-inline-block" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4 d-flex justify-content-center">
                {{ $macAddresses->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>
@endsection
