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

    <!--
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
    -->

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

                    <!-- Step 1 -->
                    <div class="step step-1">
                        <div class="mb-3">
                            <label for="jawatan_panel2" class="form-label">Jawatan Panel</label>
                            <input type="text" class="form-control" id="jawatan_panel2" name="jawatan_panel2" maxlength="100" required>
                        </div>
                        <div class="mb-3">
                            <label for="tajuk_panel2" class="form-label">Tajuk Panel</label>
                            <input type="text" class="form-control" id="tajuk_panel2" name="tajuk_panel2" maxlength="100" required>
                        </div>
                        <button type="button" class="btn btn-primary next-step float-end">Next</button>
                    </div>

                    <!-- Step 2 -->
                    <div class="step step-2 d-none">
                        <div class="alert alert-warning mb-3 text-center" role="alert">
                            <strong>Maklumat Pengerusi</strong>
                        </div>
                        <div class="mb-3">
                            <label for="nama_pengurusi" class="form-label">Nama Pengerusi</label>
                            <input type="text" class="form-control" id="nama_pengurusi" name="nama_pengurusi" maxlength="100" required>
                        </div>
                        <div class="mb-3">
                            <label for="mpm_pengurusi" class="form-label">No MPM Pengerusi</label>
                            <input type="text" class="form-control" id="mpm_pengurusi" name="mpm_pengurusi" maxlength="100" required>
                        </div>
                        <div class="alert alert-warning mb-3 text-center" role="alert">
                            <strong>Maklumat Panel Penilai</strong>
                        </div>
                        <div class="mb-3">
                            <label for="nama_panel" class="form-label">Nama Panel</label>
                            <input type="text" class="form-control" id="nama_panel" name="nama_panel" maxlength="100" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_panel2" class="form-label">Nama Panel (2)</label>
                            <input type="text" class="form-control" id="nama_panel2" name="nama_panel2" maxlength="100" required>
                        </div>
                        <div class="mb-3">
                            <label for="mpm_panel2" class="form-label">No MPM Panel (2)</label>
                            <input type="text" class="form-control" id="mpm_panel2" name="mpm_panel2" maxlength="100" required>
                        </div>
                        <button type="button" class="btn btn-primary next-step float-end me-2">Next</button>
                        <button type="button" class="btn btn-secondary prev-step float-end"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
</svg></i>Previous</button>
                    </div>

                    <!-- Step 3 -->
                    <div class="step step-3 d-none">
                        <div class="alert alert-warning mb-3 text-center" role="alert">
                            <strong>Maklumat Penyemak</strong>
                        </div>
                        <div class="mb-3">
                            <label for="penyemak" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="penyemak" name="penyemak" maxlength="100" required>
                        </div>
                        <div class="mb-3">
                            <label for="jawatan_penyemak" class="form-label">Jawatan</label>
                            <input type="text" class="form-control" id="jawatan_penyemak" name="jawatan_penyemak" maxlength="100" required>
                        </div>
                        <button type="button" class="btn btn-secondary prev-step">Previous</button>
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
        function resetSteps() {
        // Hide all steps
        document.querySelectorAll('.step').forEach(step => {
            step.classList.add('d-none');
        });
        // Show the first step
        document.querySelector('.step-1').classList.remove('d-none');
}
        // JavaScript to handle multi-step form navigation
        document.querySelectorAll('.next-step').forEach(button => {
            button.addEventListener('click', () => {
                const currentStep = button.closest('.step');
                const nextStep = currentStep.nextElementSibling;
                currentStep.classList.add('d-none');
                nextStep.classList.remove('d-none');
            });
        });

        document.querySelectorAll('.prev-step').forEach(button => {
            button.addEventListener('click', () => {
                const currentStep = button.closest('.step');
                const prevStep = currentStep.previousElementSibling;
                currentStep.classList.add('d-none');
                prevStep.classList.remove('d-none');
            });
        });

        //AJAX Setup
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
                    resetSteps(); // Reset to the first step
                    $('#panelModalLabel').html("Kemaskini Panel");
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
                    $('#btn-save').show();
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
                    resetSteps(); // Reset to the first step
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
