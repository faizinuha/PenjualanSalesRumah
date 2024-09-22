@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Fasilitas</h2>

    <form action="{{ route('fasilitas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Fasilitas</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="house_id" class="form-label">Pilih Rumah</label>
            <select name="house_id" id="house_id" class="form-select" required>
                @foreach($houses as $house)
                    <option value="{{ $house->id }}">{{ $house->address }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi (Opsional)</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('fasilitas.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
