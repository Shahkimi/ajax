@extends('layouts.app')

@section('content')
    <div class="container mt-2">

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Agama</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" onClick="add()" href="javascript:void(0)">Tambah Agama</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="card-body">
            <table class="table table-bordered" id="agama">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Agama</th>
                        <th>Decription</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- boostrap agama model -->
    <div class="modal fade" id="agama-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="AgamaModal"></h4>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="AgamaForm" name="AgamaForm" class="form-horizontal"
                        method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="nama_Agama" class="col-sm-2 control-label">Nama Agama</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nama_Agama" name="nama_Agama"
                                    placeholder="Nama Agama" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="desc_Agama" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="desc_Agama" name="desc_Agama"
                                    placeholder="Description Agama" maxlength="10" required="">
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="btn-save">Save changes
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- end bootstrap model -->

    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#agama').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('agama') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama_Agama',
                        name: 'nama_Agama'
                    },
                    {
                        data: 'desc_Agama',
                        name: 'desc_Agama'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },
                ],
                order: [
                    [0, 'desc']
                ]
            });
        });

        function add() {
            $('#AgamaForm').trigger("reset");
            $('#AgamaModal').html("Tambah Agama");
            $('#agama-modal').modal('show');
            $('#id').val('');
        }

        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ url('edit-agama') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#AgamaModal').html("Edit agama");
                    $('#agama-modal').modal('show');
                    $('#id').val(res.id);
                    $('#nama_Agama').val(res.nama_Agama);
                    $('#desc_Agama').val(res.desc_Agama);
                }
            });
        }

        function deleteFunc(id) {
            if (confirm("Delete record?") == true) {
                var id = id;
                // ajax
                $.ajax({
                    type: "POST",
                    url: "{{ url('delete-agama') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        var oTable = $('#agama').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
        }
        $('#AgamaForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ url('store-agama') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $("#agama-modal").modal('hide');
                    var oTable = $('#agama').dataTable();
                    oTable.fnDraw(false);
                    $("#btn-save").html('Submit');
                    $("#btn-save").attr("disabled", false);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endsection
