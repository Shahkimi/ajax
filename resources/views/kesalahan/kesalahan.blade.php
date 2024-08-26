@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Kesalahan</h2>
                    <a class="btn btn-success" onClick="add()" href="javascript:void(0)">Tambah Kesalahan</a>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="kesalahan">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kod Kesalahan</th>
                                    <th>Deskripsi Kesalahan</th>
                                    <th>Tarikh Dicipta</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kesalahan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->kod_kesalahan }}</td>
                                        <td>{{ $item->desc_kesalahan }}</td>
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
                        {!! $kesalahan->links('pagination::bootstrap-5') !!}
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit Kesalahan -->
    <div class="modal fade" id="kesalahan-modal" tabindex="-1" aria-labelledby="kesalhanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kesalahanModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="KesalahanForm" name="KesalahanForm">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="kod_kesalahan" class="form-label">Kod Kesalahan</label>
                            <input type="text" class="form-control" id="kod_kesalahan" name="kod_kesalahan" maxlength="50"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="desc_Kesalahan" class="form-label">Deskripsi</label>
                            <input type="text" class="form-control" id="desc_kesalahan" name="desc_kesalahan" maxlength="100"
                                required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" form="KesalahanForm">Simpan</button>
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
            $('#KesalahanForm').trigger("reset");
            $('#kesalahanModalLabel').html("Tambah Jenis Kesalahan");
            $('#kesalahan-modal').modal('show');
            $('#id').val('');
            $('#kod_kesalahan').attr('readonly', false);
            $('#desc_desalahan').attr('readonly', false);
            $('#btn-save').show();
        }

        //Edit data
        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ url('edit-kesalahan') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#kesalahanModalLabel').html("Edit Kesalahan");
                    $('#kesalahan-modal').modal('show');
                    $('#id').val(res.id);
                    $('#kod_kesalahan').val(res.kod_kesalahan);
                    $('#desc_kesalahan').val(res.desc_kesalahan);
                    $('#kod_kesalahan').attr('readonly', false);
                    $('#desc_kesalahan').attr('readonly', false);
                    $('#btn-save').show();
                }
            });
        }

        //Delete Data
        function deleteFunc(id) {
            if (confirm("Delete record?")) {
                $.ajax({
                    type: "POST",
                    url: "{{ url('delete-kesalahan') }}",
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
                url: "{{ url('view-kesalahan') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#kesalahanModalLabel').html("Lihat Kesalahan");
                    $('#kesalahan-modal').modal('show');
                    $('#id').val(res.id);
                    $('#kod_kesalahan').val(res.kod_kesalahan\);
                    $('#desc_kesalahan').val(res.desc_kesalahan);
                    $('#kod_kesalahan').attr('readonly', true);
                    $('#desc_kesalahan').attr('readonly', true);
                    $('#btn-save').hide();
                }
            });
        }

        $('#KesalahanForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                type: 'POST',
                url: "{{ url('store-kesalahan') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#kesalahan-modal").modal('hide');
                    window.location.reload();
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endsection
