<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Purchase_order;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'user_surname',
        'user_mail',
        'user_phone',
        'user_adress',
        'user_other_adress',
        'user_city',
        'user_country',
        'password',
        'user_profil',
        'user_status',
        'user_picture',
        'agency_id',
        'user_objectif',
        'code_postal'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
       'user_password',
        'remember_token',
    ];

     public static function  createUser($data,$name)
    {
        $date=date('Y');
       //dd($data);
        $user=User::create([
            'user_name' => $data['nom'],
            'user_surname' => $data['prenom'],
            'user_mail' => $data['email'],
            'user_phone' => $data['user_phone'],
            'user_adress' => $data['adresse'],
            'user_other_adress' => $data['adresse2'],
            'user_city' => $data['ville'],
            'user_country' => $data['pays'],
            'password' => Hash::make($data['pass']),
            'user_profil' => $data['role'],
            'user_status' => "Actif",
            'user_picture' => $name,
            'agency_id' => $data['agence'],
            'code_postal'=>$data['codepost']
        ]);

        if($data['objectif'] != 0)
        {
            User_objectif::create([
                'user_objectifs_value'=>$data['objectif'],
                'user_id'=>$user->id
            ]);

        }

        if($data['role']=="SUPERADMINISTRATEUR")
        {
            $permissions=Permission::all();
            if($permissions->isEmpty())
            {
                Permission::create_permissions();
                $permissions=Permission::all();
                for ($i=0; $i < count($permissions) ; $i++) {
                    Permission_user::create([
                        'user_id'=>$user->id,
                        'permission_id'=>$permissions[$i]->id
                    ]);
                }
            }
            else {
                for ($i=0; $i < count($permissions) ; $i++) {
                    Permission_user::create([
                        'user_id'=>$user->id,
                        'permission_id'=>$permissions[$i]->id
                    ]);
                }
            }
        }
        return $user;

    }

    public static function  updateUser($data,$name,$id)
    {

        $val=  User::find($id)->update([
            'user_name' => $data['nom'],
            'user_surname' => $data['prenom'],
            'user_mail' => $data['email'],
            'user_phone' => $data['user_phone'],
            'user_adress' => $data['adresse'],
            'user_other_adress' => $data['adresse2'],
            'user_city' => $data['ville'],
            'user_country' => $data['pays'],
            'code_postal'=> $data['codepost'],
            'user_profil' => $data['role'],
            'user_status' => "Actif",
            'user_picture' => $name,
            'agency_id' => $data['agence']
        ]);

        User_objectif::where('user_id',$id)->update([
            'user_objectifs_value'=>$data['objectif']
        ]);
        // $user = ['activity_description' => 'L\'utilisateur a Modifié les infomations du compte appartenant à', 'activity_identified' => $data['nom'].' '.$data['prenom'], 'user_id' => Auth::user()->id];
        // Activity::create($user);
            return $val;
    }

    protected static function upuser($request,$id)
    {
        //dd($request);
        $data = $request->validate([
            'nom' => ['required', 'string', 'max:20'],
            'prenom' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email'],
            'adresse' => ['string', 'max:50'],
            'adresse2' => ['string', 'max:50'],
            'ville' => ['required', 'string', 'max:20'],
            'pays' => ['required'],
            'agence' => ['required'],
            'role' => ['required'],
            'codepost' => ['required'],
            'file' => ['mimes:jpeg,png', 'max:1024'],
        ],
        [
            'nom.required'=>'Champs requis',
            'nom.string'=>'Veillez entre des caractères alpha_numériques',
            'nom.max'=>'Saisir une valeur de 20 caractères au maximun',
            'prenom.required'=>'Champs requis',
            'prenom.string'=>'Veillez entre des caractères alpha_numériques',
            'prenom.max'=>'Saisir une valeur de 20 caractères au maximun',
            'email.required'=>'Champs requis',
            'email.string'=>'Veillez entre des caractères alpha_numériques',
            'email.email'=>'Veillez entrer une une adresse email correcte(ex:xxxx@xxxx.xxx)',
            'adresse.string'=>'Veillez entre des caractères alpha_numériques',
            'adresse.max'=>'Saisir une valeur de 50 caractères au maximun',
            'adresse2.string'=>'Veillez entre des caractères alpha_numériques',
            'adresse2.max'=>'Saisir une valeur de 50 caractères au maximun',
            'ville.required'=>'Champs requis',
            'ville.max'=>'Saisir une valeur de 50 caractères au maximun',
            'ville.string'=>'Veillez entre des caractères alpha_numériques',
            'pays.required'=>'Champs requis',
            'agence.required'=>'Champs requis',
            'role.required'=>'Champs requis',
            'codepost.required'=>'Champs requis',
            'file.mimes'=>'Le fichier doit correspondre à une image avec pour extension .jpeg ou .png',
            'file.max'=>'Le fichier doit avoir une taille de 1Mo au maximun',
        ]);

        if($data['role'] == "MODERATEUR")
        {
            $dat = $request->validate(
                [
                'objectif' => ['digits_between:0,12']
                ],
                [
                 'objectif.numeric'=>'Veillez entrer une valeur numérique'
                ]
                );
            $data= array_merge($data,$dat);
        }
        else {
            $data['objectif']=0;
            array_merge($data,['objectif'=>0]);
        }

        $user = User::where('id', $id)->get();

        if ($request['user_phone'] != $user[0]->user_phone) {
            $data['user_phone'] = $request->validate([
                'user_phone' => ['required', 'string', 'unique:users'],
            ]);
        }
        else {
            $data['user_phone']= $user[0]->user_phone;
        }

        if ($request->hasFile('file') ) {

            //verification des données envoyées
            //recupération du nom de du fichier
            if($request->file('file')->isValid())
            {
                $name = $request->file->getClientOriginalName();
            //enregistre le fichier en question dans le disk de stockage
                $request->file->storeAs('/public', $name);
                //$user=User::Create()
                //dd($data);
                $val = User::updateUser($data,$name,$id);

                    return  $val;
            }

        } else {

            $val = User::updateUser($data,$user[0]->user_picture,$id);

                return $val;
        }
    }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     public function Allcountries()
    {
        return ["Afrique du sud","Allemand","Angleterre","Brazil","Canada","Cameroun","Congo","Chine","France","Gabon","Inde","Maroc","Mexique","Monaco","Tunisie"];

    }

     public function purchase_order()
    {
        return $this->hasMany(purchase_order::class);
    }
}
