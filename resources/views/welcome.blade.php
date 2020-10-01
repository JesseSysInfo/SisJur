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

            #card-nova-senha {
                display: none;
            }

        </style>
    </head>
    <body>
        <div class="container">

            <div class="content">
            
                <div class="title m-b-md">
                    {{ config('app.name', 'SisJuri') }} <br>
                    <img width="100" height="100" src="{{ asset('images/justica.png') }}" class="mb-3" alt="">
                </div>

                        @guest
                        <div class="card col-md-8 m-auto" id="card-login">            
                            
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
                                            <br>
                                            <button type="button" class="btn btn-link mt-3" onclick="changeCards();" >
                                                Esqueci minha senha.
                                            </button>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card col-md-8 m-auto" id="card-nova-senha">
                            <div class="card-body">
                                <div class="card-header">Recuperar senha</div>
                                <div class="form-group row mt-2">
                                    <label for="reset-email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                                    <div class="col-md-6">
                                        <input id="reset-email" type="email" class="form-control" name="reset-email" value="" required autocomplete="reset-email" autofocus>
                                    </div>
                                </div>
                                
                                <div>
                                    <button class="btn btn-primary" onclick="resetarSenha();" id="btn-enviar">Enviar</button>
                                    <button class="btn btn-secondary" onclick="changeCards();">Cancelar</button>
                                </div>
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
       
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script>

    var card_nova_senha = $("#card-nova-senha");
    var card_login = $("#card-login");
    var show_card_senha = false;
    

    function showCardSenha(show_card_senha)
    {
        if(show_card_senha == true)
        {
            card_nova_senha.show();
            card_login.hide();
        }
        else
        {
            card_nova_senha.hide();
            card_login.show();
        }
    }

    function changeCards(){
        show_card_senha = !show_card_senha;
        $("#reset-email").val("");
        showCardSenha(show_card_senha);
    }

    function resetarSenha()
    {
        var reset_email = $("#reset-email").val();
        var btn_alterar_senha = $("#btn-enviar");
        if(reset_email == "")
        {
            Swal.fire('Informe seu E-mail');
        }
        else
        {
            var _url = '/senha/resetar/'+reset_email;
            btn_alterar_senha.prop('disabled', true);
            btn_alterar_senha.text('aguarde...');
            $.ajax({
                type: 'GET',
                url: _url,
                dataType: 'json',
                success: function(data){
                    btn_alterar_senha.prop('disabled', false);
                    btn_alterar_senha.text('Alterar senha');
                    Swal.fire(
                    'Atenção!',
                    data['msg'],
                    'info'
                    );

                    changeCards();
                }, 
                error: function(){
                    btn_alterar_senha.prop('disabled', false);
                    btn_alterar_senha.text('Alterar senha');
                    Swal.fire(
                    'Atenção!',
                    'Ocorreu um erro ao tentar alterar a senha.',
                    'error'
                    );
                }
            });
        }

    }
    
    </script>
</html>
