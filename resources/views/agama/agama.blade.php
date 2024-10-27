@extends('layouts.app')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-start min-vh-100 py-4">
        <div class="row w-100" style="max-width: 1000px;">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Agama</h2>
                    <a class="btn btn-success" onClick="add()" href="javascript:void(0)"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Agama</a>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p class="mb-0">{{ $message }}</p>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="agama">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Agama</th>
                                        <th style="white-space: nowrap; text-align: center;">Last Update</th>
                                        <th class="text-center">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($agama as $item)
                                        <tr>
                                            <td style="width: 1px; white-space: nowrap; text-align: center;">{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_agama }}</td>
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
                            {!! $agama->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit Agama -->
    <div class="modal fade" id="agama-modal" tabindex="-1" aria-labelledby="agamaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agamaModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="AgamaForm" name="AgamaForm">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="nama_agama" class="form-label">Nama Agama</label>
                            <input type="text" class="form-control" id="nama_agama" name="nama_agama" maxlength="50"
                                required>
                            <div class="invalid-feedback" id="nama_agama_error"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" form="AgamaForm"><i class="fas fa-save"></i> Simpan</button>
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

        function add() {
            $('#AgamaForm').trigger("reset");
            $('#agamaModalLabel').html("Tambah Agama");
            $('#agama-modal').modal('show');
            $('#id').val('');
            $('#nama_agama').attr('readonly', false);
            $('#btn-save').show();
            clearErrors();
        }

        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('agama.edit') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#agamaModalLabel').html("Edit Agama");
                    $('#agama-modal').modal('show');
                    $('#id').val(res.id);
                    $('#nama_agama').val(res.nama_agama);
                    $('#nama_agama').attr('readonly', false);
                    $('#btn-save').show();
                    clearErrors();
                }
            });
        }

        function deleteFunc(id) {
            if (confirm("Delete record?")) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('agama.destroy') }}",
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

        $('#AgamaForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                type: 'POST',
                url: "{{ route('agama.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#agama-modal").modal('hide');
                    window.location.reload();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        displayErrors(errors);
                    } else {
                        console.log(xhr);
                    }
                }
            });
        });

        function displayErrors(errors) {
            clearErrors();
            $.each(errors, function(field, messages) {
                var inputElement = $('#' + field);
                inputElement.addClass('is-invalid');
                var errorElement = $('#' + field + '_error');
                errorElement.html(messages.join('<br>')).show();
            });
        }

        function clearErrors() {
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').html('').hide();
        }

        $('#agama-modal').on('hidden.bs.modal', function() {
            clearErrors();
        });
    </script>
@endsection
