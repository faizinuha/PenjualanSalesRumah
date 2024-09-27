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

        /* Button for filter */
        #clik {
            background-color: #007bff;
            /* Warna latar belakang tombol */
            color: white;
            /* Warna teks tombol */
            border: none;
            /* Tanpa border */
            cursor: pointer;
            /* Kursor pointer saat hover */
            border-radius: 5px;
            /* Sudut membulat */
            transition: background-color 0.3s;
            /* Transisi warna latar belakang */
            margin-bottom: 10px;
            /* Jarak bawah untuk tombol */
            padding: 10px 15px;
            /* Padding untuk tombol */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #clik:hover {
            background-color: #0056b3;
            /* Warna latar belakang saat hover */
        }

        /* Gaya untuk input slider */
        .input {
            display: none;
            /* Tersembunyi secara default */
            margin-top: 10px;
            /* Jarak atas untuk slider */
            transition: opacity 0.3s, height 0.3s;
            /* Transisi untuk opacity dan tinggi */
            opacity: 0;
            /* Opacity default */
            height: 0;
            /* Tinggi default */
            overflow: hidden;
            /* Menyembunyikan overflow */
        }

        /* Kelas tambahan untuk menampilkan slider */
        .input.show {
            display: block;
            /* Menampilkan slider */
            opacity: 1;
            /* Opacity penuh */
            height: auto;
            /* Tinggi otomatis */
        }

        /* Style untuk filter container */
        #filterContainer {
            padding: 15px;
            background-color: #f1f1f1;
            /* Warna latar belakang filter */
            border-radius: 5px;
            /* Sudut membulat */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* Bayangan */
            margin-bottom: 20px;
            /* Jarak bawah */
        }

        /* Gaya untuk label dan input */
        .filter-label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            /* Jarak bawah untuk input */
            transition: border-color 0.3s;
            /* Transisi border */
        }

        input[type="text"]:focus {
            border-color: #007bff;
            /* Border saat fokus */
            outline: none;
            /* Menghapus outline default */
        }

        .price-range {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>{{ __('Perumahan') }}</span>
                        <button id="clik" onclick="toggleFilter()">
                            <p class="small mb-0">Filter</p>
                        </button>
                    </div>

                    <div id="filterContainer" class="input">
                        <div class="filter-label">Rentang Harga:</div>
                        <div class="price-range">
                            <input type="hidden" id="min_price" min="0" max="1000000000" value="0"
                                oninput="updatePriceDisplay()">
                            <input type="text" id="max_price" min="0" max="1000000000"
                                placeholder="Masukan Harga??" oninput="updatePriceDisplay()">
                        </div>
                        <div>
                            <span><span id="minPriceDisplay">0</span></span>
                            <span>Harga Maksimum: Rp <span id="maxPriceDisplay">1000000000</span></span>
                        </div>
                    </div>

                    <script>
                        function toggleFilter() {
                            var filterContainer = document.getElementById("filterContainer");
                            filterContainer.classList.toggle('show'); // Mengganti kelas untuk transisi
                            resetFilters(); // Reset filter ketika dibuka
                        }

                        function updatePriceDisplay() {
                            var minPriceInput = document.getElementById("min_price");
                            var maxPriceInput = document.getElementById("max_price");

                            // Mengambil nilai dari input
                            var minPrice = minPriceInput.value ? parseInt(minPriceInput.value) : 0; // Default 0 jika kosong
                            var maxPrice = maxPriceInput.value ? parseInt(maxPriceInput.value) :
                                1000000000; // Default 1000000000 jika kosong

                            // Menampilkan harga minimum dan maksimum
                            document.getElementById("minPriceDisplay").textContent = minPrice.toLocaleString();
                            document.getElementById("maxPriceDisplay").textContent = maxPrice.toLocaleString();

                            filterHouses(minPrice, maxPrice); // Memanggil fungsi filter
                        }


                        function resetFilters() {
                            // Reset nilai input
                            document.getElementById("min_price").value = 0;
                            document.getElementById("max_price").value = '';

                            // Reset tampilan harga
                            document.getElementById("minPriceDisplay").textContent = '0';
                            document.getElementById("maxPriceDisplay").textContent = '1000000000';

                            // Menampilkan semua rumah
                            const houses = document.querySelectorAll('.house-card');
                            houses.forEach(house => {
                                house.style.display = 'block'; // Tampilkan semua kartu rumah
                            });
                        }


                        function filterHouses(minPrice, maxPrice) {
                            const houses = document.querySelectorAll('.house-card');

                            houses.forEach(house => {
                                const priceText = house.querySelector('.price').textContent.replace('Rp ', '').replace(/\./g, '');
                                const price = parseInt(priceText); // Mengonversi harga menjadi integer

                                // Jika harga kosong atau sesuai rentang, tampilkan rumah
                                if (price >= minPrice && price <= maxPrice) {
                                    house.style.display = 'block'; // Tampilkan kartu rumah
                                } else {
                                    house.style.display = 'none'; // Sembunyikan kartu rumah
                                }
                            });
                        }
                    </script>


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
                                    <img src="{{ asset('storage/' . $i->image) }}" class="cover" alt="{{ $i->title }}">
                                    <!-- House Details -->
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $i->address }}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Status: <span
                                                class="badge bg-{{ $i->status === 'available' ? 'success' : 'danger' }}">{{ ucfirst($i->status) }}</span>
                                        </h6>
                                        <h6 class="card-subtitle mb-2 text-muted">Tipe: {{ ucfirst($i->tipe) }}</h6>
                                        <p class="price">Rp {{ number_format($i->price, 0, ',', '.') }}</p>
                                        <a href="{{ route('houses.show', $i->id) }}" class="btn btn-primary w-100">Detail
                                            Rumah</a>
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
