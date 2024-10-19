@extends('layouts.layout')

@section('content')
    <div class="container mt-5 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card p-5 shadow-lg border-0 rounded-4"
            style="background: linear-gradient(to bottom right, #f8f9fa, #e9ecef); width: 50%;">
            <h2 class="text-center mb-4 text-dark fw-bold">Tambah Produk</h2>

            <form action="{{ route('medicines.store') }}" method="POST">
                @csrf

                {{-- Pesan Error --}}
                @if ($errors->any())
                    <div class="alert alert-danger rounded-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Input Nama Produk --}}
                <div class="mb-4">
                    <label for="name" class="form-label fw-semibold">Nama Produk:</label>
                    <input type="text" class="form-control rounded-3 shadow-sm" id="name" name="name"
                        value="{{ old('name') }}" placeholder="Masukkan nama produk"
                        style="background-color: #fff; border: 1px solid #dee2e6;">
                </div>

                {{-- Pilihan Jenis Produk --}}
                <div class="mb-4">
                    <label for="type" class="form-label fw-semibold">Jenis Produk:</label>
                    <select class="form-select rounded-3 shadow-sm" name="type" id="type"
                        style="background-color: #fff; border: 1px solid #dee2e6;">
                        <option selected disabled hidden>Pilih Jenis Produk</option>
                        <option value="tablet" {{ old('type') == 'tablet' ? 'selected' : '' }}>Elektronik</option>
                        <option value="kapsul" {{ old('type') == 'kapsul' ? 'selected' : '' }}>Fashion</option>
                        <option value="sirup" {{ old('type') == 'sirup' ? 'selected' : '' }}>Rumah Tangga</option>
                    </select>
                </div>

                {{-- Input Harga Produk --}}
                <div class="mb-4">
                    <label for="price" class="form-label fw-semibold">Harga:</label>
                    <input type="number" class="form-control rounded-3 shadow-sm" id="price" name="price"
                        value="{{ old('price') }}" placeholder="Masukkan harga produk"
                        style="background-color: #fff; border: 1px solid #dee2e6;">
                </div>

                {{-- Input Stok Produk --}}
                <div class="mb-4">
                    <label for="stock" class="form-label fw-semibold">Stok:</label>
                    <input type="number" class="form-control rounded-3 shadow-sm" id="stock" name="stock"
                        value="{{ old('stock') }}" placeholder="Masukkan jumlah stok"
                        style="background-color: #fff; border: 1px solid #dee2e6;">
                </div>

                {{-- Tombol Submit --}}
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-gradient shadow-sm px-5 py-2 rounded-pill">
                        <i class="bi bi-save me-2"></i>Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Custom Styles --}}
    <style>
        .btn-gradient {
            background: linear-gradient(to right, #353940, #191e24);
            color: white;
            transition: all 0.3s ease-in-out;
        }

        .btn-gradient:hover {
            background: linear-gradient(to right, #9bb0d4, #79d295);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #9bb0d4;
            box-shadow: 0 0 5px rgba(133, 167, 203, 0.5);
        }
    </style>
@endsection
