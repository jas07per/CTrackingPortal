<?php

namespace App\Http\Controllers;
use App\Dv;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Sheets;
use PulkitJalan\Google\Facades\Google;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
class DvController extends Controller
{
    public function index(){
   
        $idDv = array();
        $users = User::with('roles')->get();
        $dvs = User::with('dvs')->get();
        $dvusers = User::has('dvs')->get();
      //  $users = $users->diff(User::whereIn('id', [1, 2, 3])->get());
      
    

        foreach ($dvs as $fdv) {
             
     
            foreach ($fdv->dvs as $dv) {

                $idDv[] = $dv->id;
         
            }     
        }
        $payees =  Dv::whereNotIn('id',$idDv)->get();
     
        return view('finance.index',['users'=>$users],['payees'=>$payees,'dvusers'=> $dvusers ]);
      
    }

    public function voucher_list(Request $request){
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
        // dd($values);
        //        return view('home',compact('values')); 
        //end get excel values
        $dvs = Dv::all();

        return view('finance.dv',['dvs'=>$dvs,'values'=>$values]);
    }

    public function attach(Request $request){
        $userId = $request->input('userid');
        $payee = $request->input('payee');

            // $user = User::where('id',$userId)->firstOrFail(); 
            // $dvPayees = Dv::where('payee',$payee)->get();
            $user = User::firstOrNew(['id' => $userId])->where('id',$userId)->firstOrFail(); 
            $dvPayees = Dv::firstOrNew(['payee' => $payee])->where('payee',$payee)->get();
            
              foreach ($dvPayees as $dvPayee) {
                 $user->dvs()->attach($dvPayee->id);
              }

              return redirect('dv/attach');
  
    }
    public function attachSingle(Request $request){
        $userId = $request->input('userid');
        $dvnumber = $request->input('payee');

            // $user = User::where('id',$userId)->firstOrFail(); 
            // $dvPayees = Dv::where('payee',$payee)->get();
            $user = User::firstOrNew(['id' => $userId])->where('id',$userId)->firstOrFail(); 
            $dvPayees = Dv::firstOrNew(['dv_number' =>  $dvnumber])->where('dv_number',$dvnumber)->get();
            
              foreach ($dvPayees as $dvPayee) {
                 $user->dvs()->attach($dvPayee->id);
              }

            return redirect('dv/attach');
  
    }
    public function addDv(Request $request){
        $cy = $request->input('cy');
        $datedv = $request->input('datedv');
        $dvnum = $request->input('dvnum');
        $payee = $request->input('payee');
        $nop = $request->input('nop');
        $netamount = $request->input('netamount');
        $vat = $request->input('vat');
        $grossamount = $request->input('grossamount');
        $mobligated = $request->input('mobligated');
        $dobligated = $request->input('dobligated');
        $allclass = $request->input('allclass');
        $ors = $request->input('ors');
        $uacs = $request->input('uacs');
        $adesc = $request->input('adesc');
        $monthissued = $request->input('monthissued');
        $dcheck = $request->input('dcheck');
        $cnumber = $request->input('cnumber');
        $newDatedatedv = date("Y-m-d", strtotime($datedv)); 
        $newDatedobligated = date("Y-m-d", strtotime($dobligated)); 
        $newDatedcheck = date("Y-m-d", strtotime($dcheck)); 
        $xnetamount = str_replace( ',', '', $netamount); $xvat = str_replace( ',', '', $vat); $xgrossamount = str_replace( ',', '', $grossamount);
        if( $xnetamount == ''){$xnetamount =  NULL; } 
        if(  $xvat == ''){ $xvat = NULL;  } 
        if(  $xgrossamount==''){$xgrossamount= NULL; } 
        if(  $newDatedatedv == '1970-01-01'  ){ $newDatedatedv  = NULL;  }  
        if(  $newDatedobligated == '1970-01-01' ){$newDatedobligated= NULL;  }  
        if(  $newDatedcheck=='1970-01-01' ){$newDatedcheck= NULL; }  
   
        $data[] = array('cy' =>  $cy,'dv_date' => $newDatedatedv,'dv_number' => $dvnum,'payee' => $payee,'nop' => $nop,'net_amount' =>  $xnetamount,'vat' => $xvat,'gross_amount' => $xgrossamount,'month_obligated' => $mobligated,'date_obligated' => $newDatedobligated,'allotment_class' => $allclass,'ors_no' => $ors,'uacs_obj_code' => $uacs,'account_desc' =>  $adesc,'month_check_issued' =>  $monthissued,'check_date' => $newDatedcheck,'check_no' => $cnumber,'created_at' => Carbon::now(), 'updated_at' => Carbon::now());
        Dv::insert($data);
        return redirect('dv');
    }
    

    public function upload_dv(Request $request)
    {
        $file = $request->file('file_upload');
        // $training_id = $request->input('training_id');
        //$extension = $file->extension();
        //$path = $file->getRealPath();
        $reader = IOFactory::createReader("Xlsx");
        $spreadsheet = $reader->load($file);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();
        $data = array();
        $count = 0;
        $error_count = 0;
        $error_rows = "";
        $success_count = 0;
        $updated_count = 0;
        foreach ($rows as $row) {
    
            if ($count != 0) {
       
                //if participant is already in the database
                $check = Dv::where(['dv_number' => $row[2]]);
          
              
                if ($check->exists()) {
                  
                    Dv::where(['dv_number' => $row[2]])->update(['cy' => $row[0],'dv_date' => $row[1],'payee' => $row[3],'nop' => $row[4],'net_amount' => $row[5],'vat' => $row[6],'gross_amount' => $row[7],'month_obligated' => $row[8],'date_obligated' => $row[9],'allotment_class' => $row[10],'ors_no' => $row[11],'uacs_obj_code' => $row[12],'account_desc' => $row[13],'month_check_issued' => $row[14],'check_date' => $row[15],'check_no' => $row[16], 'updated_at' => Carbon::now()]);
             
              
                    if ($error_count == 0) {
                        $error_rows .= "<table class='table table-striped table-hover table-bordered'><tr>
                            <td>DV NUMBER</td>
                           
                        </tr>";
                    }
                    $error_count++;
                    $error_rows .= "<tr>
                        <td>" . $row[2] . "</td>
                       
                        </tr>";
                } else {
                    $success_count++;
                 
                    $data[] = array('cy' => $row[0],'dv_date' => $row[1],'dv_number' => $row[2],'payee' => $row[3],'nop' => $row[4],'net_amount' => $row[5],'vat' => $row[6],'gross_amount' => $row[7],'month_obligated' => $row[8],'date_obligated' => $row[9],'allotment_class' => $row[10],'ors_no' => $row[11],'uacs_obj_code' => $row[12],'account_desc' => $row[13],'month_check_issued' => $row[14],'check_date' => $row[15],'check_no' => $row[16],'created_at' => Carbon::now(), 'updated_at' => Carbon::now());
                }
            }
            $count++;
        }
      
     
        

        if ($error_count != 0) {
            $error_rows .= "</table>";
        }
      
        if (Dv::insert($data)) {
            $return = "<p class='text-success'>Success : " . $success_count ."</p>";
            $return .= "<p class='text-danger'>Duplicate : " . $error_count . "</p>";
            $return .= $error_rows;
            return $return;
        }
    }
}
