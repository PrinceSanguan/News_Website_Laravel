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
            <form method="post" enctype="multipart/form-data">


              @if($errors->all())
                <div class="alert alert-danger text-center">
                  @foreach ($errors->all() as $error)
                      {{$error}}<br>
                  @endforeach
                </div>
              @endif

              <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label">Post Title</label>
                <div class="col-sm-10">
                  <input value="{{$row->title}}" id="title" type="text" class="form-control" placeholder="Title" name="title" autofocus><br>
                </div>
              </div>

              <div class="form-group row">
                <label for="file" class="col-sm-2 col-form-label">Feature Image</label>
                <div class="col-sm-10">
                  <input id="file" type="file" class="form-control" name="file">
                  <img src="{{url('uploads/'.$row->image)}}" style="width: 200px;">
                </div>
              </div>

              <div class="form-group row">
                <label for="category_id" class="col-sm-2 col-form-label">Post Category</label>
                <div class="col-sm-10">
                  <select id="category_id" name="category_id" class="form-control">
                    <option value="{{$row->category_id}}">{{$category->category}}</option>
                  </select>
                </div>
              </div>

                  @csrf
                  <h4>Post Content</h4>
                  <textarea name="content" id="summernote">{{$row->content}}</textarea>

                  <input class="btn btn-primary" type="submit" value="save">
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

<script>
  $(document).ready(function() {
    $('#summernote').summernote({
      height:400
    });
  }); 
</script>