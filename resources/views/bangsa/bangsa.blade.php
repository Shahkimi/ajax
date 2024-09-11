@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Bangsa</h2>
                    <a class="btn btn-success" onClick="add()" href="javascript:void(0)">Tambah Bangsa</a>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="bangsa">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bangsa</th>
                                    <th>Deskripsi</th>
                                    <th>Tarikh Dicipta</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bangsa as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_bangsa }}</td>
                                        <td>{{ $item->desc_bangsa }}</td>
                                        <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
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
                        {{-- <div class="d-flex justify-content-center"> --}}
                        {!! $bangsa->links('pagination::bootstrap-5') !!}
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit Bangsa -->
    <div class="modal fade" id="bangsa-modal" tabindex="-1" aria-labelledby="bangsaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bangsaModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="BangsaForm" name="BangsaForm">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="nama_bangsa" class="form-label">Nama Bangsa</label>
                            <input type="text" class="form-control" id="nama_bangsa" name="nama_bangsa" maxlength="50"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="desc_bangsa" class="form-label">Deskripsi</label>
                            <input type="text" class="form-control" id="desc_bangsa" name="desc_bangsa" maxlength="100"
                                required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" form="BangsaForm">Simpan</button>
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

        //Add Data
        function add() {
            $('#BangsaForm').trigger("reset");
            $('#bangsaModalLabel').html("Tambah Bangsa");
            $('#bangsa-modal').modal('show');
            $('#id').val('');
            $('#nama_bangsa').attr('readonly', false);
            $('#desc_bangsa').attr('readonly', false);
            $('#btn-save').show();
        }

        //Edit data
        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('bangsa.edit') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#bangsaModalLabel').html("Edit Bangsa");
                    $('#bangsa-modal').modal('show');
                    $('#id').val(res.id);
                    $('#nama_bangsa').val(res.nama_bangsa);
                    $('#desc_bangsa').val(res.desc_bangsa);
                    $('#nama_bangsa').attr('readonly', false);
                    $('#desc_bangsa').attr('readonly', false);
                    $('#btn-save').show();
                }
            });
        }

        //Delete Data
        function deleteFunc(id) {
            if (confirm("Delete record?")) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('bangsa.destroy') }}",
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

        //View Data
        function viewFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('bangsa.view') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#bangsaModalLabel').html("Lihat Bangsa");
                    $('#bangsa-modal').modal('show');
                    $('#id').val(res.id);
                    $('#nama_bangsa').val(res.nama_bangsa);
                    $('#desc_bangsa').val(res.desc_bangsa);
                    $('#nama_bangsa').attr('readonly', true);
                    $('#desc_bangsa').attr('readonly', true);
                    $('#btn-save').hide();
                }
            });
        }

        $('#BangsaForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                type: 'POST',
                url: "{{ route('bangsa.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#bangsa-modal").modal('hide');
                    window.location.reload();
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endsection
