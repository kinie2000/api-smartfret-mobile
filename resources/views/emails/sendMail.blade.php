<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body style="background: #F5F5F5; padding: 30px;" >

<div style="max-width: 400px; margin: 0 auto; padding: 20px; background: #fff; font-size: 1.5em;">
	<h1>Bonjour Mr/Mme {{$data['NameCustomer']}} {{$data['SurnameCustomer']}} ,</h1>
	<div>
        Votre bon de commande vient d'être {{$data['message']}}.<br><br>
        <a href="https://play.google.com/store/apps/details?id=com.smartfret.mobileSmartfret">Connectez vous</a> pour mieux visualiser les informations du bon de commande.

    </div><br>
    <div>Merci pour votre confiance.</div><br>
    <div>
        <h1 style="font-size: 1em"><img src="{{$message->embed('storage/logo.png')}}">SMART FRET TRANSPORT</h1>
    </div>
</div>

</body>
</html>
