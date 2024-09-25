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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-mQLJH4lhyCsc+o3E5CH6IGpxCSDGv4pxyL0J9ed5XztP/ZBdu4O/G6N/dMWnJT28" crossorigin="anonymous">

  <style>
    .table-purple thead {
        background-color: #6f42c1;
        color: white;
        position: sticky;
        top: 0;
        z-index: 1;
    }

    .table-purple tbody tr:nth-child(even) {
        background-color: #f3e5f5;
    }

    .table-purple tbody tr:nth-child(odd) {
        background-color: #e1bee7;
    }

    .table-purple tbody tr:hover {
        background-color: #d1c4e9;
    }

    caption {
        caption-side: top;
        font-size: 1.5rem;
        margin-bottom: 10px;
        color: #6f42c1;
    }

    .btn-custom {
        background-color: #6f42c1;
        border-color: #6f42c1;
    }

    .btn-custom:hover {
        background-color: #5a349e;
        border-color: #5a349e;
    }
    
    .icon-plus::before {
        content: "\f067"; /* Unicode FontAwesome for 'plus' */
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        padding-right: 5px;
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
    
    <table class="table table-hover table-purple table-striped">
      <caption>Daftar Penjualan Rumah</caption>
        <thead>
            <tr>
                <th>Sales Agent</th>
                <th>lokasi</th>
                {{-- <th>Fasilitas</th> --}}
                <th>Tanggal Penjualan</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sales as $sale)
                <tr>
                    <td>{{ $sale->user->name }}</td>
                    <td>{{ $sale->house->address }}</td>
                    {{-- <td>{{ $sale->fasilitas->name }}</td> --}}
                    <td>{{ $sale->sale_date }}</td>
                    <td>Rp {{ number_format($sale->total_price, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </div>

  <!-- Bootstrap JS dan Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+4cq2K2mVV5Tn4z6tztQ2xB+O2u" crossorigin="anonymous"></script>

</body>
</html>
@endsection
