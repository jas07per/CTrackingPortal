<?php

namespace App\Http\Controllers;
use Sheets;
use Illuminate\Http\Request;
use PulkitJalan\Google\Facades\Google;
use App\User;
use Auth;
use App\Dv;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        {
            $userid =  Auth::user()->id;
            $users = User::with('roles')->get();
            $dvs = User::with('dvs.docs')->where('id', $userid)->get();
            $dvcounts = Dv::all();
  
            // $lacking_docs = Dv::with('docs')->get();

                // getting values from excel
            $user = $request->user();
    
            $token = [
                'access_token'  => $user->access_token,
                'refresh_token' => $user->refresh_token,
                'expires_in'    => $user->expires_in,
                'created'       => $user->updated_at->getTimestamp(),
            ];
    
    // all() returns array
  
      $values = Sheets::spreadsheet('1iyeAWo3QnaoBCdPg6aoa_H1Atqmu0IT4bHcAqZNcvmU')->sheet('Sheet1')->all();

    //        return view('home',compact('values')); 
    //end get excel values



            return view('home',['users'=>$users,'dvs'=>$dvs],['dvcounts'=>$dvcounts,'values'=>$values]);
    // getting values from excel
    //         $user = $request->user();
            
    //         $token = [
    //             'access_token'  => $user->access_token,
    //             'refresh_token' => $user->refresh_token,
    //             'expires_in'    => $user->expires_in,
    //             'created'       => $user->updated_at->getTimestamp(),
    //         ];
    
    // // all() returns array
  
    //   $values = Sheets::spreadsheet('1iyeAWo3QnaoBCdPg6aoa_H1Atqmu0IT4bHcAqZNcvmU')->sheet('Sheet1')->all();
    //        return view('home',compact('values')); 
    //end get excel values
      }
    }
    public function download_excel_template()
    {
        return response()->download(public_path('dv_sample_template.xlsx'));
    }
  
}
