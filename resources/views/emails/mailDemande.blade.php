<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body style="background: #F5F5F5; padding: 30px;">

   
        <div style="margin: 0 auto; padding: 20px; background: #fff; font-size: 1.5em;">

            <div style="text-align: center;">
                <img src="{{$message->embed('storage/logo_2.png')}}" width="100px"><br>
                <span style="text-align: center;margin-top:-5px; color:rgb(51, 51, 49);font-size:0.7em;font-weight:bolder">SMART FRET TRANSPORT</span><br>
                <span style="text-align: center;margin-top:-50px; color:rgb(51, 51, 49); font-size:14px">Transport &
                    Logistique</span>
            </div>
            <div style="padding:10px" class="message">
                @if ($data['demande']=="appel")
                    <p style="text-align: center;font-size: 16px;color:rgb(51, 51, 49);">Heyyy <br>le numéro {{$data['number']}} demande a être
                        appelé!
                    </p>
                @elseif ($data['demande']=="emballage")
                    <p style="text-align: center;font-size: 14px;color:rgb(51, 51, 49);">
                        Heyyy !<br> Une demande 
                        @if($data['nombreEmballage'] >1) 
                            de {{$data['nombreEmballage']}} Emballages 
                        @else 
                            d'emballage 
                        @endif 
                    </p>
                    <p style="text-align: center;font-size: 16px;color:rgb(51, 51, 49);">
                        <span><strong>Info du client</strong> </span>
                        <div style="overflow-x:auto;">
                            <table
                                style="font-size: 15px;margin-left: auto;margin-right: auto;border: 1px solid  #ddd;border-collapse: collapse;width: 100%;">
                                <thead>
                                    <th style="border: 1px solid  #ddd;padding: 10px;">Client</th>
                                    <th style="border: 1px solid  #ddd; padding: 10px;">{{$data["nom"]}}</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th style="border: 1px solid  #ddd; padding: 10px;">Tel</th>
                                        <td style="border: 1px solid  #ddd; padding: 10px;">{{$data["tel"]}}</td>
                                    </tr>
                                    <tr>
                                        <th style="border: 1px solid  #ddd; padding: 10px;">Mail</th>
                                        <td style="border: 1px solid  #ddd; padding: 10px;">{{$data["mail"]}}</td>
                                    </tr>
                                    <tr>
                                        <th style="border: 1px solid  #ddd; padding: 10px;">Adresses</th>
                                        <td style="border: 1px solid  #ddd; padding: 10px;">{{$data["adresse"]}}</td>
                                    </tr>
                                    <tr>
                                        <th style="border: 1px solid  #ddd; padding: 10px;">Pays/ville</th>
                                        <td style="border: 1px solid  #ddd; padding: 10px;">{{$data["pays"]}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </p>
                @elseif ($data['demande']=="enlevement")
                    <p style="text-align: center;font-size: 14px;color:rgb(51, 51, 49);">
                        Heyyy demande d'un retrait'!<br>
                    </p>
                    <p style="text-align: center;font-size: 16px;color:rgb(51, 51, 49);">
                        <span><strong>Info du retrait</strong> </span>
                        <div style="overflow-x:auto;">
                            <table
                                style="font-size: 15px;margin-left: auto;margin-right: auto;border: 1px solid  #ddd;border-collapse: collapse;width:50%;">
                                <thead>
                                    <th style="border: 1px solid  #ddd;padding: 10px;">Client</th>
                                    <th style="border: 1px solid  #ddd; padding: 10px;">{{$data["nom"]}}</th>
                                </thead>
                                <tbody>
                                     <tr>
                                        <th style="border: 1px solid  #ddd; padding: 10px;">date du Retrait</th>
                                        <td style="border: 1px solid  #ddd; padding: 10px;">{{$data["dateRetrait"]}}</td>
                                    </tr>
                                     <tr>
                                        <th style="border: 1px solid  #ddd; padding: 10px;">Heure du Retrait</th>
                                        <td style="border: 1px solid  #ddd; padding: 10px;">{{$data["heureRetrait"]}}</td>
                                    </tr>
                                     <tr>
                                        <th style="border: 1px solid  #ddd; padding: 10px;">Description de l'enlèvement </th>
                                        <td style="border: 1px solid  #ddd; padding: 10px;">{{$data["descriptionRetrait"]}}</td>
                                    </tr>
                                     <tr>
                                        <th style="border: 1px solid  #ddd; padding: 10px;">Adresse</th>
                                        <td style="border: 1px solid  #ddd; padding: 10px;">{{$data["adresseRetrait"]}}</td>
                                    </tr>
                                    <tr>
                                        <th style="border: 1px solid  #ddd; padding: 10px;">Tel</th>
                                        <td style="border: 1px solid  #ddd; padding: 10px;">{{$data["telephoneRetrait"]}}</td>
                                    </tr>
                                    <tr>
                                        <th style="border: 1px solid  #ddd; padding: 10px;">Mail</th>
                                        <td style="border: 1px solid  #ddd; padding: 10px;">{{$data["mail"]}}</td>
                                    </tr>                                 
                                </tbody>
                            </table>
                        </div>
                    </p>
                @endif
                
            </div>
            <div style="text-align:center; font-size:15px; margin-bottom: 20px;">
                Cet e-mail est destinée <br> au service client de Smart Fret Transport.
            </div>
            <div style="text-align:center; font-size:10px">
                Copyright © 2022 Transport & Logistique <br>
                SMARTFRET TRANSPORT/ All rights reserved<br>
                (+33)0139157553 info@smartfret.com
            </div>
        </div>
   
</body>

</html>