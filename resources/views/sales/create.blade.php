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
  <style>
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
              @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="house_id" class="form-label">Rumah</label>
            <select name="house_id" class="form-select">
              @foreach($houses as $house)
                <option value="{{ $house->id }}">{{ $house->address }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="fasilitas_id" class="form-label">Fasilitas</label>
            <select name="fasilitas_id" class="form-select">
              @foreach($fasilitas as $fasilitas)
                <option value="{{ $fasilitas->id }}">{{ $fasilitas->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="sale_date" class="form-label">Tanggal Penjualan</label>
            <input type="date" name="sale_date" class="form-control">
          </div>

          <div class="mb-3">
            <label for="total_price" class="form-label">Total Harga</label>
            <input type="number" name="total_price" class="form-control" placeholder="Enter total price">
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