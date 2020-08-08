<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>Vnxe Blog</title>

    <!-- Styles -->
    <link href="{{ asset('css/page.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style1.css') }}" rel="stylesheet">

  </head>

  <body class="layout-centered" style="background: rgb(245, 242, 242)">

    <!-- Main Content -->
    <main class="main-content">

      <div class="bg-white rounded shadow-7 w-400 mw-100 p-6">
        <div>
            <h5 class="mb-7">Sign into your account</h5>
            
        </div>

        <form action="{{ route('login') }}" method="POST">
          @csrf

          <div class="form-group">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password">
          </div>

          <div class="form-group flexbox py-3">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" checked>
              <label class="custom-control-label">Remember me</label>
            </div>

            <a class="text-muted small-2" href="user-recover.html">Forgot password?</a>
          </div>

          <div class="form-group">
            <button class="btn btn-block btn-primary" type="submit">Login</button>
          </div>
        </form>


        <hr class="w-30">

        <p class="text-center text-muted small-2">Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
      </div>

    </main><!-- /.main-content -->


    <!-- Scripts -->
    <script src="../assets/js/page.min.js"></script>
    <script src="../assets/js/script.js"></script>

  </body>
</html>
