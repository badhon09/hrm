@extends('admin.admin-layouts.master')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Work Space Name: {{ $workspace[0]->name }}</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="card-header" style="width:100%">
                <a class="btn btn-sm btn-success" data-toggle="modal" href="#add_workspace_modal" style="float: right;">Add new Project</a>
            </div>
            <div style="width: 100%">
                <div class="table-responsive">
                    <table class="table table-bordered" id="workspaceDT" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Project Name</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th>Start Time</th>
                            <th>End Time</th>
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
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Project</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="mess"></div>
                    <form id="workspaceform" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Project Name</label>
                            <input name="name" id="name" class="form-control" type="text" placeholder="Project Name">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <input name="description" id="description" class="form-control" type="text" placeholder="Project Description">
                        </div>
                        <div class="form-group">
                            <label for="">Start Date</label>
                                                <input id="datepicker" width="270" />
                        <script>
                            $('#datepicker').datepicker({
                                uiLibrary: 'bootstrap'
                            });
                        </script>
                        </div>
                        <div class="form-group">
                            <label for="">End Date</label>
                            
                            <input id="datepickerl" width="270" />
                            <script>
                                $('#datepickerl').datepicker({
                                    uiLibrary: 'bootstrap'
                                });
                            </script>
                        </div>
                        <div class="form-group">
                            <label for="">Project Budget</label>
                            <input name="budget" id="budget" class="form-control" type="number" >
                        </div>
                        <div class="form-group">
                            <label for="">Select Employees</label>
                            <script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006273/BBBootstrap/choices.min.js?version=7.0.0"></script>
                            <select id="choices-multiple-remove-button" placeholder="Select Employees" multiple>
                                <option value="HTML">HTML</option>
                                <option value="HTML">HTMLy</option>
                                <option value="HTML">HTML7</option>
                                <option value="Jquery">Jquery</option>
                               
                            </select> 
                            <script>
                                 $(document).ready(function(){

var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
removeItemButton: true,
maxItemCount:5,
searchResultLimit:5,
renderChoiceLimit:5
});


});
                            </script>
                        </div>
                        <div class="form-group">
                            <input id="saveBtn" class="btn btn-block btn-info" type="submit" value="create">
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>







    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
       



@endsection

