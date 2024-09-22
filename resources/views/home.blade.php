@extends('layouts.app')

@section('content')
<style>
    /* Style untuk gambar rumah */
   .cover {
     max-width: 100%;
     height: 225px;
     object-fit: cover;
     border-radius: 10px;
     transition: transform 0.3s ease;
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
                            <div class="card mb-3 me-3" style="flex-basis: 30%; max-width: 30%;">
                                <!-- Bagian Gambar -->
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('storage/'.$i->image) }}" class="img-fluid img-thumbnail cover" alt="{{ $i->title }}">
                                </div>
                                
                                <!-- Bagian Detail Rumah -->
                                <div class="flex-grow-1 ms-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Alamat: {{ $i->address }}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Status: {{ ucfirst($i->status) }}</h6>
                                        <h6 class="card-subtitle mb-2 text-muted">Tipe: {{ ucfirst($i->tipe) }}</h6>
                                        <p class="card-text">Harga: Rp {{ number_format($i->price, 0, ',', '.') }}</p>
                                        <a href="{{ route('houses.show', $i->id) }}" class="btn btn-primary">Lihat Detail</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>There are no houses available.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
