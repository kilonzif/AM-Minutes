<?php

namespace App\Http\Controllers;

use App\Classes\ToastNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Users List
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        $users = User::all();
        return view('users.index', compact('users'));
    }


    /**
     * User create view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        return view('users.create');
    }



    /**
     * Save new a user
     *
     * @return \Illuminate\Http\Response
     */
    public function saveUser(Request $request){

        $this->validate($request, [
            'name' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string|min:1',
            'profile_picture' => 'nullable|file|mimes:png,jpeg,jpg',
        ]);
        $destinationPath = base_path() . '/public/ProfilePictures/';

        $profile_file = $request->file('profile_picture');


        if (isset($profile_file)) {
            $profile_file->move($destinationPath, $profile_file->getClientOriginalName());
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->email);
        $user->role = $request->role;
        $user->profile_picture = $profile_file->getClientOriginalName();

        $user->remember_token = substr(Crypt::encrypt($request->email), 0, 30);


        $saved= $user->save();

        if(!$saved) {
            notify(new ToastNotification('Error!', 'Failed to add a user!', 'error'));
            return back()->withInput();
        }
        notify(new ToastNotification('Successful!', 'New user added!', 'success'));
        return back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */

    public function editUser(Request $request){
        $id = Crypt::decrypt($request->id);
        $user = User::find($id);
        $view = view('users.edit-view',compact('user'))->render();

        return response()->json(['theView'=>$view]);

    }


    /**
     * Update a user
     *
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request){

        $id = Crypt::decrypt($request->id);
        $this->validate($request, [
            'name' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|string|email|max:255',
            'role' => 'required|string|min:1',
        ]);

        $user = User::find($id);
        $profile_file = $request->file('profile_picture');
        $destinationPath = base_path() . '/public/ProfilePictures/';

        if (isset($profile_file)) {
            $profile_file->move($destinationPath, $profile_file->getClientOriginalName());
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'profile_picture' => $profile_file->getClientOriginalName(),
        ]);

        notify(new ToastNotification('Successful!', 'User Updated!', 'success'));
        return back();
    }


    /**
     * Saves the new password.
     *
     * @return \Illuminate\Http\Response
     */
    public function savePassword(Request $request,$id)
    {
        $this->validate($request,[
            'password' => 'required|string|min:6|confirmed'
        ]);
        $user = User::find(Crypt::decrypt($id));
        $user->password = Hash::make($request->password);
        $user->save();
        notify(new ToastNotification('Successful!', 'Password Changed!', 'success'));
        return back();
    }

    /**
     * Activation of User Account.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteUser($id){
        $user = User::find(Crypt::decrypt($id));
        $user->delete();
        notify(new ToastNotification('Successful!', 'User Deleted!', 'success'));
        return back();

    }


    public function userProfile($id){
        $user = User::find(Crypt::decrypt($id));
        return view('users.user_profile',compact('user'));
    }



}
