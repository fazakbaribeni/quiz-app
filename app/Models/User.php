<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'phone'
    ];
    private $limit = 10;
    private $order = "DESC";

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * @param $data
     * @return mixed
     */
    public function storeUser($data){

        $data['password'] = bcrypt($data['password']);
        return User::create($data);

    }

    /**
     * @param $data
     * @return mixed
     */
    public function updateUser($data, $id){

        $user = User::find($id);
        $data['password'] = bcrypt($data['password']);
        return User::create($data);

    }


    /**
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllUsers(){

        return User::orderBy('created_at',$this->order)
            ->paginate($this->limit);

    }


    /**
     * @param $id
     * @return mixed
     */
    public function getUserByID($id){

        return User::find($id);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function deleteUser($id){

        return  User::find($id)->delete();

    }

}
