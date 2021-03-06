@extends('layouts.app',
[
'namePage' => 'Login page',
'class' => 'login-page sidebar-mini ',
'activePage' => 'login',
'backgroundImage' => asset('assets') . "/img/bg14.jpg",
]
)

@section('content')
    <div class="content">
        <div class="container">
            <div class="col-md-12 ml-auto mr-auto">
                <div class="header bg-gradient-primary py-10 py-lg-2 pt-lg-12">
                    <div class="container">
                        <div class="header-body text-center mb-7">
                            <div class="row justify-content-center">
                                <div class="col-lg-12 col-md-9">
                                    <p class="text-lead text-light mt-3 mb-0">
                                        @include('alerts.migrations_check')
                                    </p>
                                </div>
                                <div class="col-lg-5 col-md-6">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ml-auto mr-auto">
                <form
                    role="form"
                    method="POST"
                    action="{{ route('login') }}"
                >
                    @csrf
                    <div class="card card-login card-plain">
                        <div class="card-header ">
                            <div class="logo-container">
                                <img
                                    src="{{ asset('assets/img/now-logo.png') }}"
                                    alt=""
                                >
                            </div>
                        </div>

                        <div class="card-footer ">
                            <a
                                href="{{ route('github.signup') }}"
                                class="btn btn-primary btn-round btn-lg btn-block mb-3"
                            >
                                <span class="btn-inner--icon">
                                    <img
                                        src="https://argon-dashboard-laravel.creative-tim.com/argon/img/icons/common/github.svg">
                                </span>
                                <span class="btn-inner--text">Sign In With Github</span>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script
        type="application/javascript"
        $(document)
        .ready(
        function()
        {
        demo
        .checkFullPageBackgroundImage();
        });
        </script
    >
    @endpush
