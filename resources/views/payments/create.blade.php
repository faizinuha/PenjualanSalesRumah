@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Pembayaran Rumah</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('payments.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="house_id" class="form-label">Pilih Rumah</label>
                                    
                                <input type="text" class="form-control" value="{{ $house->address }}  | Rp. {{ number_format($house->price, null, '.', '.') }}" readonly required>
                                <input type="hidden" name="house_id" value="{{$house->id}}">
                                
                            </div>

                            <div class="form-group mb-3">
                                <label for="amount" class="form-label">Jumlah Pembayaran</label>
                                <input type="number" name="amount" class="form-control" placeholder="Masukkan jumlah pembayaran" required>
                            </div>

                            <div class="form-group mb-4">
                                <label for="payment_method" class="form-label">Metode Pembayaran</label>
                                <select name="payment_method" class="form-control" required>
                                    <option value="atm">ATM</option>
                                    <option value="Tunai">Tunai</option>
                                    <option value="Kartu Kredit">Kartu Kredit</option>
                                </select>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-block">Bayar Sekarang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
