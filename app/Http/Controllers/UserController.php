<?php
/**
 * Created by PhpStorm.
 * User: robertren
 * Date: 2/7/18
 * Time: 4:16 PM
 */

namespace App\Http\Controllers;

use App\Flight;
use Faker\Provider\DateTime;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        return view('welcome');
    }

    public function getUserList()
    {
        // find all users
        $users = $this->user_mode->getAllUser();
        if (!empty($users)) {
            return view('userList', array('users' => $users));
        }
        return view('userList', array('users' => array()));
    }

    public function create()
    {
        return view('userList');
    }

    /**
     * custom the validator
     *
     * @param array $data
     * @param null $message
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data, $message = null)
    {
        return Validator::make($data, [
          'first_name' => 'required|string|max:255',
          'last_name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:user',
          'password' => 'required|string|min:6|confirmed',
        ], $message);
    }

    /**
     * custom the message array
     *
     * @return array
     */
    public function messages()
    {
        return [
          'email.required' => 'You must input email11',
          'email.unique' => 'Duplicated User!',
          'password.required' => 'You must input password22'
        ];
    }

    public function created(Request $request)
    {
        $currentTime = new \DateTime();

        $this->validator($request->all(), $this->messages())->validate();

        var_dump($request->all());
        die();

        $user = array(
          'title' => $request->title,
          'username' => $request->email,
          'email' => $request->email,
          'password' => Hash::make($request->password),
          'first_name' => $request->first_name,
          'last_name' => $request->last_name,
          'gender' => $request->gender,
          'activate' => 1,
          'created_at' => $currentTime,
          'updated_at' => $currentTime
        );


        if ($this->user_mode->addUser($user)) {
            $users = $this->user_mode->getAllUser();
            return redirect()->route('user_list', array('users' => $users));
        };
        $users = $this->user_mode->getAllUser();
        return view('userList', array('users' => $users));
    }
}