<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>E - Skripsi | Login</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="{{ asset('lib') }}/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="{{ asset('lib') }}/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('css') }}/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{ asset('css') }}/style.css" rel="stylesheet">
    </head>

    <body>
        <div class="container-xxl position-relative bg-white d-flex p-0">

            {{-- sweetalert --}}
            @include('sweetalert::alert')

            <!-- Spinner Start -->
            <div id="spinner"
                class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
                <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <!-- Spinner End -->

            <!-- Sign In Start -->
            <div class="container-fluid">
                <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5">
                        <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="index.html" class="">
                                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>E - Skripsi</h3>
                                </a>
                                <h3>Login</h3>
                            </div>
                            @if (session()->has('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form action="/auth/login" method="post">
                                @csrf

                                <div class="form-floating mb-4">
                                    <input type="number"
                                        class="form-control @error('nim_or_nidn') is-invalid @enderror"
                                        name="nim_or_nidn" placeholder="NIM Or NIDN" value="{{ old('nim_or_nidn') }}">
                                    <label for="nim_or_nidn">NIM atau NIDN</label>
                                    @error('nim_or_nidn')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" placeholder="Password">
                                    <label for="password">Password</label>
                                    @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="remember_token"
                                            {{ old('remember_token') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember_token">Remember me</label>
                                    </div>
                                    <a href="">Forgot Password</a>
                                </div>
                                <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
                            </form>

                            <p class="text-center mb-0">Don't have an Account? <a href="">Sign Up</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sign In End -->
        </div>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('lib') }}/chart/chart.min.js"></script>
        <script src="{{ asset('lib') }}/easing/easing.min.js"></script>
        <script src="{{ asset('lib') }}/waypoints/waypoints.min.js"></script>
        <script src="{{ asset('lib') }}/owlcarousel/owl.carousel.min.js"></script>
        <script src="{{ asset('lib') }}/tempusdominus/js/moment.min.js"></script>
        <script src="{{ asset('lib') }}/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="{{ asset('lib') }}/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Template Javascript -->
        <script src="{{ asset('js') }}/main.js"></script>
    </body>

</html>
