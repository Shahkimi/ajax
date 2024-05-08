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
                        <div>
                            Go to: <a href="/products">Products</a>
                        </div>
                        <div>
                            Go to: <a href="/agama">Agama</a>
                        </div>
                        <div>
                            Go to: <a href="/bangsa">Bangsa</a>
                        </div>
                        <div>
                            Go to: <a href="/gelaran">Gelaran</a>
                        </div>
                        <div>
                            Go to: <a href="/gkategori">Kumpulan Kategori</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
