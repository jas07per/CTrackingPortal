<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }
    public function userManagement(){
        $users = User::with('roles')->get();

        return view('admin.usermanagement',['users'=>$users]);
    }
    public function addAdmin($userId){
      $user = User::where('id',$userId)->firstOrFail(); 
      $adminRole = Role::where('name','admin')->firstOrFail();
      $guestRole = Role::where('name','guest')->firstOrFail();
      $user->roles()->detach($guestRole->id);
      $user->roles()->attach($adminRole->id);

      return redirect('user-management');
    }
    public function removeAdmin($userId){
       $user = User::where('id',$userId)->firstOrFail();
      
      $adminRole = Role::where('name','admin')->firstOrFail();

      $user->roles()->detach($adminRole->id);

      return redirect('user-management');      
    }

    public function addFinance($userId){
        $user = User::where('id',$userId)->firstOrFail(); 
        $adminRole = Role::where('name','finance')->firstOrFail();
        $guestRole = Role::where('name','guest')->firstOrFail();
        $user->roles()->detach($guestRole->id);
        $user->roles()->attach($adminRole->id);
  
        return redirect('user-management');
      }
      public function removeFinance($userId){
         $user = User::where('id',$userId)->firstOrFail();
         $adminRole = Role::where('name','finance')->firstOrFail();
        
        $user->roles()->detach($adminRole->id);
  
        return redirect('user-management');      
      }

      public function addUser($userId){
        $user = User::where('id',$userId)->firstOrFail(); 
        $adminRole = Role::where('name','user')->firstOrFail();
        $guestRole = Role::where('name','guest')->firstOrFail();
        $user->roles()->detach($guestRole->id);
        $user->roles()->attach($adminRole->id);
        
        return redirect('user-management');
      }
      public function removeUser($userId){
        $user = User::where('id',$userId)->firstOrFail();
        $adminRole = Role::where('name','user')->firstOrFail();
        $guestRole = Role::where('name','guest')->firstOrFail();
       $user->roles()->detach();
       $user->roles()->attach($guestRole->id);
       return redirect('user-management');      
     }
 
}
