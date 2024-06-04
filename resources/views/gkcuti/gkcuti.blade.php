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
                        <table class="table table-bordered table-striped" id="gkcuti">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kategori Cuti</th>
                                    <th>Tarikh Dicipta</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gkcuti as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->kategori_cuti }}</td>
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
                        {!! $gkcuti->links('pagination::bootstrap-5') !!}
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit Kategori -->
    <div class="modal fade" id="gkcuti-modal" tabindex="-1" aria-labelledby="gkcutiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gkcutiModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="GkcutiForm" name="GkcutiForm">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="kategori_cuti" class="form-label">Kategori Cuti</label>
                            <input type="text" class="form-control" id="kategori_cuti" name="kategori_cuti"
                                maxlength="50" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" form="GkategoriForm">Simpan</button>
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
            $('#GkcutiForm').trigger("reset");
            $('#gkcutiModalLabel').html("Tambah Kategori Cuti");
            $('#gkcuti-modal').modal('show');
            $('#id').val('');
            $('#kategori_cuti').attr('readonly', false);
            $('#btn-save').show();
        }

        //Edit data
        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ url('edit-gkcuti') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#gkcutiModalLabel').html("Edit Kategori");
                    $('#gkcuti-modal').modal('show');
                    $('#id').val(res.id);
                    $('#kategori_cuti').val(res.kategori_cuti);
                    $('#kategori_cuti').attr('readonly', false);
                    $('#btn-save').show();
                }
            });
        }

        //Delete Data
        function deleteFunc(id) {
            if (confirm("Delete record?")) {
                $.ajax({
                    type: "POST",
                    url: "{{ url('delete-gkcuti') }}",
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
                url: "{{ url('view-gkcuti') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#gkcutiModalLabel').html("Lihat Kategori");
                    $('#gkcuti-modal').modal('show');
                    $('#id').val(res.id);
                    $('#kategori_cuti').val(res.kategori_cuti);
                    $('#kategori_cuti').attr('readonly', true);
                    $('#btn-save').hide();
                }
            });
        }

        $('#GkcutiForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                type: 'POST',
                url: "{{ url('store-gkcuti') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#gkcuti-modal").modal('hide');
                    window.location.reload();
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endsection
