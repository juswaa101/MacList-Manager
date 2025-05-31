@extends('layouts.app')

@section('title', 'MAC Addresses - Edit')

@section('content')
    <div class="container py-4">
        <h1 class="h3 mb-4">Edit MAC Address</h1>

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

        <form action="{{ route('mac-addresses.update', $macAddress->id) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            {{-- MAC Address Field --}}
            <div class="mb-3">
                <label for="mac_address" class="form-label">MAC Address <span class="text-danger">*</span></label>
                <small class="text-muted d-block mb-1">Example: AA:BB:CC:DD:EE:FF. This field is required.</small>
                <input type="text" name="mac_address" id="mac_address" value="{{ $macAddress->mac_address }}"
                    class="form-control @error('mac_address') is-invalid @enderror" value="{{ old('mac_address') }}"
                    required>
                @error('mac_address')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Type Field --}}
            <div class="mb-3">
                <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                <small class="text-muted d-block mb-1">Select either Whitelist or Blacklist. This field is required.</small>
                <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                    <option value="">-- Select Type --</option>
                    @foreach (App\Enum\MacTypeEnum::values() as $macType)
                        <option value="{{ $macType }}" {{ $macType == $macAddress->type ? 'selected' : '' }}>
                            {{ ucfirst(strtolower($macType)) }}
                        </option>
                    @endforeach
                </select>
                @error('type')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Description Field --}}
            <div class="mb-3">
                <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                <small class="text-muted d-block mb-1">Provide a short description (max 255 characters). This field is
                    required.</small>
                <textarea name="description" id="description" rows="3" maxlength="255"
                    class="form-control @error('description') is-invalid @enderror" required>{{ $macAddress->description }}</textarea>
                <div class="form-text" id="description-counter">0 / 255 characters</div>
                @error('description')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Submit & Cancel --}}
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('mac-addresses.index') }}" class="btn btn-secondary ms-2">Cancel</a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            const $description = $('#description');
            const len = '{{ strlen($macAddress->description) }}';

            // Set initial character count on page load
            $('#description-counter').text(`${len} / 255 characters`);

            // Update count live on input
            $description.on('input', function () {
                const currentLength = $(this).val().length;
                $('#description-counter').text(`${currentLength} / 255 characters`);
            });
        });
    </script>
@endpush
