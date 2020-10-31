@extends('layouts.master')


@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <div class="box">

        <div class="box-header">
            <h3 class="box-title">Data Materials</h3>

            <a onclick="addForm()" class="btn btn-primary pull-right" style="margin-top: -8px;">Add Materials</a>
        </div>


        <!-- /.box-header -->
        <div class="box-body">
        <div class="table-responsive">
            <table id="materials-table" class="table table-striped">
           
                   
                <thead>
                <tr>
                    <th>Category</th>
                    <th>Nama Material</th>
                    <th>Satuan</th>
                    <th>Tanggal</th>
                    <th>No. SPB</th>
                    <th>Pabrikan</th>
                    <th>PRK</th>
                    <th>Jenis Material</th>
                    <th>Total Material Datang</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        </div>
        <!-- /.box-body -->
    </div>

    @include('materials.form')

@endsection

@section('bot')

    <!-- DataTables -->
    <script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>

    {{-- Validator --}}
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>

    {{--<script>--}}
    {{--$(function () {--}}
    {{--$('#items-table').DataTable()--}}
    {{--$('#example2').DataTable({--}}
    {{--'paging'      : true,--}}
    {{--'lengthChange': false,--}}
    {{--'searching'   : false,--}}
    {{--'ordering'    : true,--}}
    {{--'info'        : true,--}}
    {{--'autoWidth'   : false--}}
    {{--})--}}
    {{--})--}}
    {{--</script>--}}

    <script type="text/javascript">
        var table = $('#materials-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('api.materials') }}",
            columns: [
               // {data: 'id', name: 'id'},
                {data: 'category_name', name: 'category_name'},
                {data: 'nama_material', name: 'nama_material'},
                {data: 'satuan', name: 'satuan'},
                {data: 'tanggal', name: 'tanggal'},
                {data: 'no_spb', name: 'no_spb'},
                {data: 'pabrikan', name: 'pabrikan'},
                {data: 'prk', name: 'prk'},
                {data: 'jenis_material', name: 'jenis_material'},
                {data: 'total_mat_datang', name: 'total_mat_datang'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Add Materials');
        }

        function editForm(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "{{ url('materials') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Materials');

                    $('#id').val(data.id);
                    $('#category_id').val(data.category_id);
                    $('#nama_material').val(data.nama_material);
                    $('#satuan').val(data.satuan);
                    $('#tanggal').val(data.tanggal);
                    $('#volume_per_bulan').val(data.volume_per_bulan);
                    $('#harga_satuan').val(data.harga_satuan);
                    $('#transportasi_dan_asuransi').val(data.transportasi_dan_asuransi);
                    $('#no_spb').val(data.no_spb);
                    $('#pabrikan').val(data.pabrikan);
                    $('#prk').val(data.prk);
                    $('#jenis_material').val(data.jenis_material);
                    $('#total_vol_material').val(data.total_vol_material);
                    $('#total_mat_datang').val(data.total_mat_datang);
                          
                },
                error : function() {
                    alert("Nothing Data");
                }
            });
        }

        function deleteData(id){
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                $.ajax({
                    url : "{{ url('materials') }}" + '/' + id,
                    type : "POST",
                    data : {'_method' : 'DELETE', '_token' : csrf_token},
                    success : function(data) {
                        table.ajax.reload();
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '1500'
                        })
                    },
                    error : function () {
                        swal({
                            title: 'Oops...',
                            text: data.message,
                            type: 'error',
                            timer: '1500'
                        })
                    }
                });
            });
        }

        $(function(){
            $('#modal-form form').validator().on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    var id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('materials') }}";
                    else url = "{{ url('materials') . '/' }}" + id;

                    $.ajax({
                        url : url,
                        type : "POST",
                        //hanya untuk input data tanpa dokumen
//                      data : $('#modal-form form').serialize(),
                        data: new FormData($("#modal-form form")[0]),
                        contentType: false,
                        processData: false,
                        success : function(data) {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                            swal({
                                title: 'Success!',
                                text: data.message,
                                type: 'success',
                                timer: '1500'
                            })
                        },
                        error : function(data){
                            swal({
                                title: 'Oops...',
                                text: data.message,
                                type: 'error',
                                timer: '1500'
                            })
                        }
                    });
                    return false;
                }
            });
        });
    </script>

@endsection
