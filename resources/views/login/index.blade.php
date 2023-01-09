<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat datang! | </title>

    <!-- Bootstrap -->
    <link href="{{ asset('assets') }}/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('assets') }}/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('assets') }}/vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('assets') }}/build/css/custom.min.css" rel="stylesheet">

    <link href="{{ asset('assets') }}/vendors/animate.css/animate.min.css" rel="stylesheet">
    <meta name="robots" content="noindex, follow">
</head>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <main class="form-signin justify-content-center">
                        <h1 class="h3 mb-3 fw-normal text-center">Silahkan Login</h1>
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        <form action="/" method="POST">
                            @csrf
                            <div class="form-floating">
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" id="floatingInput"
                                    placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                                <label for="floatingInput"></label>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-floating">
                                <input type="password" name="password" class="form-control" id="floatingPassword"
                                    placeholder="Password" required>
                                <label for="floatingPassword"></label>
                            </div>
                            <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
                        </form>
                    </main>
                </section>
            </div>
        </div>
    </div>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js"
        data-cf-beacon='{"rayId":"6a8b4faae117ffb4","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.10.0","si":100}'>
    </script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js"
        data-cf-beacon='{"rayId":"6a8b4fa9eadfffb4","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.10.0","si":100}'>
    </script>
    <!-- jQuery -->
    <script src="{{ asset('assets') }}/vendors/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('assets') }}/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="{{ asset('assets') }}/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="{{ asset('assets') }}/vendors/nprogress/nprogress.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('assets') }}/build/js/custom.min.js"></script>
    <script src="{{ asset('assets') }}/vendors/datatables.net/js/jquery.dataTables.js"></script>
</body>

</html>
