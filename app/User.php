<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'password', 'remember_token',
    ];

    /**
     * get user by id
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function getUserById($id)
    {
        $user = DB::table('user')->where('id', $id)->first();
        return $user;
    }

    /**
     * get all activate users object in array
     *
     * @return array
     */
    public function getAllUser()
    {
        $users = DB::select('select * from user where activate = ?', array('1'));
        return $users;
    }

    /**
     * @array $user
     * @return string
     */
    public function addUser($user)
    {
        DB::table('user')->insert($user);
        return true;
    }

    public function updateUser($user)
    {
        DB::table('user')
          ->where('id', $user['id'])
          ->update($user);
        return true;
    }
}
