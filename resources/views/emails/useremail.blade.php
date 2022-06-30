<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AED</title>
</head>
<body>
    <h2>AED-SUIVI</h2>

    <p>Salut, {{ $data['nomuser'] }} {{ $data['prenomuser'] }}</p>
    <p>Vous êtes enregistré(e) avec le mail : {{ $data['email'] }}</p>
    <p>{{ $data['message'] }} {{ $data['password'] }}</p>
    <p> <a href="https://odl.aed-ifad.tg/"> Cliquer ici pour accéder à la plateforme </a> </p>
    <br>
    <p>Ceux-ci est un mail qui a été envoyé automatiquement merci de ne pas répondre</p>
</body>
</html>
