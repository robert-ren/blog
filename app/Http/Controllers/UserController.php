<?php
/**
 * Created by PhpStorm.
 * User: robertren
 * Date: 2/7/18
 * Time: 4:16 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
    protected $user_mode;

    public function __construct()
    {
        $this->user_mode = new User();
    }

    public function showProfile($id)
    {
        //find username by id
        $user = $this->user_mode->getUserById($id);
        if ($user) {
            return view('welcome', array('name' => sprintf('%s %s', $user->first_name, $user->last_name)));
        }
    }

    public function getUserList()
    {
        $users = $this->user_mode->getAllUser();
        if (!empty($users)) {
            return view('userlist', array('users' => $users));
        }
    }

    public function add(Request $request)
    {

        var_dump($name = $request->name);
        die();
        return $profile;
    }
}