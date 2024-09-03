@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Gred</h2>
                    <a class="btn btn-success" onClick="add()" href="javascript:void(0)">Tambah Gred</a>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <!-- Search Input -->
                <div class="mb-3">
                    <input type="text" id="search" class="form-control" placeholder="Cari Gred">
                </div>

                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="gred">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Gred</th>
                                    <th>Deskripsi Gred</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody id="gred-data">
                                @include('gred.Partials.gred_data', ['gred' => $gred])
                            </tbody>
                        </table>
                        {!! $gred->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
                        <label for="kod_gred" class="form-label">Kod Gred</label>
                        <input type="text" class="form-control" id="kod_gred" name="kod_gred" maxlength="10" required>
                    </div>
                    <div class="mb-3">
                        <label for="desc_gred" class="form-label">Deskripsi Gred</label>
                        <input type="text" class="form-control" id="desc_gred" name="desc_gred" maxlength="100" required>
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

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            function fetchGred(query = '') {
                $.ajax({
                    url: "{{ route('gred.index') }}",
                    type: "GET",
                    data: { 'search': query },
                    success: function(data) {
                        $('#gred-data').html(data);
                    }
                });
            }

            // Initially load data
            fetchGred();

            // Live search
            $('#search').on('keyup', function() {
                let query = $(this).val();
                fetchGred(query);
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Define the add function
        function add() {
            $('#GredForm').trigger("reset");
            $('#gredModalLabel').html("Tambah Gred");
            $('#gred-modal').modal('show');
            $('#id').val('');
            $('#kod_gred').attr('readonly', false);
            $('#desc_gred').attr('readonly', false);
            $('#btn-save').show();
        }

        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('gred.edit') }}",
                data: { id: id, _token: '{{ csrf_token() }}' },
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

        function deleteFunc(id) {
            if (confirm("Delete record?")) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('gred.destroy') }}",
                    data: { id: id, _token: '{{ csrf_token() }}' },
                    dataType: 'json',
                    success: function(res) {
                        window.location.reload();
                    }
                });
            }
        }

        function viewFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('gred.view') }}",
                data: { id: id, _token: '{{ csrf_token() }}' },
                dataType: 'json',
                success: function(res) {
                    $('#gredModalLabel').html("Lihat Gred");
                    $('#gred-modal').modal('show');
                    $('#id').val(res.id);
                    $('#kod_gred').val(res.kod_gred);
                    $('#desc_gred').val(res.desc_gred);
                    $('#kod_gred').attr('readonly', true);
                    $('#desc_gred').attr('readonly', true);
                    $('#btn-save').hide();
                }
            });
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

