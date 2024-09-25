@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Riwayat Transaksi</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Alamat Rumah</th>
                    <th>Jumlah Pembayaran</th>
                    <th>Metode Pembayaran</th>
                    <th>Status Transaksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->payment->house->address }}</td> <!-- Menampilkan alamat rumah -->
                        <td>{{ number_format($transaction->payment->amount, 0, ',', '.') }}</td> <!-- Jumlah Pembayaran -->
                        <td>{{ $transaction->payment->payment_method }}</td> <!-- Metode Pembayaran -->
                        <td>{{ $transaction->transaction_status }}</td> <!-- Status Transaksi -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
