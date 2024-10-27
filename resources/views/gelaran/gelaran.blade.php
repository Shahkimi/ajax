@extends('layouts.app')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-start min-vh-100 py-4">
        <div class="row w-100" style="max-width: 1000px;">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Gelaran</h2>
                    <a class="btn btn-success" onClick="add()" href="javascript:void(0)"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Gelaran</a>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p class="mb-0">{{ $message }}</p>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="gelaran">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gelaran</th>
                                        <th style="white-space: nowrap; text-align: center;">Last Update</th>
                                        <th class="text-center">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gelaran as $item)
                                        <tr>
                                            <td style="width: 1px; white-space: nowrap; text-align: center;">{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_gelaran }}</td>
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
                            {!! $gelaran->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit Gelaran -->
    <div class="modal fade" id="gelaran-modal" tabindex="-1" aria-labelledby="gelaranModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gelaranModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="GelaranForm" name="GelaranForm">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="nama_gelaran" class="form-label">Nama Gelaran</label>
                            <input type="text" class="form-control" id="nama_gelaran" name="nama_gelaran" maxlength="50"
                                required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" form="GelaranForm">Simpan</button>
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
            $('#GelaranForm').trigger("reset");
            $('#gelaranModalLabel').html("Tambah Gelaran");
            $('#gelaran-modal').modal('show');
            $('#id').val('');
            $('#nama_gelaran').attr('readonly', false);
            $('#btn-save').show();
        }

        //Edit data
        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('gelaran.edit') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#gelaranModalLabel').html("Edit Gelaran");
                    $('#gelaran-modal').modal('show');
                    $('#id').val(res.id);
                    $('#nama_gelaran').val(res.nama_gelaran);
                    $('#nama_gelaran').attr('readonly', false);
                    $('#btn-save').show();
                }
            });
        }

        //Delete Data
        function deleteFunc(id) {
            if (confirm("Delete record?")) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('gelaran.destroy') }}",
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

        $('#GelaranForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                type: 'POST',
                url: "{{ route('gelaran.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#gelaran-modal").modal('hide');
                    window.location.reload();
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endsection
