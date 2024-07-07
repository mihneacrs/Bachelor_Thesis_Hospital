

<!DOCTYPE html>
<html lang="en">
  <head>
   
    @include ('admin.css')

  </head>
  <body>
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
            <div class="ps-lg-1">
              <div class="d-flex align-items-center justify-content-between">
                <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                <a href="https://www.bootstrapdash.com/product/corona-free/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/corona-free/"><i class="mdi mdi-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="mdi mdi-close text-white me-0"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- partial:partials/_sidebar.html -->
      
    @include('admin.sidebar')

      <!-- partial -->
      
    @include('admin.navbar')

      <!-- partial -->

      <div class="container-fluid page-body-wrapper">

        <div class="container" align="center" style="padding-top: 100px;">

          <form action="{{url('/importuser')}}" method="POST" enctype="multipart/form-data">
            @csrf

      <input type='file' name='file'>
            
      <input type="submit" class='btn btn-success' value="Import User Data">

      <a href="{{url('exportuser')}}">Export User Data</a>

          </form>

          <form action="{{url('/importdoctor')}}" method="POST" enctype="multipart/form-data">
            @csrf

      <input type='file' name='file'>
            
      <input type="submit" class='btn btn-success' value="Import Doctor Data">

      <a href="{{url('exportdoctor')}}">Export Doctor Data</a>

          </form>

          <form action="{{url('/importappointment')}}" method="POST" enctype="multipart/form-data">
            @csrf

      <input type='file' name='file'>
            
      <input type="submit" class='btn btn-success' value="Import Appointments Data">

      <a href="{{url('exportappointment')}}">Export Appointments Data</a>

          </form>

        </div>
      </div>

    <!-- container-scroller -->
    <!-- plugins:js -->
    
  @include ('admin.script')

    <!-- End custom js for this page -->
  </body>
</html>