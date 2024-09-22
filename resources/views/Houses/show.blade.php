@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Rumah</h1>
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <h4>Alamat: {{ $house->address }}</h4>
                    <p>Harga: Rp {{ number_format($house->price, 0, ',', '.') }}</p>
                    <p>Status: 
                        <span class="badge {{ $house->status == 'available' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($house->status) }}
                        </span>
                    </p>
                </div>

                <div class="ms-3">
                    @if($house->image)
                        <p>Gambar Rumah:</p>
                        <img src="{{ asset('storage/' . $house->image) }}" alt="House Image" class="img-thumbnail" style="max-width: 250px;">
                    @else
                        <p>Tidak ada gambar tersedia</p>
                    @endif
                </div>
            </div>
            <a href="{{ route('houses.index') }}" class="btn btn-primary  ">Kembali ke Daftar Rumah</a>
        </div>
    </div>
@endsection
