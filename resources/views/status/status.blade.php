@extends('layouts.app')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-start min-vh-100 py-4">
        <div class="row w-100" style="max-width: 1000px;">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Status</h2>
                    <a class="btn btn-success" onClick="add()" href="javascript:void(0)"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Status</a>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p class="mb-0">{{ $message }}</p>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="status">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th style="white-space: nowrap; text-align: center;">Status</th>
                                        <th>Deskripsi</th>
                                        <th style="white-space: nowrap; text-align: center;">Last Update</th>
                                        <th class="text-center">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($status as $item)
                                        <tr>
                                            <td style="width: 1px; white-space: nowrap; text-align: center;">{{ $loop->iteration }}</td>
                                            <td style="width: 1px; white-space: nowrap; text-align: center;">{{ $item->kod_status }}</td>
                                            <td>{{ $item->desc_status }}</td>
                                            <td style="width: 1px; white-space: nowrap; text-align: center;">{{ $item->created_at->format('d-m-Y') }}</td>
                                            <td class="text-center" style="width: 1px; white-space: nowrap;">
                                                <a href="javascript:void(0)" onClick="editFunc({{ $item->id }})"
                                                    class="btn btn-success btn-sm"> <i class="fa fa-pencil" aria-hidden="true"></i> Kemaskini</a>
                                                <a href="javascript:void(0)" onClick="deleteFunc({{ $item->id }})"
                                                    class="btn btn-danger btn-sm"> <i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            {!! $status->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit Status -->
    <div class="modal fade" id="status-modal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="StatusForm" name="StatusForm">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="kod_status" class="form-label">Status</label>
                            <input type="text" class="form-control" id="kod_status" name="kod_status" maxlength="50"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="desc_status" class="form-label">Deskripsi</label>
                            <input type="text" class="form-control" id="desc_status" name="desc_status" maxlength="100"
                                required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" form="StatusForm">Simpan</button>
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
            $('#StatusForm').trigger("reset");
            $('#statusModalLabel').html("Tambah Status");
            $('#status-modal').modal('show');
            $('#id').val('');
            $('#kod_status').attr('readonly', false);
            $('#desc_status').attr('readonly', false);
            $('#btn-save').show();
        }

        //Edit data
        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('status.edit') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#statusModalLabel').html("Edit Status");
                    $('#status-modal').modal('show');
                    $('#id').val(res.id);
                    $('#kod_status').val(res.kod_status);
                    $('#desc_status').val(res.desc_status);
                    $('#kod_status').attr('readonly', false);
                    $('#desc_status').attr('readonly', false);
                    $('#btn-save').show();
                }
            });
        }

        //Delete Data
        function deleteFunc(id) {
            if (confirm("Delete record?")) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('status.destroy') }}",
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
                url: "{{ route('status.view') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#statusModalLabel').html("Lihat Status");
                    $('#status-modal').modal('show');
                    $('#id').val(res.id);
                    $('#kod_status').val(res.kod_status);
                    $('#desc_status').val(res.desc_status);
                    $('#kod_status').attr('readonly', true);
                    $('#desc_status').attr('readonly', true);
                    $('#btn-save').hide();
                }
            });
        }

        // Submit data
        $('#StatusForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                type: 'POST',
                url: "{{ route('status.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#status-modal").modal('hide');
                    window.location.reload();
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endsection
