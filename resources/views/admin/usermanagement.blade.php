@extends('layouts.app')

@section('content')
<div class="container">
   <h3>User Management</h3>
   <table class="table">
       <thead>
           <tr>
               <th>Name</th>
               <th>Email</th>
               <th>Role /s</th>
               <th>Action</th>
           </tr>
       </thead>
       <tbody>
        @foreach ($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                        @foreach ($user->roles as $role)
                        <small>{{$role->name}}</small><br>
                        @endforeach
                          </td>
                        <td>
                            @if ($user->id!=Auth::user()->id)
                                    @if ($user->hasRole('admin'))
                                    <a class="btn btn-danger" href="/admin/remove-admin/{{$user->id}}">Remove Admin Permission</a>
                                @else
                                    <a class="btn btn-primary" href="/admin/add-admin/{{$user->id}}">Add Admin Permission</a>
                                @endif   
                            @endif
                          
                            @if ($user->hasRole('finance'))
                            <a class="btn btn-warning" href="/admin/remove-finance/{{$user->id}}">Remove Finance Permission</a>
                            @else
                            <a class="btn btn-success" href="/admin/add-finance/{{$user->id}}">Add Finance Permission</a>
                       
                            @endif
                            @if ($user->hasRole('user'))
                            <a class="btn btn-warning" href="/admin/remove-user/{{$user->id}}">Remove User Permission</a>
                            @else
                            <a class="btn btn-success" href="/admin/add-user/{{$user->id}}">Add User Permission</a>
                       
                            @endif

                        </td>
                    </tr>
        @endforeach
        
       
       </tbody>
   </table>
 

</div>
@endsection

