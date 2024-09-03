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

                        <table class="table">
                            <thead></thead>
                            <tbody>
                                <tr class="table-active">
                                    <th scope="row"></th>
                                    <td colspan="2" class="table-active">Kawalan</td>
                                    <td><a href="/agama">Agama</a></td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                   <td colspan="2"></td>
                                    <td><a href="/bangsa">Bangsa</a></td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td colspan="2"></td>
                                    <td><a href="/gelaran">Gelaran</a></td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td colspan="2"></td>
                                    <td><a href="/gkategori">Kumpulan Kategori</a></td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td colspan="2"></td>
                                    <td><a href="/kesalahan">Kesalahan</a></td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td colspan="2"></td>
                                    <td><a href="/akta">Akta</a></td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td colspan="2"></td>
                                    <td><a href="/status">Status</a></td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td colspan="2"></td>
                                    <td><a href="/hukuman">Hukuman</a></td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td colspan="2"></td>
                                    <td><a href="/panel">Panel</a></td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td colspan="2"></td>
                                    <td><a href="/gred">Gred</a></td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td colspan="2" class="table-active">Kawalan / Cuti</td>
                                    <td><a href="/gcuti">Jenis Cuti</a></td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td colspan="2"></td>
                                    <td><a href="/gkcuti">Jenis Kumpulan Cuti</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
