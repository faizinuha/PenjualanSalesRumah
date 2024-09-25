@extends('layouts.app')

@section('content')
<style>
    /* Style for the house cards */
    .house-card {
        margin: 5px;
        flex-basis: 30%;
        max-width: 30%;
        margin-bottom: 30px;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
    }
    
    .house-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    /* Style for house image */
    .cover {
        width: 100%;
        height: 225px;
        object-fit: cover;
        border-radius: 10px 10px 0 0;
        transition: transform 0.3s ease;
    }

    /* .cover:hover {
        transform: scale(1.05);
    } */

    /* Card body styles */
    .card-body {
        padding: 1.5rem;
        background-color: #f8f9fa;
        border-radius: 0 0 10px 10px;
    }

    /* Card title and subtitle */
    .card-title {
        font-weight: bold;
        color: #343a40;
    }

    .card-subtitle {
        font-size: 0.9rem;
        color: #6c757d;
    }

    /* Card button */
    .btn-primary {
        background-color: #007bff;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .price {
        font-weight: bold;
        color: #28a745;
        font-size: 1.2rem;
    }

    /* Container adjustments */
    .container {
        margin-top: 20px;
    }

    .empty-message {
        text-align: center;
        font-size: 1.2rem;
        color: #6c757d;
        margin-top: 20px;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Perumahan') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="d-flex flex-wrap justify-content-start">
                        @forelse ($house as $i)
                            <div class="card house-card">
                                <!-- House Image -->
                                <img src="{{ asset('storage/'.$i->image) }}" class="cover" alt="{{ $i->title }}">
                                
                                <!-- House Details -->
                                <div class="card-body">
                                    <h5 class="card-title">{{ $i->address }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Status: <span class="badge bg-{{ $i->status === 'available' ? 'success' : 'danger' }}">{{ ucfirst($i->status) }}</span></h6>
                                    <h6 class="card-subtitle mb-2 text-muted">Tipe: {{ ucfirst($i->tipe) }}</h6>
                                    <p class="price">Rp {{ number_format($i->price, 0, ',', '.') }}</p>
                                    <a href="{{ route('houses.show', $i->id) }}" class="btn btn-primary w-100">Lihat Detail</a>
                                </div>
                            </div>
                        @empty
                            <p class="empty-message">Tidak ada rumah yang tersedia saat ini.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
