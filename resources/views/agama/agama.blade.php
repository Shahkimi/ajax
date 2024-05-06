@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Agama</h2>
                    <a class="btn btn-success" onClick="add()" href="javascript:void(0)">Tambah Agama</a>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="agama">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Agama</th>
                                    <th>Deskripsi</th>
                                    <th>Tarikh Dicipta</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agama as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_agama }}</td>
                                        <td>{{ $item->desc_agama }}</td>
                                        <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                                        <td>
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
                            {!! $agama->links('pagination::bootstrap-5') !!}
                        {{-- </div> --}}
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
                        </div>
                        <div class="mb-3">
                            <label for="desc_agama" class="form-label">Deskripsi</label>
                            <input type="text" class="form-control" id="desc_agama" name="desc_agama" maxlength="100"
                                required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" form="AgamaForm">Simpan</button>
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
        }

        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ url('edit-agama') }}",
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
                    $('#desc_agama').val(res.desc_agama);
                }
            });
        }

        function deleteFunc(id) {
            if (confirm("Delete record?")) {
                $.ajax({
                    type: "POST",
                    url: "{{ url('delete-agama') }}",
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
                url: "{{ url('store-agama') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#agama-modal").modal('hide');
                    window.location.reload();
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endsection
