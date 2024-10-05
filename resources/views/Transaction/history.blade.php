@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <h1 class="text-center mb-4">Riwayat Transaksi</h1>
        <div class="row">
            @foreach ($transactions as $transaction)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-lg" style="border-radius: 15px; overflow: hidden;">
                        <!-- Gambar Rumah -->
                        <img src="{{ $transaction->payment->house ? asset('storage/'. $transaction->payment->house->image) : 'default-image.jpg' }}" class="card-img-top" alt="Gambar Rumah" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <p><strong>Alamat Rumah:</strong> {{ $transaction->payment->house->address }}</p>
                            <p><strong>Jumlah Pembayaran:</strong> Rp{{ number_format($transaction->payment->amount, 0, ',', '.') }}</p>
                            <p><strong>Metode Pembayaran:</strong> {{ $transaction->payment->payment_method }}</p>
                            <p><strong>Status Transaksi:</strong> 
                                <span class="badge bg bg-success 
                                    @if($transaction->transaction_status == 'success') badge-success
                                    @elseif($transaction->transaction_status == 'pending') badge-warning
                                    @else badge-danger
                                    @endif">
                                    {{ ucfirst($transaction->transaction_status) }}
                                </span>
                            </p>
                        </div>
                        <div class="card-footer text-muted text-center">
                            {{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y') }}
                            <!-- Tombol Hapus -->
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $transaction->id }}">Hapus</button>

                            <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade" id="deleteModal{{ $transaction->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $transaction->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $transaction->id }}">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus transaksi ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
