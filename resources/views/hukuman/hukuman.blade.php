@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Hukuman</h2>
                    <a class="btn btn-success" onClick="add()" href="javascript:void(0)">Tambah Hukuman</a>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="hukuman">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Hukuman</th>
                                    <th>Deskripsi</th>
                                    <th>Tarikh Dicipta</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hukuman as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->kod_hukuman }}</td>
                                        <td>{{ $item->desc_hukuman }}</td>
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
                        {!! $hukuman->links('pagination::bootstrap-5') !!}
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit Hukuman -->
    <div class="modal fade" id="hukuman-modal" tabindex="-1" aria-labelledby="hukumanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hukumanModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="HukumanForm" name="HukumanForm">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="kod_hukuman" class="form-label">Kod Hukuman</label>
                            <input type="text" class="form-control" id="kod_hukuman" name="kod_hukuman" maxlength="10"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="desc_hukuman" class="form-label">Deskripsi</label>
                            <input type="text" class="form-control" id="desc_hukuman" name="desc_hukuman" maxlength="100"
                                required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" form="HukumanForm">Simpan</button>
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
            $('#HukumanForm').trigger("reset");
            $('#hukumanModalLabel').html("Tambah Hukuman");
            $('#hukuman-modal').modal('show');
            $('#id').val('');
            $('#kod_hukuman').attr('readonly', false);
            $('#desc_hukuman').attr('readonly', false);
            $('#btn-save').show();
        }

        //Edit data
        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('hukuman.edit') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#hukumanModalLabel').html("Edit Hukuman");
                    $('#hukuman-modal').modal('show');
                    $('#id').val(res.id);
                    $('#kod_hukuman').val(res.kod_hukuman);
                    $('#desc_hukuman').val(res.desc_hukuman);
                    $('#kod_hukuman').attr('readonly', false);
                    $('#desc_hukuman').attr('readonly', false);
                    $('#btn-save').show();
                }
            });
        }

        //Delete Data
        function deleteFunc(id) {
            if (confirm("Delete record?")) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('hukuman.destroy') }}",
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
                url: "{{ route('hukuman.view') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#hukumanModalLabel').html("Lihat Hukumuan");
                    $('#hukuman-modal').modal('show');
                    $('#id').val(res.id);
                    $('#kod_hukuman').val(res.kod_hukuman);
                    $('#desc_hukuman').val(res.desc_hukuman);
                    $('#kod_hukuman').attr('readonly', true);
                    $('#desc_hukuman').attr('readonly', true);
                    $('#btn-save').hide();
                }
            });
        }

        $('#HukumanForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                type: 'POST',
                url: "{{ route('hukuman.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#hukuman-modal").modal('hide');
                    window.location.reload();
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endsection
