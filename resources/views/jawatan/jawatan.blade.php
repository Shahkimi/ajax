@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="row justify-content-center">
            <div class="col-lg-12"> <!-- Increased the width of the card -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Jawatan</h2>
                    <a class="btn btn-success" onClick="add()" href="javascript:void(0)">Tambah Jawatan</a>
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

                        <table class="table table-bordered table-striped" id="jawatan">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Jawatan</th>
                                    <th>Deskripsi Jawatan</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody id="jawatanTableBody">
                                @foreach ($jawatan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ strtoupper($item->kod_jawatan) }}</td>
                                        <td>{{ strtoupper($item->desc_jawatan) }}</td>
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
                        {!! $jawatan->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal Tambah/Edit Jawatan -->
    <div class="modal fade" id="jawatan-modal" tabindex="-1" aria-labelledby="jawatanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jawatanModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="JawatanForm" name="JawatanForm">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="kod_jawatan" class="form-label">Jawatan</label>
                            <input type="text" class="form-control" id="kod_jawatan" name="kod_jawatan" maxlength="50"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="desc_jawatan" class="form-label">Deskripsi Jawatan</label>
                            <input type="text" class="form-control" id="desc_jawatan" name="desc_jawatan" maxlength="100"
                                required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" form="JawatanForm">Simpan</button>
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
                url: '{{ route('jawatan.search') }}',
                data: {search: searchQuery},
                success: function(response) {
                    let rows = '';
                    response.data.forEach(function(item, index) {
                        rows += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.kod_jawatan}</td>
                                <td>${item.desc_jawatan}</td>
                                <td>
                                    <a href="javascript:void(0)" onClick="editFunc(${item.id})"
                                        class="btn btn-success btn-sm">Kemaskini</a>
                                    <a href="javascript:void(0)" onClick="deleteFunc(${item.id})"
                                        class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>`;
                    });
                    $('#jawatanTableBody').html(rows);
                }
            });
        });

        //Add Data
        function add() {
            $('#JawatanForm').trigger("reset");
            $('#jawatanModalLabel').html("Tambah Jawatan");
            $('#jawatan-modal').modal('show');
            $('#id').val('');
            $('#kod_jawatan').attr('readonly', false);
            $('#desc_jawatan').attr('readonly', false);
            $('#btn-save').show();
        }

        //Edit data
        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('jawatan.edit') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#jawatanModalLabel').html("Edit Jawatan");
                    $('#jawatan-modal').modal('show');
                    $('#id').val(res.id);
                    $('#kod_jawatan').val(res.kod_jawatan);
                    $('#desc_jawatan').val(res.desc_jawatan);
                    $('#kod_jawatan').attr('readonly', false);
                    $('#desc_jawatan').attr('readonly', false);
                    $('#btn-save').show();
                }
            });
        }

        //Delete Data
        function deleteFunc(id) {
            if (confirm("Delete record?")) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('jawatan.destroy') }}",
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

        $('#JawatanForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                type: 'POST',
                url: "{{ route('jawatan.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#jawatan-modal").modal('hide');
                    window.location.reload();
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endsection
