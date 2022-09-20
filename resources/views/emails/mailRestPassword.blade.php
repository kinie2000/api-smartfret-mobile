<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style>
    
    .button1 {
        background-color: white; 
        color: black; 
        border: 2px solid #176ee0;
        font-size: 20px
        }

        .button1:hover {
        background-color: #176ee0;
        color: white;
        }
        .lien1{
            text-decoration: none;
            color:black;
            font-family:serif
        }
        .lien1:hover{
            text-decoration: none;
            color:white;
        }
</style>
</head>
<body style="background: #F5F5F5; padding: 30px;" >

<div style="max-width: 400px; margin: 0 auto; padding: 20px; background: #fff; font-size: 1.5em;">
   
    <div>
    <img src="{{$message->embed('storage/logo.png')}}" width="100px" style="margin-left:150px">
        <h5 style="text-align: center;margin-top:-5px; color:rgb(51, 51, 49)">SMARTFRET TRANSPORT</h5>    
    </div>
	<div>
    <p style="color:rgb(51, 51, 49)">Hey {{$data['name']}}!</p>
    <p style="font-size:17px;font-family:serif;color:rgb(51, 51, 49)">Afin de réunitialiser votre mots de passe,
        veillez saisir le code validation sur votre appareil
    </p>
    <p style="font-size:17px;font-family:serif;color:rgb(51, 51, 49)">
        Code de validation: {{$data['code']}}
    </p>
    <p>
        Merci !!! <br>
    </p>
</div>

</body>
</html>
