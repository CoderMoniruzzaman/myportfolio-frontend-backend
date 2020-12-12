@extends('backend.layouts.master')
@section('title')
Category
@endsection

@section('style')
<style>
    .pointer {
        cursor:pointer;
     }
</style>
@endsection


@section('breadcum')
<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{url('#')}}">Dashboard</a></li>
                    <li><span>category</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- page title area end -->
@endsection


@section('content')
<div class="container-fuild" id="role-index">
    <div class="row justify-content-center">
       <!-- data table start -->
       <div class="col-lg-12 role">
            <div class="card">
                <div class="card-header">
                    <div class="button">
                        <button class="button-one" name="create_record" id="create_record" data-toggle="modal"><i class="ti-plus mr-2"></i>Create new one</button>
                        <!-- modal -part start -->
                        <div class="modal fade" id="formModal" role="dialog">
                            <div class="modal-dialog modal-dialog-centered"  role="document">
                                <div class="modal-content">
                                    {{-- <div class="alert alert-danger" style="display:none"></div> --}}
                                    <div class="modal-header">
                                        <h5 class="modal-title">Create Category</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <!--Sub-Category insert form -->
                                        <form class="row" id="category_form" enctype="multipart/form-data" role="form">
                                            @csrf
                                             <!-- form erors -->
                                            <div class="col-lg-12">
                                                <span id="form_result"></span>
                                            </div>
                                            <!--Sub-Category form item -->
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Category Name</label>
                                                    <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Enter Category Name" required>
                                                </div>
                                            </div>
                                            <!--Sub-Category form button -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="hidden" name="action" id="action" value="submit">
                                                    <input type="submit" class="button-one" value="submit">
                                                </div>
                                            </div>
                                        </form>
                                        <!--Sub-Category form end -->
                                    </div>
                                </div>
                            </div>
                          </div>
                        <!-- modal -part End -->
                    </div>
                </div>
                <div class="card-body categoryListHolder">
                    <table id="CategoryTable" class="table table-bordered categoryList" style="width:100%">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th>Serial</th>
                                <th>Category name</th>
                                <th>status</th>
                                <th>Created_at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                @include('backend.page.work.category.edit')
            </div>
        </div>
        <!-- data table end -->
    </div>
</div>
@endsection


@section('script')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        //get data table
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var t = $('#CategoryTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.category.index') }}",
                },
                columns:[
                    { data: 'id', name: 'id', 'visible': true},
                    // { data: 'DT_Row_Index', name: 'DT_Row_Index' },
                    { data: 'category_name', name: 'category_name' },
                    { data: 'status', name: 'status' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action', orderable: false},
                ],
                order: [[0, 'desc']],
            });
            t.on( 'draw.dt', function () {
            var PageInfo = $('#CategoryTable').DataTable().page.info();
                t.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                    cell.innerHTML = i + 1 + PageInfo.start;
                } );
            } );

            //Create form
            $('#create_record').click(function(){
                $('#formModal').modal('show');
            });
            $('#category_form').on('submit',function(event){
                event.preventDefault();
                var action_url = '';
                if($('#action').val() == 'submit'){
                    action_url =  "{{ route('admin.category.store') }}";
                }
                toastr.options = {
                "closeButton": true,
                "newestOnTop": true,
                "positionClass": "toast-top-right",
                "progressBar": true,
                };
                $.ajax({
                    url: action_url,
                    type: 'POST',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'category_name': $('input[name=category_name]').val(),
                    },
                    success: function(data){
                        var html ='';
                        if ((data.errors)) {
                            html = '<div class="alert alert-danger">';
                            html+='<div class="button"><button type="button" class="close" data-dismiss="alert">×</button></div>';
                            for(var count = 0; count < data.errors.length; count++)
                            {
                            html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        else {
                            $('#formModal').modal('hide');
                            $('#category_form')[0].reset();
                            $('#CategoryTable').DataTable().ajax.reload();
                            toastr.success(data.success);
                        }
                        $('#form_result').html(html);
                    },
                });
            });
        });

        //edit get category data
        $(document).on('click', '.open-editmodal', function(){
            var id = $(this).attr('id');
            $.ajax({
                url : "category/"+id+"/edit",
                dataType:"json",
                success:function(data)
                {
                    $('#categoryname').val(data.result.category_name);
                    $('#hidden_id').val(data.result.id);
                    $('.modal-title').text('Edit Record');
                    $('#editformModal').modal('show');
                }
            });
        });

        //update category data
        $('#update_categoryinsert').on('submit',function(event){
            event.preventDefault();
            var actions_url='';
            var category_name = $('#categoryname').val();
            var id = $('#hidden_id').val();
            if($('#edit_action').val() == 'submit'){
                actions_url ="{{ route('admin.category.data.update') }}";
            }
            toastr.options = {
                "closeButton": true,
                "newestOnTop": true,
                "positionClass": "toast-top-right",
                "progressBar": true,
            };
            $.ajax({
                url :actions_url,
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                success:function(data)
                {
                    var html ='';
                    if ((data.errors)) {
                        html = '<div class="alert alert-danger">';
                        html+='<div class="button"><button type="button" class="close" data-dismiss="alert">×</button></div>';
                        for(var count = 0; count < data.errors.length; count++)
                        {
                        html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    else {
                        $('#editformModal').modal('hide');
                        $('#CategoryTable').DataTable().ajax.reload();
                        toastr.success(data.success);
                    }
                    $('#editErors').html(html);
                }
            });
        });

        //delete category
        $(document).on('click', '.category_delete', function(){
            var cat_id = $(this).attr('data-id');

            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed){
                        $.ajax({
                            url:"{{url('admin/category/delete/data/')}}/"+cat_id,
                            success:function(data) {
                                if (data.success){
                                    swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        "success"
                                    );
                                    $('#CategoryTable').DataTable().ajax.reload();
                                }

                            }
                        });
                    }
                } else if (
                result.dismiss === Swal.DismissReason.cancel
                ) {
                swal.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                );
            }
        });
    });
    //change status
    $(document).on('click', '.change_status', function(){
            var cat_id = $(this).attr('data-id');
            $.ajax({
                url:"{{url('admin/category/status/')}}/"+cat_id,
                success:function(data) {
                    if (data.info){
                        $('#CategoryTable').DataTable().ajax.reload();
                        toastr.warning(data.info);
                    }
                    if (data.success){
                        $('#CategoryTable').DataTable().ajax.reload();
                        toastr.success(data.success);
                    }
                }
            });
        });
    });

</script>
@endsection
