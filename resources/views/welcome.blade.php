<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'SisJuri') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
            }

            .content {
                text-align: center;
            }

            .title {
                margin-top: 150px;
                font-size: 60px;
            }

        </style>
    </head>
    <body>
        <div class="container">

            <div class="content">
            
                <div class="title m-b-md">
                    {{ config('app.name', 'SisJuri') }}
                </div>

                        @guest
                        <div class="card col-md-8 m-auto">
                            
                            <div class="card-body">
                                @if(Session::has('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ Session::get('error') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('entrar') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="m-auto">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Entrar') }}
                                            </button>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                @else
                    <div class="text-center mt-5">
                        Você está logado como: {{ Auth::user()->name }} <br> <br>
                        <a class="btn btn-primary mr-4" href="{{ route('home') }}" role="button">Continuar</a>
                        <a class="btn btn-secondary" href="{{ route('sair') }}" role="button">Sair</a>
                    </div>
                @endguest
            </div>
        </div>
    </body>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</html>
