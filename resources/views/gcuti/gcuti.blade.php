@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Kategori Cuti</h2>
                    <a class="btn btn-success" onClick="add()" href="javascript:void(0)">Tambah Kategori Cuti</a>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="gcuti">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kategori Cuti</th>
                                    <th>Jenis Cuti</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gcuti as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->gkcuti->kategori_cuti }}</td>
                                        <td>{{ $item->jenis_cuti }}</td>
                                        <td>
                                            <a href="javascript:void(0)" onClick="viewFunc({{ $item->id }})" class="btn btn-primary btn-sm">Lihat</a>
                                            <a href="javascript:void(0)" onClick="editFunc({{ $item->id }})" class="btn btn-success btn-sm">Kemaskini</a>
                                            <a href="javascript:void(0)" onClick="deleteFunc({{ $item->id }})" class="btn btn-danger btn-sm">Hapus</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <div class="d-flex justify-content-center"> --}}
                        {!! $gcuti->links('pagination::bootstrap-5') !!}
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit Kategori -->
    <div class="modal fade" id="gcuti-modal" tabindex="-1" aria-labelledby="gcutiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gcutiModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="GcutiForm" name="GcutiForm">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="gkcuti_id" class="form-label">Kategori Cuti Options</label>
                            <select class="form-control" id="gkcuti_id" name="gkcuti_id" required>
                                <option value="" selected disabled>Pilih Kategori Cuti</option>
                                @foreach ($gkcutiOptions as $id => $kategori_cuti)
                                    <option value="{{ $id }}">{{ $kategori_cuti }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_cuti" class="form-label">Jenis Cuti</label>
                            <input type="text" class="form-control" id="jenis_cuti" name="jenis_cuti" maxlength="100" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" form="GcutiForm">Simpan</button>
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

        // Add Data
        function add() {
            $('#GcutiForm').trigger("reset");
            $('#gcutiModalLabel').html("Tambah Kategori Cuti");
            $('#gcuti-modal').modal('show');
            $('#id').val('');
            $('#gkcuti_id').val('');
            $('#jenis_cuti').val('');
            $('#btn-save').show();
        }

        // Edit Data
        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ url('edit-gcuti') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#gcutiModalLabel').html("Edit Kategori");
                    $('#gcuti-modal').modal('show');
                    $('#id').val(res.id);
                    $('#gkcuti_id').val(res.gkcuti_id);
                    $('#jenis_cuti').val(res.jenis_cuti);
                    $('#btn-save').show();
                }
            });
        }

        // Delete Data
        function deleteFunc(id) {
            if (confirm("Delete record?")) {
                $.ajax({
                    type: "POST",
                    url: "{{ url('delete-gcuti') }}",
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

        // View Data
        function viewFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ url('view-gcuti') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#gcutiModalLabel').html("Lihat Kategori");
                    $('#gcuti-modal').modal('show');
                    $('#id').val(res.id);
                    $('#gkcuti_id').val(res.gkcuti_id);
                    $('#jenis_cuti').val(res.jenis_cuti);
                    $('#gkcuti_id').attr('disabled', true);
                    $('#jenis_cuti').attr('disabled', true);
                    $('#btn-save').hide();
                }
            });
        }

        // Form Submission
        $('#GcutiForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                type: 'POST',
                url: "{{ url('store-gcuti') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#gcuti-modal").modal('hide');
                    window.location.reload();
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endsection
