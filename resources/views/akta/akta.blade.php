@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Akta</h2>
                    <a class="btn btn-success" onClick="add()" href="javascript:void(0)">Tambah Akta</a>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="akta">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Akta</th>
                                    <th>Deskripsi</th>
                                    <th>Tarikh Dicipta</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($akta as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->kod_akta }}</td>
                                        <td>{{ $item->desc_akta }}</td>
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
                        {!! $akta->links('pagination::bootstrap-5') !!}
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit Akta -->
    <div class="modal fade" id="akta-modal" tabindex="-1" aria-labelledby="aktaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="aktaModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="AktaForm" name="AktaForm">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="kod_akta" class="form-label">Kod Akta</label>
                            <input type="text" class="form-control" id="kod_akta" name="kod_akta" maxlength="10"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="desc_akta" class="form-label">Deskripsi</label>
                            <input type="text" class="form-control" id="desc_akta" name="desc_akta" maxlength="100"
                                required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" form="AktaForm">Simpan</button>
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
            $('#AktaForm').trigger("reset");
            $('#aktaModalLabel').html("Tambah Akta");
            $('#akta-modal').modal('show');
            $('#id').val('');
            $('#akta_akta').attr('readonly', false);
            $('#desc_akta').attr('readonly', false);
            $('#btn-save').show();
        }

        //Edit data
        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('akta.edit') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#aktaModalLabel').html("Edit Akta");
                    $('#akta-modal').modal('show');
                    $('#id').val(res.id);
                    $('#kod_akta').val(res.kod_akta);
                    $('#desc_akta').val(res.desc_akta);
                    $('#kod_akta').attr('readonly', false);
                    $('#desc_akta').attr('readonly', false);
                    $('#btn-save').show();
                }
            });
        }

        //Delete Data
        function deleteFunc(id) {
            if (confirm("Delete record?")) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('akta.destroy') }}",
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
                url: "{{ route('akta.view') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#aktaModalLabel').html("Lihat Akta");
                    $('#akta-modal').modal('show');
                    $('#id').val(res.id);
                    $('#kod_akta').val(res.kod_akta);
                    $('#desc_akta').val(res.desc_akta);
                    $('#kod_akta').attr('readonly', true);
                    $('#desc_akta').attr('readonly', true);
                    $('#btn-save').hide();
                }
            });
        }

        $('#AktaForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                type: 'POST',
                url: "{{ route('akta.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#akta-modal").modal('hide');
                    window.location.reload();
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endsection
