@extends('backend.layouts.master')
@section('title')
Category
@endsection

@section('style')
<style>

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
                    <li><span>type of skill in technology</span></li>
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
                        <button class="button-one" id="skill_create_record" data-toggle="modal"><i class="ti-plus mr-2"></i>Create new one</button>
                        <!-- modal -part start -->
                        <div class="modal fade" id="skillModal" role="dialog">
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
                                        <!--skill insert form -->
                                        <form class="row" id="skill_form" enctype="multipart/form-data" role="form">
                                            @csrf
                                             <!-- form erors -->
                                            <div class="col-lg-12">
                                                <span id="form_result" class="error_result"></span>
                                            </div>
                                            <!--skill form item -->
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Skill Name</label>
                                                    <input type="text" name="skill_name" id="skill_name" class="form-control" placeholder="Enter Skill Name" required>
                                                </div>
                                            </div>
                                            <!--skill form button -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="submit" id="skill_submit" class="button-one" value="submit">
                                                </div>
                                            </div>
                                        </form>
                                        <!--skill form end -->
                                    </div>
                                </div>
                            </div>
                          </div>
                        <!-- modal part End -->
                    </div>
                </div>
                <div class="card-body">
                    <table id="CategoryskilltagTable" class="table table-bordered" style="width:100%">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th>Serial</th>
                                <th>skill name</th>
                                <th>status</th>
                                <th>Created_at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                @include('backend.page.work.skilltag.edit')
            </div>
        </div>
        <!-- data table end -->
    </div>
</div>
@endsection



@section('script')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        //get data
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var t= $('#CategoryskilltagTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('admin.work.skill.index') }}",
                    },
                    columns:[
                        { data: 'id', name: 'id', 'visible': true},
                        { data: 'skill_name', name: 'skill_name' },
                        { data: 'status', name: 'status' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'action', name: 'action', orderable: false},
                    ],
                    order: [[0, 'desc']],
                });
                t.on( 'draw.dt', function () {
                var PageInfo = $('#CategoryskilltagTable').DataTable().page.info();
                    t.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                        cell.innerHTML = i + 1 + PageInfo.start;
                } );
            });
            //create
            $('#skill_create_record').click(function(){
                $('#skillModal').modal('show');
            });
            $('#skill_form').on('submit',function(event){
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('admin.work.skill.store') }}",
                    type: 'POST',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'skill_name': $('input[name=skill_name]').val(),
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
                            $('#skillModal').modal('hide');
                            $('#skill_form')[0].reset();
                            $('#CategoryskilltagTable').DataTable().ajax.reload();
                            toastr.success(data.success);
                        }
                        $('.error_result').html(html);
                    },
                });

            });
            //edit
            //edit get category data
            $(document).on('click', '.open-editskillmodal', function(){
                var id = $(this).attr('id');
                $.ajax({
                    url : "workskill/"+id+"/edit",
                    dataType:"json",
                    success:function(data)
                    {
                        $('#skillname').val(data.result.skill_name);
                        $('#hidden_id').val(data.result.id);
                        $('.modal-title').text('Edit Record');
                        $('#editskillModal').modal('show');
                    }
                });
            });

            //update category data
            $('#update_skillinsert').on('submit',function(event){
                event.preventDefault();
                var actions_url='';
                var skill_name = $('#skillname').val();
                var id = $('#hidden_id').val();
                $.ajax({
                    url :"{{ route('admin.work.skill.data.update') }}",
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
                            $('#editskillModal').modal('hide');
                            $('#CategoryskilltagTable').DataTable().ajax.reload();
                            toastr.success(data.success);
                        }
                        $('#editErors').html(html);
                    }
                });
            });

            //delete category
            $(document).on('click', '.skill_delete', function(){
                var s_id = $(this).attr('data-id');
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
                                url:"{{url('admin/work/skill/data/')}}/"+s_id,
                                success:function(data) {
                                    if (data.success){
                                        swal.fire(
                                            'Deleted!',
                                            'Your file has been deleted.',
                                            "success"
                                        );
                                        $('#CategoryskilltagTable').DataTable().ajax.reload();
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

        });

        //change status
        $(document).on('click', '.skill_status', function(){
            var s_id = $(this).attr('data-id');
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                url:"{{url('admin/workskill/status/')}}/"+s_id,
                success:function(data) {
                    if (data.infos){
                        $('#CategoryskilltagTable').DataTable().ajax.reload();
                        toastr.warning(data.infos);
                    }
                    if (data.success){
                        $('#CategoryskilltagTable').DataTable().ajax.reload();
                        toastr.success(data.success);
                    }
                },
            });
        });



    });
</script>
@endsection
