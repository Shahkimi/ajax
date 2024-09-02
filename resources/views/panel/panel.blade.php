@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Panel EPPSM</h2>
                    <a class="btn btn-success" onClick="add()" href="javascript:void(0)">Tambah Panel</a>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="panel">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Pengerusi</th>
                                    <th>No MPM Pengerusi</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($panel as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_pengurusi }}</td>
                                        <td>{{ $item->mpm_pengurusi }}</td>
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
                        {!! $panel->links('pagination::bootstrap-5') !!}
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Panel EPPSM</h2>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        @foreach ($panel as $item)
                            <div class="card ">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->nama_pengurusi }}</h5>
                                    <p class="card-text">
                                        Nama Pengerusi: {{ $item->nama_pengurusi }}<br>
                                        No MPM Pengerusi: {{ $item->mpm_pengurusi }}<br>
                                        Nama Panel: {{ $item->nama_panel }}<br>
                                        Nama Panel 2: {{ $item->nama_panel2 }}<br>
                                        No MPM Panel 2: {{ $item->mpm_panel2 }}<br>
                                        Jawatan Panel 2: {{ $item->jawatan_panel2 }}<br>
                                        Tajuk Panel 2: {{ $item->tajuk_panel2 }}<br>
                                        Penyemak: {{ $item->penyemak }}<br>
                                        Jawatan Penyemak: {{ $item->jawatan_penyemak }}
                                    </p>
                                    <a href="javascript:void(0)" onClick="editFunc({{ $item->id }})"
                                        class="btn btn-success btn-sm">Kemaskini</a>
                                </div>
                            </div>
                        @endforeach
                        {{-- <div class="d-flex justify-content-center"> --}}
                        {!! $panel->links('pagination::bootstrap-5') !!}
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit Panel -->
    <div class="modal fade" id="panel-modal" tabindex="-1" aria-labelledby="panelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="panelModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="PanelForm" name="PanelForm">
                        <input type="hidden" name="id" id="id">
                        <div class="side">
                            <div class="mb-3">
                                <label for="nama_pengurusi" class="form-label">Nama Pengerusi</label>
                                <input type="text" class="form-control" id="nama_pengurusi" name="nama_pengurusi" maxlength="30"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="mpm_pengurusi" class="form-label">No MPM Pengerusi</label>
                                <input type="text" class="form-control" id="mpm_pengurusi" name="mpm_pengurusi" maxlength="5"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="nama_panel" class="form-label">Nama Panel</label>
                                <input type="text" class="form-control" id="nama_panel" name="nama_panel" maxlength="50"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="nama_panel2" class="form-label">Nama Panel 2</label>
                                <input type="text" class="form-control" id="nama_panel2" name="nama_panel2" maxlength="100"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="mpm_panel2" class="form-label">No MPM Panel 2</label>
                                <input type="text" class="form-control" id="mpm_panel2" name="mpm_panel2" maxlength="50"
                                    required>
                            </div>
                        </div>
                        <div class="side">
                            <div class="mb-3">
                                <label for="jawatan_panel2" class="form-label">Jawatan Panel 2</label>
                                <input type="text" class="form-control" id="jawatan_panel2" name="jawatan_panel2" maxlength="100"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="tajuk_panel2" class="form-label">Tajuk Panel 2</label>
                                <input type="text" class="form-control" id="tajuk_panel2" name="tajuk_panel2" maxlength="50"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="penyemak" class="form-label">Nama Penyemak</label>
                                <input type="text" class="form-control" id="penyemak" name="penyemak" maxlength="100"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="jawatan_penyemak" class="form-label">Jawatan Penyemak</label>
                                <input type="text" class="form-control" id="jawatan_penyemak" name="jawatan_penyemak" maxlength="100"
                                    required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" form="PanelForm">Simpan</button>
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
            $('#PanelForm').trigger("reset");
            $('#panelModalLabel').html("Tambah Panel");
            $('#panel-modal').modal('show');
            $('#id').val('');
            $('#nama_pengurusi').attr('readonly', false);
            $('#mpm_pengurusi').attr('readonly', false);
            $('#nama_panel').attr('readonly', false);
            $('#nama_panel2').attr('readonly', false);
            $('#mpm_panel2').attr('readonly', false);
            $('#jawatan_panel2').attr('readonly', false);
            $('#tajuk_panel2').attr('readonly', false);
            $('#penyemak').attr('readonly', false);
            $('#jawatan_penyemak').attr('readonly', false);
            $('#btn-save').show();
        }

        //Edit data
        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('panel.edit') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#panelModalLabel').html("Edit Panel");
                    $('#panel-modal').modal('show');
                    $('#id').val(res.id);
                    $('#nama_pengurusi').val(res.nama_pengurusi);
                    $('#mpm_pengurusi').val(res.mpm_pengurusi);
                    $('#nama_panel').val(res.nama_panel);
                    $('#nama_panel2').val(res.nama_panel2);
                    $('#mpm_panel2').val(res.mpm_panel2);
                    $('#jawatan_panel2').val(res.jawatan_panel2);
                    $('#tajuk_panel2').val(res.tajuk_panel2);
                    $('#penyemak').val(res.penyemak);
                    $('#jawatan_penyemak').val(res.jawatan_penyemak);
                    //For readonly section
                    $('#nama_pengurusi').attr('readonly', false);
                    $('#mpm_pengurusi').attr('readonly', false);
                    $('#nama_panel').attr('readonly', false);
                    $('#nama_panel2').attr('readonly', false);
                    $('#mpm_panel2').attr('readonly', false);
                    $('#jawatan_panel2').attr('readonly', false);
                    $('#tajuk_panel2').attr('readonly', false);
                    $('#penyemak').attr('readonly', false);
                    $('#jawatan_penyemak').attr('readonly', false);
                    $('#btn-save').hide();
                }
            });
        }

        //Delete Data
        function deleteFunc(id) {
            if (confirm("Delete record?")) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('panel.destroy') }}",
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
                url: "{{ route('panel.view') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#panelModalLabel').html("Lihat Panel");
                    $('#panel-modal').modal('show');
                    $('#id').val(res.id);
                    $('#nama_pengurusi').val(res.nama_pengurusi);
                    $('#mpm_pengurusi').val(res.mpm_pengurusi);
                    $('#nama_panel').val(res.nama_panel);
                    $('#nama_panel2').val(res.nama_panel2);
                    $('#mpm_panel2').val(res.mpm_panel2);
                    $('#jawatan_panel2').val(res.jawatan_panel2);
                    $('#tajuk_panel2').val(res.tajuk_panel2);
                    $('#penyemak').val(res.penyemak);
                    $('#jawatan_penyemak').val(res.jawatan_penyemak);
                    //For read only section
                    $('#nama_pengurusi').attr('readonly', true);
                    $('#mpm_pengurusi').attr('readonly', true);
                    $('#nama_panel').attr('readonly', true);
                    $('#nama_panel2').attr('readonly', true);
                    $('#mpm_panel2').attr('readonly', true);
                    $('#jawatan_panel2').attr('readonly', true);
                    $('#tajuk_panel2').attr('readonly', true);
                    $('#penyemak').attr('readonly', true);
                    $('#jawatan_penyemak').attr('readonly', true);
                    $('#btn-save').hide();
                }
            });
        }

        $('#PanelForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                type: 'POST',
                url: "{{ route('panel.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#panel-modal").modal('hide');
                    window.location.reload();
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endsection
