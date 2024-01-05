<!---This is Header---->
@include('admin.header')
<!---This is Header---->

<!---This is Sidebar---->
@include('admin.sidebar')
<!---This is Sidebar---->

<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>{{$page_title}}</h2>
            </div>
        </div>

        <div class="container-fluid col-lg-12">
            <?php if($row): ?>
                <?php if($row->id == 1): ?>
                    <h4>You cannot delete the main admin</h4>
                    <a href="{{url('admin/users')}}">
                        <input class="btn btn-success" style="float:right" type="button" value="Back">
                    </a>
                <?php else: ?>
                    <h4>Are you sure you want to delete this User?</h4>
                    <form method="post" enctype="multipart/form-data">
                        @if($errors->all())
                            <div class="alert alert-danger text-center">
                                @foreach ($errors->all() as $error)
                                    {{$error}}<br>
                                @endforeach
                            </div>
                        @endif

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">User Name</label><br>
                            <div class="col-sm-10">
                                <input disabled value="{{$row->name}}" id="name" type="text" class="form-control" placeholder="Category" name="name" autofocus><br>
                            </div>
                        </div>

                        @csrf
                        <input class="btn btn-danger" type="submit" value="Delete">
                        <a href="{{url('admin/users')}}">
                            <input class="btn btn-success" style="float:right" type="button" value="Back">
                        </a>
                    </form>
                <?php endif; ?>
            <?php else: ?>
                <br><h4>Sorry, Could not find that User</h4><br>
                <a href="{{url('admin/users')}}">
                    <input type="button" class="btn btn-success" style="float:right" value="Back">
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- /. ROW  -->
    <hr />

    <!-- /. ROW  -->
</div>
<!-- /. PAGE INNER  -->
</div>

<!---This is footer---->
@include('admin.footer')
<!---This is footer---->
