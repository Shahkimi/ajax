@extends('layouts.app')

@section('content')
    <!-- Panel Information -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3>Panel EPPSM</h3>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                @foreach ($panel as $item)
                    <div class="card mx-auto" style="width: 40rem;">
                        <div class="card-body text-end pb-1">
                            <a href="javascript:void(0)" onClick="editFunc({{ $item->id }})"
                            class="btn btn-success">Kemaskini</a>
                        </div>
                        <div class="card-body pt-1">
                            <table class="table table-sm">
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <div class="alert alert-info" role="alert">
                                            <strong>{{ strtoupper($item->jawatan_panel2) }}</strong>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Jawatan Panel</th>
                                    <td>: {{ strtoupper($item->jawatan_panel2) }}</td>
                                </tr>
                                <tr>
                                    <th>Tajuk Panel</th>
                                    <td>: {{ strtoupper($item->tajuk_panel2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <div class="alert alert-info" role="alert">
                                            <strong>Maklumat Pengerusi</strong>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Pengerusi</th>
                                    <td>: {{ strtoupper($item->nama_pengurusi) }}</td>
                                </tr>
                                <tr>
                                    <th>No MPM </th>
                                    <td>: {{ strtoupper($item->mpm_pengurusi) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <div class="alert alert-info" role="alert">
                                            <strong>Maklumat Panel</strong>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Panel 1</th>
                                    <td>: {{ strtoupper($item->nama_panel) }}</td>
                                </tr>
                                <tr>
                                    <th>Panel 2</th>
                                    <td>: {{ strtoupper($item->nama_panel2) }}</td>
                                </tr>
                                <tr>
                                    <th>No MPM Panel 2</th>
                                    <td>: {{ strtoupper($item->mpm_panel2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <div class="alert alert-info" role="alert">
                                            <strong>Maklumat Penyemak</strong>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Penyemak</th>
                                    <td>: {{ strtoupper($item->penyemak) }}</td>
                                </tr>
                                <tr>
                                    <th>Jawatan Penyemak</th>
                                    <td>: {{ strtoupper($item->jawatan_penyemak) }}</td>
                                </tr>
                                <tr style="border: none;">
                                    <td colspan="2" style="text-align:right; font-size: smaller; color: grey; border: none;">
                                        Last updated : {{ $item->created_at->format('Y') }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Of Panel Information -->

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
                        <div class="alert alert-warning mb-3 text-center" role="alert">
                            <strong>Testing</strong>
                        </div>
                        <div class="mb-3">
                            <label for="jawatan_panel2" class="form-label">Jawatan Panel</label>
                            <input type="text" class="form-control" id="jawatan_panel2" name="jawatan_panel2" maxlength="100" required>
                        </div>
                        <div class="mb-3">
                            <label for="tajuk_panel2" class="form-label">Tajuk Panel</label>
                            <input type="text" class="form-control" id="tajuk_panel2" name="tajuk_panel2" maxlength="100" required>
                        </div>
                        <button type="button" class="btn btn-primary next-step float-end btn-sm">Next</button>
                    </div>

                    <!-- Step 2 -->
                    <div class="step step-2 d-none">
                        <div class="alert alert-warning mb-3 text-center" role="alert">
                            <strong>Maklumat Pengerusi</strong>
                        </div>
                        <div class="mb-3">
                            <label for="nama_pengurusi" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama_pengurusi" name="nama_pengurusi" maxlength="100" required>
                        </div>
                        <div class="mb-3">
                            <label for="mpm_pengurusi" class="form-label">No MPM</label>
                            <input type="text" class="form-control" id="mpm_pengurusi" name="mpm_pengurusi" maxlength="100" required>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-secondary prev-step float-end me-2 btn-sm">Previous</button>
                            <button type="button" class="btn btn-primary next-step float-end me-2 btn-sm">Next</button>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="step step-3 d-none">
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
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-secondary prev-step float-end me-2 btn-sm">Previous</button>
                            <button type="button" class="btn btn-primary next-step float-end me-2 btn-sm">Next</button>
                        </div>
                    </div>

                    <!-- Step 4 -->
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
                        <button type="button" class="btn btn-secondary prev-step float-end btn-sm">Previous</button>
                    </div>
                </form>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm" id="btn-save" form="PanelForm">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Tambah/Edit Panel -->

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

        // JavaScript to handle multi-step form navigation
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
