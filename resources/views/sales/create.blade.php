@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Sales Form</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        @if (session('error'))
            <div class="toast-container position-fixed top-5 end-1 p-2" style="z-index: 11">
                <div class="toast align-items-center text-bg-danger border-0 show slide-down" role="alert"
                    aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('error') }}
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

            body {
                background-color: #f8f9fa;
            }

            .form-container {
                background-color: #ffffff;
                padding: 2rem;
                border-radius: 10px;
                box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
                margin-top: 50px;
            }

            .form-container h3 {
                margin-bottom: 1.5rem;
                color: #343a40;
            }

            .btn-primary {
                background-color: #007bff;
                border-color: #007bff;
            }

            .btn-primary:hover {
                background-color: #0056b3;
            }
        </style>
    </head>

    <body>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="form-container">
                        <h3>Sales Form</h3>
                        <form action="{{ route('sales.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="user_id" class="form-label">Sales Agent</label>
                                <select name="user_id" class="form-select">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="house_id" class="form-label">Rumah</label>
                                <select name="house_id" class="form-select">
                                    @foreach ($houses as $house)
                                        <option value="{{ $house->id }}" {{ old('house_id') == $house->id ? 'selected' : '' }}>
                                            {{ $house->address }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="sale_date" class="form-label">Tanggal Penjualan</label>
                                <input type="date" name="sale_date" class="form-control" value="{{ old('sale_date') }}">
                            </div>

                            <div class="mb-3">
                                <label for="total_price" class="form-label">Total Harga</label>
                                <input type="number" name="total_price" class="form-control"
                                    placeholder="Enter total price" value="{{ old('total_price') }}">
                                @error('total_price')
                                    <div class="text-danger">{{ $message }}</div> <!-- Pesan error validasi -->
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Simpan Penjualan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    </body>

    </html>
@endsection
