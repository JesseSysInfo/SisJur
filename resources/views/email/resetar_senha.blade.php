<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[ {{ config('app.name', 'SisJur') }} ] - Alterar Senha</title>

</head>
<body>
   <h2>{{ $details['title'] }}</h2> 
   <p>{{ $details['body'] }}</p>
   <div style="font-size: 18px;">
       <a href="{{ $details['btn_link_alterar'] }}">Alterar minha senha</a> 
   </div>
   <p>Atensionamente, {{ config('app.name', 'SisJur') }}</p>
</body>
</html>