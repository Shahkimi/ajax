@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="row justify-content-center">
            <div class="col-lg-12"> <!-- Increased the width of the card -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Gred</h2>
                    <a class="btn btn-success" onClick="add()" href="javascript:void(0)">Tambah Gred</a>
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

                        <table class="table table-bordered table-striped" id="gred">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gred</th>
                                    <th>Deskripsi Gred</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody id="gredTableBody">
                                @foreach ($gred as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ strtoupper($item->kod_gred) }}</td>
                                        <td>{{ strtoupper($item->desc_gred) }}</td>
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
                        {!! $gred->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal Tambah/Edit Gred -->
    <div class="modal fade" id="gred-modal" tabindex="-1" aria-labelledby="gredModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gredModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="GredForm" name="GredForm">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="kod_gred" class="form-label">Gred</label>
                            <input type="text" class="form-control" id="kod_gred" name="kod_gred" maxlength="50"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="desc_gred" class="form-label">Deskripsi Gred</label>
                            <input type="text" class="form-control" id="desc_gred" name="desc_gred" maxlength="100"
                                required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" form="GredForm">Simpan</button>
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
                url: '{{ route('gred.search') }}',
                data: {search: searchQuery},
                success: function(response) {
                    let rows = '';
                    response.data.forEach(function(item, index) {
                        rows += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.kod_gred}</td>
                                <td>${item.desc_gred}</td>
                                <td>
                                    <a href="javascript:void(0)" onClick="editFunc(${item.id})"
                                        class="btn btn-success btn-sm">Kemaskini</a>
                                    <a href="javascript:void(0)" onClick="deleteFunc(${item.id})"
                                        class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>`;
                    });
                    $('#gredTableBody').html(rows);
                }
            });
        });

        //Add Data
        function add() {
            $('#GredForm').trigger("reset");
            $('#gredModalLabel').html("Tambah Gred");
            $('#gred-modal').modal('show');
            $('#id').val('');
            $('#kod_gred').attr('readonly', false);
            $('#desc_gred').attr('readonly', false);
            $('#btn-save').show();
        }

        //Edit data
        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('gred.edit') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#gredModalLabel').html("Edit Gred");
                    $('#gred-modal').modal('show');
                    $('#id').val(res.id);
                    $('#kod_gred').val(res.kod_gred);
                    $('#desc_gred').val(res.desc_gred);
                    $('#kod_gred').attr('readonly', false);
                    $('#desc_gred').attr('readonly', false);
                    $('#btn-save').show();
                }
            });
        }

        //Delete Data
        function deleteFunc(id) {
            if (confirm("Delete record?")) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('gred.destroy') }}",
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

        $('#GredForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                type: 'POST',
                url: "{{ route('gred.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#gred-modal").modal('hide');
                    window.location.reload();
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endsection
