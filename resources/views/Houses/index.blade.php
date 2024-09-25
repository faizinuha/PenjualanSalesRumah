@extends('layouts.app')

@section('content')

@if (session('success'))
        <div class="toast-container position-fixed top-5 end--1 p-2" style="z-index: 11">
            <div class="toast align-items-center text-bg-success border-0 show slide-down" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        </div>
    <style>
          .toast-container {
            max-width: 300px;
        }

        .slide-down {
            animation: slide-down 2s ease 0s 1 normal forwards;
        }

        @keyframes slide-down {
            from {
                transform: translateZ(-9.7rem);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .fade-out {
            animation: fade-out 1s ease forwards;
        }

        @keyframes fade-out {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
                transform: translateY(-10px);
            }
        }
    </style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var toastElList = [].slice.call(document.querySelectorAll('.toast'));
        var toastList = toastElList.map(function(toastEl) {
            return new bootstrap.Toast(toastEl, {
                delay: 3000
            });
        });
        toastList.forEach(toast => toast.show());
    });
</script>
@endif

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-6">Daftar Rumah</h1>
        <a href="{{ route('houses.create') }}" class="btn btn-primary btn-lg underline">
            <i class="bx bx-plus-circle"></i> Tambah Rumah
        </a>
    </div>

    <div class="table-responsive shadow-sm p-3 mb-5 bg-white rounded">
        <table class="table table-hover table-striped align-middle">
            <thead class="table-dark" border="1">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tipe</th>
                    <th scope="col">Gambar</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($houses as $house)
                <tr class="shadow-sm">
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $house->address }}</td>
                    <td>Rp {{ number_format($house->price, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge {{ $house->status == 'available' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($house->status) }}
                        </span>
                    </td>
                    <td>
                        <h6 class="bold" >{{ $house->tipe }}</h6>
                    </td>
                    <td>
                        @if($house->image)
                        <img src="{{ asset('storage/' . $house->image) }}" alt="House Image" class="img-thumbnail shadow-sm" style="max-width: 120px; border-radius: 8px;">
                        @else
                        <span class="text-muted">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('houses.show', $house->id) }}" class="btn btn-info btn-sm mx-1 shadow-sm">
                            <i class="bx bx-show"></i> Lihat
                        </a>
                        <a href="{{ route('houses.edit', $house->id) }}" class="btn btn-warning btn-sm mx-1 shadow-sm">
                            <i class="bx bx-edit"></i> Edit
                        </a>
                        <form action="{{ route('houses.destroy', $house->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm mx-1 shadow-sm" 
                                onclick="return confirm('Yakin ingin menghapus rumah ini?')">
                                <i class="bx bx-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
