<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="/images/favicon.ico">
        <link href="/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <link href="/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <link href="/css/fonts/hindsiliguri.css?v=1.0" rel="stylesheet">
        <script src="/js/plugin.js"></script>
        <style>
            body { font-family: 'Hind Siliguri', sans-serif; }
        </style>
        @yield('style')
    </head>
    <body>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">

                            <div class="card-body pt-0">
                                <div class="p-2 mt-4 text-center">
                                    <img src="/images/logo_sidara.png" alt="" class="img-fluid" width="160px">
                                </div>
                                <div class="p-2">
                                    <form action="{{ url('login') }}" method="post" class="form-horizontal">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Email</label>
                                            <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent @error('email') is-invalid @enderror"/>
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent @error('password') is-invalid @enderror"/>
                                                <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            </div>
                                            @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                        {{-- <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="remember-check">
                                            <label class="form-check-label" for="remember-check">
                                                Remember me
                                            </label>
                                        </div> --}}
                                        <div class="mt-3 d-grid mb-3">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <div>
                                <p>© <script>document.write(new Date().getFullYear())</script> Sidara. Crafted with <i class="mdi mdi-heart text-danger"></i></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/libs/jquery/jquery.min.js"></script>
        <script src="/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/libs/metismenu/metisMenu.min.js"></script>
        <script src="/libs/simplebar/simplebar.min.js"></script>
        <script src="/libs/node-waves/waves.min.js"></script>
        <script src="/js/app.js"></script>
        <script src="/libs/toastr/build/toastr.min.js?v=1.0"></script>
        <script src="/js/pages/toastr.init.js?v=1.0"></script>
        @if (Session::has('error'))
        <script>
            $(document).ready(function() {
                toastr.error('{{ Session::get('error') }}');
            });
        </script>
        @elseif(Session::has('success'))
        <script>
            $(document).ready(function() {
                toastr.success('{{ Session::get('success') }}');
            });
        </script>
        @endif
    </body>
</html>
