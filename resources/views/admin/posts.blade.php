<!---This is Header---->
@include('admin.header')
<!---This is Header---->

<link href="{{url('summernote/summernote-lite.min.css')}}" rel="stylesheet" />

<!---This is Sidebar---->
@include('admin.sidebar')
<!---This is Sidebar---->

<div id="page-wrapper" >
  <div id="page-inner">
      <div class="row">
          <div class="col-md-12">
           <h2>{{$page_title}}</h2>   
          </div>

          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>

      </div>              
       <!-- /. ROW  -->
        <hr />
    
       <!-- /. ROW  -->           
</div>
   <!-- /. PAGE INNER  -->
  </div>
<!-- /. PAGE WRAPPER  -->
</div>

<!---This is footer---->
@include('admin.footer')
<!---This is footerr---->
<script src="{{url('summernote/summernote-lite.min.js')}}"></script>

<script>
  $(document).ready(function() {
    $('#summernote').summernote();
  }); 
</script>