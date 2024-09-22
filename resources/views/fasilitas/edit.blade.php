@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Fasilitas</h2>

    <form action="{{ route('fasilitas.update', $fasilita->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Fasilitas</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $fasilita->name }}" required>
        </div>

        <div class="mb-3">
            <label for="house_id" class="form-label">Pilih Rumah</label>
            <select name="house_id" id="house_id" class="form-select" required>
                @foreach($houses as $house)
                    <option value="{{ $house->id }}" {{ $house->id == $fasilita->house_id ? 'selected' : '' }}>{{ $house->address }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi (Opsional)</label>
            <textarea name="description" id="description" class="form-control">{{ $fasilita->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('fasilitas.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
