@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto"> <!-- Center the card in the middle of the page -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>PTJ</h2>
                    <a class="btn btn-success" onClick="add()" href="javascript:void(0)">Tambah PTJ</a>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">Multi-step Form</div>
                    <div class="card-body">
                        <div class="container mt-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h3>Senarai PTJ</h3>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#step1Modal">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah PTJ
                                        </button>
                                    </div>
                                    <form id="searchForm" method="POST" class="d-flex justify-content-center">
                                        @csrf
                                        <div class="input-group w-50 mb-4">
                                            <input class="form-control" id="search" name="search"
                                                placeholder="Carian...">
                                            <button type="submit" class="btn btn-primary"> <i
                                                    class="fas fa-search"></i></button>
                                        </div>
                                    </form>

                        <table class="table table-bordered table-striped" id="ptj">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NO PTJ</th>
                                    <th>Nama PTJ</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody id="ptjTableBody">
                                @foreach ($ptj as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ strtoupper($item->kod_ptj) }}</td>
                                        <td>{{ strtoupper($item->desc_ptj) }}</td>
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
                        {!! $ptj->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Form Show all data End -->




    <!-- Modal Tambah/Edit PTJ -->
    <div class="modal fade" id="ptj-modal" tabindex="-1" aria-labelledby="ptjModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ptjModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="PtjForm" name="PtjForm">
                        <input type="hidden" name="id" id="id">
                        <div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="kod_ptj" class="form-label">No Ptj</label>
                                    <input type="text" class="form-control" id="kod_ptj" name="kod_ptj" maxlength="50"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="desc_ptj" class="form-label">Nama Ptj</label>
                                    <input type="text" class="form-control" id="desc_ptj" name="desc_ptj"
                                        maxlength="100" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary prev-step"
                            data-bs-target="#step2Modal">Previous</button>
                        <button type="submit" class="btn btn-success">Finish</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Form Modal End -->

    <!-- View PTJ Modal -->
    <div class="modal fade" id="viewPtjModal" tabindex="-1" aria-labelledby="viewPtjModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewPtjModalLabel">Maklumat PTJ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <dl class="row">
                        <dt class="col-sm-3">Kod PTJ</dt>
                        <dd class="col-sm-9">
                            <input class="form-control" type="text" id="viewKodPtj" aria-label="Kod PTJ" disabled
                                readonly>
                        </dd>

                        <dt class="col-sm-3">Nama PTJ</dt>
                        <dd class="col-sm-9">
                            <input class="form-control" type="text" id="viewNamaPtj" aria-label="Nama PTJ" disabled
                                readonly>
                        </dd>

                        <dt class="col-sm-3">Pengarah</dt>
                        <dd class="col-sm-9">
                            <textarea class="form-control" id="viewPengarah" rows="2" aria-label="Pengarah" disabled readonly
                                style="resize: none;"></textarea>
                        </dd>

                        <dt class="col-sm-3">Alamat</dt>
                        <dd class="col-sm-9">
                            <textarea class="form-control" id="viewAlamat" rows="5" aria-label="Alamat" disabled readonly
                                style="resize: none;"></textarea>
                        </dd>
                    </dl>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- View PTJ Modal End -->

    <!-- Edit PTJ Modal -->
    <div class="modal fade" id="editPtjModal" tabindex="-1" aria-labelledby="editPtjModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPtjModalLabel">Edit Maklumat PTJ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editPtjForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_ptj_id" name="ptj_id">
                        <div class="mb-3">
                            <label for="edit_kod_ptj" class="form-label">Kod PTJ</label>
                            <input type="text" class="form-control" id="edit_kod_ptj" name="kod_ptj" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_nama_ptj" class="form-label">Nama PTJ</label>
                            <input type="text" class="form-control" id="edit_nama_ptj" name="nama_ptj" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_pengarah" class="form-label">Pengarah</label>
                            <input type="text" class="form-control" id="edit_pengarah" name="pengarah" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="edit_alamat" name="alamat" rows="3" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="updatePtjBtn">Kemaskini Maklumat</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit PTJ Modal End -->
@endsection

@push('scripts')
    <script>
        // Multi-step form and save data
        document.addEventListener('DOMContentLoaded', function() {
            var modals = [
                new bootstrap.Modal(document.getElementById('step1Modal')),
                new bootstrap.Modal(document.getElementById('step2Modal')),
                new bootstrap.Modal(document.getElementById('step3Modal'))
            ];

            document.querySelectorAll('.next-step, .prev-step').forEach(function(button) {
                button.addEventListener('click', function() {
                    var currentModal = bootstrap.Modal.getInstance(this.closest('.modal'));
                    var targetModalId = this.getAttribute('data-bs-target');
                    var targetModal = bootstrap.Modal.getInstance(document.querySelector(targetModalId));

                    currentModal.hide();
                    targetModal.show();
                });
            });

            var unitContainer = document.getElementById('unitContainer');
            var addUnitBtn = document.getElementById('addUnit');

            addUnitBtn.addEventListener('click', function() {
                var newUnit = document.createElement('div');
                newUnit.className = 'unit-entry mb-3';
                newUnit.innerHTML = `
                    <div class="row align-items-center">
                        <div class="col-10">
                            <input type="text" name="units[]" class="form-control" placeholder="Enter unit name" required>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-danger btn-sm remove-unit">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
                unitContainer.appendChild(newUnit);
            });

            unitContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-unit') || e.target.closest('.remove-unit')) {
                    e.target.closest('.unit-entry').remove();
                }
            });

            document.getElementById('multiStepForm').addEventListener('submit', function(e) {
                e.preventDefault();
                fetch(this.action, {
                        method: 'POST',
                        body: new FormData(this),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        modals[2].hide();
                        Swal.fire({
                            title: 'Success!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred. Please try again.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
            });

            document.querySelector('[data-bs-toggle="modal"][data-bs-target="#step1Modal"]').addEventListener('click', function() {
                modals[0].show();
            });
        });

        // PTJ View
        function viewFunc(id) {
            console.log('Viewing PTJ with id:', id);
            if (id === undefined || id === null) {
                console.error('Invalid PTJ id');
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred: Invalid PTJ id',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            }

            fetch(`/ptj/${id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Network response was not ok: ${response.status} ${response.statusText}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Parsed data:', data);

                    // Populate basic PTJ info
                    document.getElementById('viewNamaPtj').value = data.nama_ptj || 'N/A';
                    document.getElementById('viewKodPtj').value = data.kod_ptj || 'N/A';
                    document.getElementById('viewPengarah').value = data.pengarah || 'N/A';
                    document.getElementById('viewAlamat').value = data.alamat || 'N/A';

                    let viewPtjModal = new bootstrap.Modal(document.getElementById('viewPtjModal'));
                    viewPtjModal.show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while fetching the data. Check the console for more details.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        }

        // PTJ Delete
        function deleteFunc(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this! All related Bahagian and Unit records will also be deleted.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/ptj/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                        })
                        .then(response => {
                            if (response.status === 419) {
                                throw new Error('Your session has expired. Please refresh the page and try again.');
                            }
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            Swal.fire(
                                'Deleted!',
                                data.message,
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire(
                                'Error!',
                                error.message || 'An error occurred while deleting the PTJ.',
                                'error'
                            );
                        });
                }
            });
        }

        function bahagianFunc(id) {
            window.location.href = `/ptj/${id}/bahagian`;
        }

        // PTJ Edit
        function editFunc(id) {
            fetch(`/ptj/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_ptj_id').value = data.id;
                    document.getElementById('edit_nama_ptj').value = data.nama_ptj;
                    document.getElementById('edit_kod_ptj').value = data.kod_ptj;
                    document.getElementById('edit_alamat').value = data.alamat;
                    document.getElementById('edit_pengarah').value = data.pengarah;

                    let editPtjModal = new bootstrap.Modal(document.getElementById('editPtjModal'));
                    editPtjModal.show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while fetching the PTJ data.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        }

        // PTJ Update
        document.getElementById('updatePtjBtn').addEventListener('click', function() {
            let form = document.getElementById('editPtjForm');
            let formData = new FormData(form);
            let ptjId = document.getElementById('edit_ptj_id').value;

            // Convert FormData to a plain object
            let plainFormData = Object.fromEntries(formData.entries());

            fetch(`/ptj/${ptjId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(plainFormData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.errors) {
                        console.log('Validation errors:', data.errors);
                        let errorMessage = 'Validation errors:\n';
                        for (let field in data.errors) {
                            errorMessage += `${field}: ${data.errors[field].join(', ')}\n`;
                        }
                        Swal.fire({
                            title: 'Validation Error!',
                            text: errorMessage,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        let editPtjModal = bootstrap.Modal.getInstance(document.getElementById('editPtjModal'));
                        editPtjModal.hide();
                        Swal.fire({
                            title: 'Success!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while updating the PTJ.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        });

        //PTJ Search
        $('#searchForm').on('submit', function(e) {
            e.preventDefault();

            let searchQuery = $('#search').val();
            console.log('Search query:', searchQuery);

            $.ajax({
                type: 'POST',
                url: '{{ route('ptj.search') }}',
                data: {
                    search: searchQuery
                },
                success: function(response) {
                    let rows = '';
                    response.data.forEach(function(item, index) {
                        rows += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.kod_ptj}</td>
                                <td>${item.desc_ptj}</td>
                                <td>
                                    <a href="javascript:void(0)" onClick="editFunc(${item.id})"
                                        class="btn btn-success btn-sm">Kemaskini</a>
                                    <a href="javascript:void(0)" onClick="deleteFunc(${item.id})"
                                        class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>`;
                    });
                    $('#ptjTableBody').html(rows);
                }
            });
        });

        //Add Data
        function add() {
            $('#PtjForm').trigger("reset");
            $('#ptjModalLabel').html("Tambah Ptj");
            $('#ptj-modal').modal('show');
            $('#id').val('');
            $('#kod_ptj').attr('readonly', false);
            $('#desc_ptj').attr('readonly', false);
            $('#ketua_ptj').attr('readonly', false);
            $('#alamat_ptj').attr('readonly', false);
            $('#btn-save').show();
        }

        //Edit data
        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('ptj.edit') }}",
                data: {
                    search: searchQuery
                },
                success: function(response) {
                    console.log('Search response:', response);
                    if (response.data && response.data.length > 0) {
                        let rows = '';
                        response.data.forEach(function(item, index) {
                            rows += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.kod_ptj}</td>
                            <td>${item.nama_ptj}</td>
                            <td>${item.pengarah}</td>
                            <td style="text-align: center; vertical-align: middle;">
                                <a href="javascript:void(0)"
                                    onClick="viewFunc(${item.id})"
                                    class="btn btn-primary btn-sm d-inline-block">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                                <a href="javascript:void(0)"
                                    onClick="editFunc(${item.id})"
                                    class="btn btn-success btn-sm d-inline-block">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                                <a href="javascript:void(0)"
                                    onClick="bahagianFunc(${item.id})"
                                    class="btn btn-info btn-sm d-inline-block">
                                    <i class="fa fa-building" aria-hidden="true"></i>
                                </a>
                                <a href="javascript:void(0)"
                                    onClick="deleteFunc(${item.id})"
                                    class="btn btn-danger btn-sm d-inline-block">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>`;
                        });
                        $('#ptjTableBody').html(rows);
                    } else {
                        $('#ptjTableBody').html('<tr><td colspan="5">No results found</td></tr>');
                    }
                });
            }
        }

        function viewFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('ptj.view') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#ptjModalLabel').html("Maklumat Ptj");
                    $('#ptj-modal').modal('show');
                    $('#id').val(res.id);
                    $('#kod_ptj').val(res.kod_ptj);
                    $('#desc_ptj').val(res.desc_ptj);
                    $('#ketua_ptj').val(res.ketua_ptj);
                    $('#alamat_ptj').val(res.alamat_ptj);
                    $('#kod_ptj').attr('readonly', false);
                    $('#desc_ptj').attr('readonly', false);
                    $('#ketua_ptj').attr('readonly', false);
                    $('#alamat_ptj').attr('readonly', false);
                    $('#btn-save').hide();
                    clearErrors();
                }
            });
        }

        $('#PtjForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                type: 'POST',
                url: "{{ route('ptj.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#ptj-modal").modal('hide');
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    console.error('Search error:', error);
                    console.log('XHR:', xhr);
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while searching. Please check the console for more details.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    </script>
@endpush
