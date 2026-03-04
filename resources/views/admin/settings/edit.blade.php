@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">App Settings</h1>
    </div>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="download_link" class="form-label">Download link (EAS build / app URL)</label>
                    <input
                        type="url"
                        name="download_link"
                        id="download_link"
                        class="form-control @error('download_link') is-invalid @enderror"
                        value="{{ old('download_link', $downloadLink ?? '') }}"
                        required
                    >
                    @error('download_link')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">
                        This link will be used for the "Download now" button on the public landing page.
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    Save
                </button>
            </form>
        </div>
    </div>
@endsection

