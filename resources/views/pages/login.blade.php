@extends('layout.login')
@section('content')


    <!-- Content -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="{{url('/')}}" class="app-brand-link gap-2">
                                <img src="{{url('/')}}/assets/img/manage.jpg" class="img-fluid">
                           </a>
                        </div>
                        <!-- /Logo -->
                        <p class="mb-4">Please sign-in to your account and start the adventure</p>

                    @include('partials.message')
                    <!-- Login form-->

                        <form id="formAuthentication" class="mb-3" action="{{route('login')}}" method="POST">
                            <div class="mb-3">
                                <label for="email" class="small">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email or username" autofocus>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="small" for="password">Password</label>

                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me">
                                    <label class="form-check-label" for="remember-me">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                @csrf
                                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                            </div>
                        </form>


                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
    <!--/ Content -->

@endsection

