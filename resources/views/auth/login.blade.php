<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>{{str_replace('_', ' ', config('app.name'))}}</title>
  <link rel="stylesheet" href="{{url('assets/css/login.css')}}">

  <!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

</head>
<body>
<!-- partial:index.partial.html -->
<body>
    <section class="container">
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="form-container">
                <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
                <h1 class="opacity">LOGIN</h1>
                <form method="post" action="{{url('login')}}">
                  @csrf
                    <input type="text" placeholder="USERNAME" />
                    <input type="password" placeholder="PASSWORD" />
                    <button class="opacity">SUBMIT</button>
                </form>
                <div class="register-forget opacity">
                </div>
            </div>
            <div class="circle circle-two"></div>
        </div>
        <div class="theme-btn-container"></div>
    </section>
</body>
<!-- partial -->
  <script  src="{{url('assets/js/login.js')}}"></script>

</body>
</html>
