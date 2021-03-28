@extends('admin.admin-layouts.master')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Work Space</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="card-header" style="width:100%">
                <a class="btn btn-sm btn-info" data-toggle="modal" href="#add_workspace_modal" style="float: right;">Add new Asset</a>
            </div>
            <div style="width: 100%">
                <div class="table-responsive">
                    <table class="table table-bordered" id="workspaceDT" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                           
                            <th>Name</th>
                            <th>Action</th>
                            
                        </tr>
                        </thead>
                       
                        <tbody>
                       
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <div id="add_workspace_modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Workspace</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="mess"></div>
                    <form id="workspaceform" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input name="name" id="name" class="form-control" type="text" placeholder="Workspace Name">
                        </div>
                        <div class="form-group">
                            <input id="saveBtn" class="btn btn-block btn-info" type="submit" value="create">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div id="delete_workspace_modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Workspace</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="mess"></div>
                    <form id="ss" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="workspaceId">
                            <h4>Are You Sure? </h4>                   
                        </div>
                        <div class="form-group">
                            <input class="btn btn-block btn-info" value="Cancel" data-dismiss="modal">
                            <input id="deleteworkspace" class="btn btn-block btn-info" type="submit" value="Delete">
                        </div>
                    </form>
                  
                </div>
            </div>
        </div>
    </div>







    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
       
<script type="text/javascript">
   
   $(document).ready(function(){

    var tableLoad = $('#workspaceDT').DataTable({
            ajax: '/admin/workspacetable',
            columns: [
                { "data": "name" },
               
                {
                    "data": null,
                    render: function(data, type, row) {
                    return [`<a class="btn btn-sm btn-warning" href="workspace/view/${row.id}" data-id="${row.id}"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" href="#" id="editAssetTypeModal"></i></a>`,`<a class="btn btn-sm btn-success" data-id="${row.id}"><i class="fa fa-edit" aria-hidden="true" data-toggle="modal" href="#edit_asset_modal" id="editAssetTypeModal"></i></a>`, `<a class="btn btn-sm btn-danger"  data-id="${row.id}" id="deleteWorkspaceModal"><i class="fa fa-times" aria-hidden="true" data-toggle="modal"  ></i></a>`];
                    }
                }

            ]
        });





    $("#workspaceform").on('submit',function(e){
        e.preventDefault();
         
        $.ajax({
            type:"post",
            url:"/admin/addworkspace",
            data:$("#workspaceform").serialize(),
            success: function(response){
                $("#add_workspace_modal").modal('hide')
                tableLoad.ajax.reload();
                swal("Good job!", "Workspace Created", "success");
            },
            error: function(error){
                console.log(error)
                alert('not saved');
            }
        })


    }) 

    var id;

   $(document).on('click','#deleteWorkspaceModal',function(){
        id = $(this).attr('data-id');
       console.log(id);
       $('#delete_workspace_modal').modal('show');
   })
  
   
   $(document).on('click', '#deleteworkspace', function(e) {
            e.preventDefault();
            let workspaceID = $('#delete_workspace_modal input[name="www"]').val();
            //alert(leaveRequestID);
            console.log("iiiiiiiiiiiiiiii",id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/admin/deleteworkspace/'+id,
                method: 'POST',
                dataType: "json",
                success: function(response) {
                    $('#delete_workspace_modal').modal('hide');
                    tableLoadLeaveRequest.ajax.reload();
                    //alert(data.id);
                    swal("Good job!", "Workspace Deleted", "success");
                },
                error: function(response) {
                    alert('error');
                    console.log(response);
                }
            });

   })
  
});

  </script>



@endsection

