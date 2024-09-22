@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Fasilitas Rumah</h2>

    <!-- Notifikasi sukses -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('fasilitas.create') }}" class="btn btn-primary">Tambah Fasilitas</a>
    </div>

    <div class="row">
        @forelse ($fasilitas as $f)
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $f->name }}</h5>
                        <p class="card-text">{{ $f->description }}</p>
                        
                        <!-- Informasi Rumah terkait -->
                        <div class="mt-3">
                            <h6 class="text-muted">Rumah terkait:</h6>
                            <p>Alamat: <strong>{{ $f->house->address }}</strong></p>
                            <p>Harga: Rp {{ number_format($f->house->price, 0, ',', '.') }}</p>
                        </div>
                        
                        <a href="{{ route('fasilitas.edit', $f->id) }}" class="btn btn-warning">Edit</a>

                        <form action="{{ route('fasilitas.destroy', $f->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus fasilitas ini?')">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>Belum ada fasilitas yang tersedia.</p>
        @endforelse
    </div>
</div>
@endsection
