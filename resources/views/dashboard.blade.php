<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include('dashboard/layouts/partials/head')
<body id="page-top">
    @include('dashboard/layouts/partials/nav')
    <div id="wrapper">
        @include('dashboard/layouts/partials/sidebar')
        <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Overview</li>
            </ol>

            <!-- Icon Cards-->
            @include('dashboard/layouts/partials/card')

            <div class="card mb-3">
                <div style="color: red;" class="card-header">
                    <i class="fas fa-warning"></i>
                    <strong>Pending Data</strong>
                    
                    <div class="card-body">
                    <div class="table-responsive">                        
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>No</th>
                                <th>Time</th>
                                <th>Requester</th>
                                <th>Issue</th>
                                <th>Comments</th>
                                <th>Done By</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                    $initialDate = '';
                                    $nr = 1;
                                    foreach($onProgressTasks as $task){?>
                                <tr>
                                    @if($initialDate != $task->created_at->toDateString() )
                                    <td>{{date('jS, F Y', strtotime($task->created_at))}}<br/></td>
                                        <?php 
                                            $initialDate = $task->created_at->toDateString();
                                            if($initialDate = $task->created_at->toDateString()){
                                                $nr = 1;
                                            }
                                            ?>
                                        @else
                                        <td>{{""}}</td>
                                    @endif
                                    <td>{{$nr}}</td>                                    
                                    <td>{{$task->time}}</td>
                                    <td>{{$task->requester}}</td>
                                    <td>{{$task->issue}}</td>
                                    <td>{{$task->comment}}</td>
                                    <td>{{$task->doneBy}}</td>
                                    @if($task->status=='On Progress')
                                    <td style="color:red; font-weight: bold;">{{$task->status}}</td>
                                    @else
                                    <td>{{$task->status}}</td>
                                    @endif
                                    <td>
                                        <button class="btn btn-link open_modal" value="{{$task->id}}">
                                            <i class="fa fa-pencil" style="font-size:16px;color:#00AAE3"></i>
                                        </button>

                                        <button class="btn btn-link delete-task" value="{{$task->id}}"> 
                                            <i class="fa fa-trash" style="font-size:16px;color:red"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php
                                     $nr++;                                  
                                    }?>
                            </tbody>
                        </table><br/>    

                        </div>                    
                        
                        
                    </div>

                </div>
            </div>

            <!-- DataTables Example -->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Working Log Data
                    <div class="float-right" style="padding-bottom: 20px;">
                        <button id="btn_add" type="button" href="#" data-toggle="modal" data-target="#addNewModal" class="btn btn-primary">Add New &nbsp;<i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">                        
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>No</th>
                                <th>Time</th>
                                <th>Requester</th>
                                <th>Issue</th>
                                <th>Comments</th>
                                <th>Done By</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                    $initialDate = '';
                                    $nr = 1;
                                    foreach($tasks as $task){?>
                                <tr>
                                    @if($initialDate != $task->created_at->toDateString() )
                                    <td>{{date('jS, F Y', strtotime($task->created_at))}}<br/></td>
                                        <?php 
                                            $initialDate = $task->created_at->toDateString();
                                            if($initialDate = $task->created_at->toDateString()){
                                                $nr = 1;
                                            }
                                            ?>
                                        @else
                                        <td>{{""}}</td>
                                    @endif
                                    <td>{{$nr}}</td>                                    
                                    <td>{{$task->time}}</td>
                                    <td>{{$task->requester}}</td>
                                    <td>{{$task->issue}}</td>
                                    <td>{{$task->comment}}</td>
                                    <td>{{$task->doneBy}}</td>
                                    @if($task->status=='On Progress')
                                    <td style="color:red; font-weight: bold;">{{$task->status}}</td>
                                    @else
                                    <td>{{$task->status}}</td>
                                    @endif
                                    <td>
                                        <button class="btn btn-link open_modal" value="{{$task->id}}">
                                            <i class="fa fa-pencil" style="font-size:16px;color:#00AAE3"></i>
                                        </button>

                                        <button class="btn btn-link delete-task" value="{{$task->id}}"> 
                                            <i class="fa fa-trash" style="font-size:16px;color:red"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php
                                     $nr++;                                  
                                    }?>
                                   
                            </tbody>
                        </table><br/>    
                        
                        </div>
                        <ul class="pagination">
                        {{ $tasks->links('pagination::bootstrap-4') }}
                        </ul>
                       
                        
                        
                    </div>
                <div class="card-footer small text-muted">was updated on&nbsp;{{date('jS F Y', strtotime(now()))}}</div>

               

                

            </div>

            <!-- Area Chart Example-->
            <!-- <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-chart-area"></i>
                    Area Chart Example
                </div>
                <div class="card-body">
                    <canvas id="myAreaChart" width="100%" height="30"></canvas>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div> -->


        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright © ICT UNICEF 2019</span>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                ×</button>

            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="#">Logout</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">What the issues today?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">×</button>
            </div>
            
            <div class="modal-body">            
                <form id="frmTasks" name="frmTasks" class="form-horizontal" novalidate="">
                    
                <div class="form-group">
                    <label for="time">Time</label>                        
                        <select class="form-control" id="time">
                            <option>07:00 - 07:59</option>
                            <option>08:00 - 08:59</option>
                            <option>09:00 - 09:59</option>
                            <option>10:00 - 10:59</option>
                            <option>11:00 - 11:59</option>
                            <option>12:00 - 12:59</option>
                            <option>13:00 - 13:59</option>
                            <option>14:00 - 14:59</option>
                            <option>15:00 - 15:59</option>
                            <option>16:00 - 16:59</option>
                            <option>17:00 - 17:59</option>
                            <option>18:00 - 18:59</option>
                        </select>  
                    </div> 

                    <div class="form-group">
                        <label for="requester">Requester</label>
                        <input type="text" class="form-control" value="<?php ?>" id="requester" placeholder="Enter requester name"/>
                    </div>
                    
                    <div class="form-group">
                        <label for="issue">Issue</label>                        
                        <select class="form-control" id="issue">
                            <option>Application</option>
                            <option>Conference</option>
                            <option>Hardware</option>
                            <option>ICT Project</option>
                            <option>Infrastructure</option>
                            <option>Server</option>
                            <option>Others</option>

                        </select>  
                    </div>                
                                
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <input type="text" class="form-control" value="" id="comment" placeholder="Enter your comment"/>
                    </div>
                        
                    <div class="form-group">
                        <label for="doneBy">Done By</label>
                        <select class="form-control" id="doneBy">
                            <option>MR</option>
                            <option>AF</option>
                            <option>MH</option>
                        </select>   
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status">
                            <option>Completed</option>
                            <option>On Progress</option>
                        </select>   
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" id="btn-save" value="add" type="button" data-dismiss="modal">Submit</button>                
                <input type="hidden" id="id" name="id" value="0">
            </div>                           

        </div>
    </div>
</div>

<meta name="_token" content="{!! csrf_token() !!}" />
<!-- Bootstrap core JavaScript-->
<script src="{{asset('dashboard/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('dashboard/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Page level plugin JavaScript-->
<script src="{{asset('dashboard/vendor/chart.js/Chart.min.js')}}"></script>
<!-- Custom scripts for all pages-->
<script src="{{asset('dashboard/js/sb-admin.min.js')}}"></script>

<!-- Demo scripts for this page-->
<!-- <script src="{{asset('dashboard/js/demo/chart-area-demo.js')}}"></script> -->
<script src="{{asset('dashboard/js/ajaxForm.js')}}"></script>
</body>
</html>
