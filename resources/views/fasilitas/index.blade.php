@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Daftar Fasilitas Rumah</h2>

        <!-- Notifikasi sukses -->
        @if (session('success'))
            <div class="toast-container position-fixed top-5 end--1 p-2" style="z-index: 11">
                <div class="toast align-items-center text-bg-success border-0 show slide-down" role="alert"
                    aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
            </div>
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

        <!-- Tombol Tambah Fasilitas -->
        <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('fasilitas.create') }}" class="btn btn-primary btn-lg">
                <i class="bx bx-plus"></i> Tambah Fasilitas
            </a>
        </div>

        <div class="row">
            @forelse ($fasilitas as $f)
                <div class="col-md-6">
                    <div class="card mb-4 shadow-sm border-0 rounded-3" style="background-color:gray;">
                        <div class="card-body">
                            {{-- <h5 class="card-title fw-bold">Status Fasilitas:{{ $f->name }}</h5> --}}

                            <!-- Informasi Rumah terkait -->
                            <div class="mt-3 bg-light p-3 rounded">
                                <h6 class="text-muted">Rumah terkait:</h6>
                                <!-- Gambar Rumah -->
                                <td>
                                    @if ($f->house->image)
                                        <img src="{{ asset('storage/' . $f->house->image) }}" alt="House Image"
                                            class="img-thumbnail shadow-sm" style="max-width: 120px; border-radius: 8px;">
                                    @else
                                        <span class="text-muted">Tidak ada gambar</span>
                                    @endif
                                </td>
                                <!-- Detail Alamat dan Harga -->
                                <p>Alamat: <strong>{{ $f->house->address }}</strong></p>
                                <p>Harga: Rp {{ number_format($f->house->price, 0, ',', '.') }}</p>
                                <p class="card-text">Deskripsi:{{ $f->description }}</p>

                            </div>

                            <!-- Tombol Edit dan Hapus -->
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('fasilitas.edit', $f->id) }}" class="btn btn-warning btn-sm px-4">
                                    <i class="bx bx-edit"></i> Edit
                                </a>

                                <form action="{{ route('fasilitas.destroy', $f->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm px-4"
                                        onclick="return confirm('Yakin ingin menghapus fasilitas ini?')">
                                        <i class="bx bx-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">Belum ada fasilitas yang tersedia.</p>
            @endforelse
        </div>
    </div>
@endsection
