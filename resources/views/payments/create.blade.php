@extends('layouts.app')

@section('content')
    @if (session('errror'))
        <div class="toast-container position-fixed top-5 end--1 p-2" style="z-index: 11">
            <div class="toast align-items-center text-bg-danger border-0 show slide-down" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('errror') }}
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
        <h1 class="text-center mb-4">Pembayaran Rumah</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('payments.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="house_id" class="form-label">Pilih Rumah</label>

                                <input type="text" class="form-control"
                                    value="{{ $house->address }}  | Rp. {{ number_format($house->price, null, '.', '.') }}"
                                    readonly required>
                                <input type="hidden" name="house_id" value="{{ $house->id }}">

                            </div>

                            <div class="form-group mb-3">
                                <label for="amount" class="form-label">Jumlah Pembayaran</label>
                                <input type="number" name="amount" value="{{old( 'amount' )}}" class="form-control"
                                    placeholder="Masukkan jumlah pembayaran" required>
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
