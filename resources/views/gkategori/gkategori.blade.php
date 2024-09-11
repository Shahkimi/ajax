@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Kumpulan kategori</h2>
                    <a class="btn btn-success" onClick="add()" href="javascript:void(0)">Tambah Kategori</a>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="gkategori">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Tarikh Dicipta</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gkategori as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_kategori }}</td>
                                        <td>{{ $item->desc_kategori }}</td>
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
                        {!! $gkategori->links('pagination::bootstrap-5') !!}
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit Kategori -->
    <div class="modal fade" id="gkategori-modal" tabindex="-1" aria-labelledby="gkategoriModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gkategoriModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="GkategoriForm" name="GkategoriForm">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">Kategori</label>
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                                maxlength="50" required>
                        </div>
                        <div class="mb-3">
                            <label for="desc_kategori" class="form-label">Deskripsi</label>
                            <input type="text" class="form-control" id="desc_kategori" name="desc_kategori"
                                maxlength="100" required>
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

        //Add Data gkategori
        function add() {
            $('#GkategoriForm').trigger("reset");
            $('#gkategoriModalLabel').html("Tambah Kategori");
            $('#gkategori-modal').modal('show');
            $('#id').val('');
            $('#nama_kategori').attr('readonly', false);
            $('#desc_kategori').attr('readonly', false);
            $('#btn-save').show();
        }

        //Edit data gkategori
        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('gkategori.edit') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#gkategoriModalLabel').html("Edit Kategori");
                    $('#gkategori-modal').modal('show');
                    $('#id').val(res.id);
                    $('#nama_kategori').val(res.nama_kategori);
                    $('#desc_kategori').val(res.desc_kategori);
                    $('#nama_kategori').attr('readonly', false);
                    $('#desc_kategori').attr('readonly', false);
                    $('#btn-save').show();
                }
            });
        }

        //Delete data gkategori
        function deleteFunc(id) {
            if (confirm("Delete record?")) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('gkategori.destroy') }}",
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

        //View Data gkategori
        function viewFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('gkategori.view') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#gkategoriModalLabel').html("Lihat Kategori");
                    $('#gkategori-modal').modal('show');
                    $('#id').val(res.id);
                    $('#nama_kategori').val(res.nama_kategori);
                    $('#desc_kategori').val(res.desc_kategori);
                    $('#nama_kategori').attr('readonly', true);
                    $('#desc_kategori').attr('readonly', true);
                    $('#btn-save').hide();
                }
            });
        }

        //Save Data gkategori
        $('#GkategoriForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                type: 'POST',
                url: "{{ route('gkategori.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#gkategori-modal").modal('hide');
                    window.location.reload();
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endsection
