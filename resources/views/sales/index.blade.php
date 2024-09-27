@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Penjualan Rumah</title>

    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-mQLJH4lhyCsc+o3E5CH6IGpxCSDGv4pxyL0J9ed5XztP/ZBdu4O/G6N/dMWnJT28" crossorigin="anonymous">
    @if (session('success'))
    <div class="toast-container position-fixed top-5 end--1 p-2" style="z-index: 11">
        <div class="toast align-items-center text-bg-success border-0 show slide-down" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var toastElList = [].slice.call(document.querySelectorAll('.toast'));
            var toastList = toastElList.map(function (toastEl) {
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

        .card-custom {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .card-custom:hover {
            transform: translateY(-5px);
        }

        .card-custom .card-body {
            padding: 1.5rem;
        }

        .card-custom .card-title {
            font-size: 1.25rem;
            color: #6f42c1;
        }

        .card-custom .card-text {
            color: #495057;
        }

        .card-custom .sale-info {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .btn-custom {
            background-color: #6f42c1;
            border-color: #6f42c1;
            transition: background-color 0.3s, border-color 0.3s, transform 0.2s;
        }

        .btn-custom:hover {
            background-color: #5a349e;
            border-color: #5a349e;
            transform: translateY(-2px);
        }

        .icon-plus::before {
            content: "\f067"; /* Unicode FontAwesome for 'plus' */
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            padding-right: 5px;
        }

        .img-card {
            object-fit: cover;
            height: 200px; /* Tinggi gambar disesuaikan */
            width: 100%; /* Lebar gambar mengisi seluruh kontainer */
            border-radius: 10px 10px 0 0; /* Memiliki sudut bulat di bagian atas */
        }
    </style>

    <!-- Link FontAwesome (for icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="text-center">Daftar Penjualan Rumah</h1>
            <a href="{{ route('sales.create') }}" class="btn btn-custom">
                <span class="icon-plus"></span>Tambah Sales
            </a>
        </div>

        <div class="row row-cols-1 row-cols-md-2 g-4">
            @foreach($sales as $sale)
            <div class="col">
                <div class="card card-custom">
                    <img src="{{ asset('storage/' . $sale->house->image) }}" class="card-img-top img-card"
                        alt="Gambar Rumah">
                    <div class="card-body">
                        <h5 class="card-title">{{ $sale->house->address }}</h5>
                        <p class="card-text">
                            <strong>Sales Agent:</strong> {{ $sale->user->name }}<br>
                            <strong>Tanggal Penjualan:</strong> {{ $sale->sale_date }}<br>
                            <strong>Total Harga:</strong> Rp {{ number_format($sale->total_price, 0, ',', '.') }}
                        </p>
                        {{-- <a href="#" class="btn btn-custom">Lihat Detail</a> --}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>

    <!-- Bootstrap JS dan Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+4cq2K2mVV5Tn4z6tztQ2xB+O2u" crossorigin="anonymous">
    </script>

</body>

</html>
@endsection
