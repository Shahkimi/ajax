@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                        <div  class="padding:20px">&nbsp;</div>

                        <nav class="navbar navbar-expand-lg bg-body-tertiary">
                            <div class="container-fluid">
                                <a class="navbar-brand" href="#">Navbar</a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Perkhidmatan
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="/ptj">Carian Pegawai</a></li>
                                            <li><a class="dropdown-item" href="/panel">Panel PPSM</a></li>
                                            <li><a class="dropdown-item" href="/agama">Agama</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="#">Link</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Kawalan
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="/ptj">Ptj</a></li>
                                            <li><a class="dropdown-item" href="/panel">Panel PPSM</a></li>
                                            <li><a class="dropdown-item" href="/agama">Agama</a></li>
                                            <li><a class="dropdown-item" href="/bangsa">Bangsa</a></li>
                                            <li><a class="dropdown-item" href="/gelaran">Gelaran</a></li>
                                            <li><a class="dropdown-item" href="#">Kod Jawatan *</a></li>
                                            <li><a class="dropdown-item" href="/gkategori">Kod Kategori</a></li>
                                            <li><a class="dropdown-item" href="/jawatan">Jawatan</a></li>
                                            <li><a class="dropdown-item" href="/akta">Akta</a></li>
                                            <li><a class="dropdown-item" href="/gred">Gred</a></li>
                                            <li><a class="dropdown-item" href="/hukuman">Hukuman</a></li>
                                            <li><a class="dropdown-item" href="/kesalahan">Kesalahan</a></li>
                                            <li><a class="dropdown-item" href="/status">Status</a></li>
                                            <li><a class="dropdown-item" href="/gcuti">Jenis Cuti</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="/gkcuti"> 1. Kumpulan Cuti</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                </div>
                            </div>
                            </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
