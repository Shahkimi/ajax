@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto"> <!-- Center the card in the middle of the page -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>PTJ</h2>
                    <a class="btn btn-success" onClick="add()" href="javascript:void(0)">Tambah PTJ</a>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center mb-4">
                            <form id="searchForm" method="POST" class="w-100">
                                @csrf
                                <div class="input-group">
                                    <input class="form-control" id="search" name="search" placeholder="Search...">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </form>
                        </div>

                        <table class="table table-bordered table-striped" id="ptj">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NO PTJ</th>
                                    <th>Nama PTJ</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody id="ptjTableBody">
                                @foreach ($ptj as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ strtoupper($item->kod_ptj) }}</td>
                                        <td>{{ strtoupper($item->desc_ptj) }}</td>
                                        <td>
                                            <a href="javascript:void(0)" onClick="viewFunc({{ $item->id }})"
                                                class="btn btn-primary btn-sm">Lihat</a>
                                            <a href="javascript:void(0)" onClick="editFunc({{ $item->id }})"
                                                class="btn btn-success btn-sm">Kemaskini</a>
                                            <a href="javascript:void(0)" onClick="deleteFunc({{ $item->id }})"
                                                class="btn btn-danger btn-sm">Hapus</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $ptj->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal Tambah/Edit PTJ -->
    <div class="modal fade" id="ptj-modal" tabindex="-1" aria-labelledby="ptjModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ptjModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="PtjForm" name="PtjForm">
                        <input type="hidden" name="id" id="id">
                        <div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="kod_ptj" class="form-label">No Ptj</label>
                                    <input type="text" class="form-control" id="kod_ptj" name="kod_ptj" maxlength="50"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="desc_ptj" class="form-label">Nama Ptj</label>
                                    <input type="text" class="form-control" id="desc_ptj" name="desc_ptj"
                                        maxlength="100" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="ketua_ptj" class="form-label">Ketua Ptj</label>
                            <input type="text" class="form-control" id="ketua_ptj" name="ketua_ptj" maxlength="50"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat_ptj" class="form-label">Alamat Ptj</label>
                            <input type="text" class="form-control" id="alamat_ptj" name="alamat_ptj" maxlength="100"
                                required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" form="PtjForm">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Add AJAX search functionality
        $('#searchForm').on('submit', function(e) {
            e.preventDefault();

            let searchQuery = $('#search').val();

            $.ajax({
                type: 'POST',
                url: '{{ route('ptj.search') }}',
                data: {
                    search: searchQuery
                },
                success: function(response) {
                    let rows = '';
                    response.data.forEach(function(item, index) {
                        rows += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.kod_ptj}</td>
                                <td>${item.desc_ptj}</td>
                                <td>
                                    <a href="javascript:void(0)" onClick="editFunc(${item.id})"
                                        class="btn btn-success btn-sm">Kemaskini</a>
                                    <a href="javascript:void(0)" onClick="deleteFunc(${item.id})"
                                        class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>`;
                    });
                    $('#ptjTableBody').html(rows);
                }
            });
        });

        //Add Data
        function add() {
            $('#PtjForm').trigger("reset");
            $('#ptjModalLabel').html("Tambah Ptj");
            $('#ptj-modal').modal('show');
            $('#id').val('');
            $('#kod_ptj').attr('readonly', false);
            $('#desc_ptj').attr('readonly', false);
            $('#ketua_ptj').attr('readonly', false);
            $('#alamat_ptj').attr('readonly', false);
            $('#btn-save').show();
        }

        //Edit data
        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('ptj.edit') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#ptjModalLabel').html("Edit Ptj");
                    $('#ptj-modal').modal('show');
                    $('#id').val(res.id);
                    $('#kod_ptj').val(res.kod_ptj);
                    $('#desc_ptj').val(res.desc_ptj);
                    $('#ketua_ptj').val(res.ketua_ptj);
                    $('#alamat_ptj').val(res.alamat_ptj);
                    $('#kod_ptj').attr('readonly', false);
                    $('#desc_ptj').attr('readonly', false);
                    $('#ketua_ptj').attr('readonly', false);
                    $('#alamat_ptj').attr('readonly', false);
                    $('#btn-save').show();
                }
            });
        }

        //Delete Data
        function deleteFunc(id) {
            if (confirm("Delete record?")) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('ptj.destroy') }}",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(res) {
                        window.location.reload();
                    }
                });
            }
        }

        function viewFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('ptj.view') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#ptjModalLabel').html("Maklumat Ptj");
                    $('#ptj-modal').modal('show');
                    $('#id').val(res.id);
                    $('#kod_ptj').val(res.kod_ptj);
                    $('#desc_ptj').val(res.desc_ptj);
                    $('#ketua_ptj').val(res.ketua_ptj);
                    $('#alamat_ptj').val(res.alamat_ptj);
                    $('#kod_ptj').attr('readonly', false);
                    $('#desc_ptj').attr('readonly', false);
                    $('#ketua_ptj').attr('readonly', false);
                    $('#alamat_ptj').attr('readonly', false);
                    $('#btn-save').hide();
                    clearErrors();
                }
            });
        }

        $('#PtjForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                type: 'POST',
                url: "{{ route('ptj.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#ptj-modal").modal('hide');
                    window.location.reload();
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endsection
