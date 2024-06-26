@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="{{asset('node_modules/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="node_modules/rickshaw/rickshaw.min.css" />
  <link rel="stylesheet" href="bower_components/chartist/dist/chartist.min.css" />
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
<body>
  <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="background-color:sandybrown; width:225px; font-size:13px;" id="mySidebar">
 <ul class="nav">
           <li class="nav-item">
              <a class="nav-link" href="{{URL::to('/allexamcommitteebilling')}}">
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                <span class="menu-title">Exam Committee Billing</span>
              </a>
            </li>
           <li class="nav-item">
              <a class="nav-link" href="{{URL::to('/alldepartment')}}">
                <i class="mdi mdi-repeat menu-icon"></i>
                <span class="menu-title">Department List</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{URL::to('/addteacher')}}">
                <i class="mdi mdi-repeat menu-icon"></i>
                <span class="menu-title">Teacher List</span>
              </a>
            </li>

           <!--forms start-->
          <li class="nav-item">
              <a class="nav-link" href="{{URL::to('/alldegree')}}">
                <i class="mdi mdi-gauge menu-icon"></i>
                <span class="menu-title">Degree List</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{URL::to('/allcourses')}}">
                <i class="mdi mdi-gauge menu-icon"></i>
                <span class="menu-title">Course List</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{URL::to('/allstaff')}}">
                <i class="mdi mdi-gauge menu-icon"></i>
                <span class="menu-title">Staff List</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{URL::to('/allremark')}}">
                <i class="mdi mdi-repeat menu-icon"></i>
                <span class="menu-title">Remark List</span>
              </a>
            </li>
            
            <!--main pages end-->
           
            
          </ul>
        </nav>
      </div>

     <div class="container "  style=" margin-left:230px; width:1100px; height:100%; background:khaki; border: 2px solid">
      <div class="container col-md-6 card-body" style="background-color: khaki;" >
      @if($errors->any())
      @foreach($errors->all() as $error)
      <p class="text-danger">{{$error}}</p>
      @endforeach
      @endif
      @if(Session::has('msg'))
      <h3 class="text-success">{{session('msg')}}</h3>
      @endif
      <a href="{{URL::to('/alldegree')}}">
                                <button class="btn btn-secondary btn-sm">Show All Degree List</button>
                              </a>
                          <h3 class="card-title" style="text-align: center;">Degree Update List</h3>
                          
                          <form class="forms-sample" method="post" action="{{URL::to('update_degree/'.$data->id)}}" enctype="multipart/form-data" style="width:100%; font-size: 15px;">
                            @method('put')
                            {{csrf_field()}}
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Degree Name</label>
                                  <input type="text" class="form-control p-input" name="degree_name" value="{{$data->degree_name}}" aria-describedby="emailHelp">
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Degree Description</label>
                                  <input type="text" class="form-control p-input" name="degree_description" value="{{$data->degree_description}}" aria-describedby="emailHelp" >
                              </div>
                              
                              <div class="form-group">
                                <label for="exampleInputPassword1">Degree Status</label>
                                <select class="form-control p-input" name="degree_status">
                                  <option @if($data->degree_status==1) selected @endif value="1">Active</option>
                                  <option @if($data->degree_status==2) selected @endif value="2">Inactive</option>
                                </select>
                              </div>
                              <div class="card-footer">
                              <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                          </form>
                      </div>
<script src="{{asset('node_modules/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('node_modules/popper.js/dist/umd/popper.min.js')}}"></script>
  <script src="{{asset('node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{asset('node_modules/flot/jquery.flot.js')}}"></script>
  <script src="{{asset('node_modules/flot/jquery.flot.resize.js')}}"></script>
  <script src="{{asset('node_modules/flot/jquery.flot.categories.js')}}"></script>
  <script src="{{asset('node_modules/flot/jquery.flot.pie.js')}}"></script>
  <script src="{{asset('node_modules/rickshaw/vendor/d3.v3.js')}}"></script>
  <script src="{{asset('node_modules/rickshaw/rickshaw.min.js')}}"></script>
  <script src="{{asset('bower_components/chartist/dist/chartist.min.js')}}"></script>
  <script src="{{asset('node_modules/chartist-plugin-legend/chartist-plugin-legend.js')}}"></script>
  <script src="{{asset('node_modules/chart.js/dist/Chart.min.js')}}"></script>
  <script src="{{asset('node_modules/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{asset('js/off-canvas.js')}}"></script>
  <script src="{{asset('js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('js/misc.js')}}"></script>
  <script src="{{asset('js/settings.js')}}"></script>
  <!-- endinject -->
  <script src="{{asset('node_modules/datatables.net/js/jquery.dataTables.js')}}"></script>
  <script src="{{asset('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js')}}"></script>
  <script src="{{asset('js/data-table.js')}}"></script>
  <!-- Custom js for this page-->
  <script src="{{asset('js/dashboard_1.js')}}"></script>
     
</body>
</html>
@endsection

