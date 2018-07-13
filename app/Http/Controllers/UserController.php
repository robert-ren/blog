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
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;


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
            return view('user', array('user' => $user));
        }
        return view('user');
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

    /**
     * custom the validator
     *
     * @param array $data
     * @param null $message
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validatorRegister(array $data, $message = null)
    {
        return Validator::make($data, [
          'first_name' => 'required|string|max:255',
          'last_name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:user',
          'password' => 'required|string|min:6|confirmed',
          'password_confirmation' => 'required|same:password'
        ], $message);
    }

    /**
     * custom update user validator
     *
     * @param array $data
     * @param null $message
     * @param null $id
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validatorUpdate(array $data, $message = null, $id = null)
    {
        return Validator::make($data, [
          'first_name' => 'required|string|max:255',
          'last_name' => 'required|string|max:255',
          'email' => ['required', Rule::unique('user')->ignore($id)]
        ], $message);
    }

    /**
     * custom update pasword validator
     *
     * @param array $data
     * @param null $message
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validatorPassword(array $data, $message = null)
    {
        $rules = array(
          'old_password' => 'required|string|min:6',
          'password' => 'required|string|min:6|different:old_password',
          'password_confirmation' => 'required|same:password'
        );
        return Validator::make($data, $rules, $message);
    }

    /**
     * custom the message array
     *
     * @return array
     */
    public function messages()
    {
        return [
          'email.required' => 'You must input email',
          'email.unique' => 'Duplicated User!',
          'password.required' => 'You must input password',
          'password_confirmation.same' => 'Input password is not same',
          'old_password.different' => 'New password should not same with Old password',
        ];
    }

    public function create(Request $request)
    {
        $currentTime = new \DateTime();

        $this->validatorRegister($request->all(), $this->messages())->validate();

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

        $users = $this->user_mode->getAllUser();
        if ($this->user_mode->addUser($user)) {
            $users = $this->user_mode->getAllUser();
        };
        return view('userList', array('users' => $users));
    }

    public function update(Request $request, $id)
    {
        $currentTime = new \DateTime();

        $this->validatorUpdate($request->all(), $this->messages(), $id)->validate();

        $user = array(
          'id' => $id,
          'title' => $request->title,
          'first_name' => $request->first_name,
          'last_name' => $request->last_name,
          'email' => $request->email,
          'username' => $request->email,
          'gender' => $request->gender,
          'activate' => $request->activate,
          'updated_at' => $currentTime
        );

        $users = $this->user_mode->getAllUser();
        if ($this->user_mode->updateUser($user)) {
            $users = $this->user_mode->getAllUser();
        };
        return view('userList', array('users' => $users));
    }

    public function updatePassword(Request $request, $id)
    {
        $currentTime = new \DateTime();

        $user = $this->user_mode->getUserById($id);

        // verify the new password and re-type new password
        $this->validatorPassword($request->all(), $this->messages())->validate();

        $rules = array('old_password' => 'required');
        $validator = Validator::make($request->all(), $rules);

        if (!(Hash::check($request->get('old_password'), $user->password))) {
            $validator->getMessageBag()->add('old_password', 'Password is invalid');
            return redirect()->back()->withErrors($validator);
        }

        $user = array(
          'id' => $id,
          'password' => Hash::make($request->password),
          'updated_at' => $currentTime
        );
        if ($this->user_mode->updateUser($user)) {
            return redirect()->back()->with('success', 'Password updated successfully');
        };
        return redirect()->back()->withErrors($validator);
    }
}