@extends('layouts.layout')

@section('content')
    <div class="container mt-4">

        {{-- Carousel (Slider Gambar) --}}
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://via.placeholder.com/1200x400?text=Promo+1" class="d-block w-100" alt="Promo 1">
                </div>
                <div class="carousel-item">
                    <img src="https://via.placeholder.com/1200x400?text=Promo+2" class="d-block w-100" alt="Promo 2">
                </div>
                <div class="carousel-item">
                    <img src="https://via.placeholder.com/1200x400?text=Promo+3" class="d-block w-100" alt="Promo 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        {{-- Kategori Produk --}}
        <h2 class="mt-5 mb-3">Kategori</h2>
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <img src="https://via.placeholder.com/200?text=Elektronik" class="card-img-top" alt="Elektronik">
                    <div class="card-body text-center">
                        <h5 class="card-title">Elektronik</h5>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <img src="https://via.placeholder.com/200?text=Fashion" class="card-img-top" alt="Fashion">
                    <div class="card-body text-center">
                        <h5 class="card-title">Fashion</h5>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <img src="https://via.placeholder.com/200?text=Kesehatan" class="card-img-top" alt="Kesehatan">
                    <div class="card-body text-center">
                        <h5 class="card-title">Kesehatan</h5>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <img src="https://via.placeholder.com/200?text=Rumah+Tangga" class="card-img-top" alt="Rumah Tangga">
                    <div class="card-body text-center">
                        <h5 class="card-title">Rumah Tangga</h5>
                    </div>
                </div>
            </div>
        </div>

        {{-- Produk Populer --}}
        <h2 class="mt-5 mb-3">Produk Populer</h2>
        <div class="row">
            @for ($i = 0; $i < 8; $i++)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/200?text=Produk+{{ $i + 1 }}" class="card-img-top"
                            alt="Produk {{ $i + 1 }}">
                        <div class="card-body">
                            <h5 class="card-title">Produk {{ $i + 1 }}</h5>
                            <p class="card-text">Rp {{ number_format(100000 * ($i + 1), 0, ',', '.') }}</p>
                            <a href="#" class="btn btn-primary w-100">Beli Sekarang</a>
                        </div>
                    </div>
                </div>
            @endfor
        </div>

    </div>

    {{-- Footer --}}
    <footer class="bg-dark text-white mt-5">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-4">
                    <h5>TokoShop</h5>
                    <p>Toko online terpercaya dengan beragam produk pilihan dan promo menarik.</p>
                </div>
                <div class="col-md-4">
                    <h5>Tautan Cepat</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none">Tentang Kami</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Bantuan</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Ikuti Kami</h5>
                    <div class="d-flex">
                        <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-secondary text-center py-2">
            <small>&copy; 2024 TokoShop. All Rights Reserved.</small>
        </div>
    </footer>
@endsection
