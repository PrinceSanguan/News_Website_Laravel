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

      <div class="container-fluid col-lg-12">
        <h4>Are you want to delete this category?</h4>
            <form method="post" enctype="multipart/form-data">


              @if($errors->all())
                <div class="alert alert-danger text-center">
                  @foreach ($errors->all() as $error)
                      {{$error}}<br>
                  @endforeach
                </div>
              @endif

              <div class="form-group row">
                <label for="category" class="col-sm-2 col-form-label">Category Name</label><br>
                <div class="col-sm-10">
                  <input disabled value="{{$row->category}}" id="category" type="text" class="form-control" placeholder="Category" name="category" autofocus><br>
                </div>
              </div>

                  @csrf
                  <input class="btn btn-danger" type="submit" value="Delete">
                    <a href="{{url('admin/category')}}">
                      <input class="btn btn-success" style="float:right" type="button" value="Back">
                    </a>
            </form>
          </div>
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