<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doc;
use App\Dv;

class DocController extends Controller
{
    public function index(){
        $docs= \DB::table('docs')->get();

        return view('finance.required_documents',['doc'=>$docs]);
    }
    public function store(Request $request){
        $desc = $request->input('req_doc');
        $modal = new Doc();
        $modal->description = $desc;
        $modal->save();
         return redirect('docs');
       
       
    }

    public function delete($docId){
      
        \DB::table('docs')->where('id', '=', $docId)->delete();

        return redirect('docs');
    }

    public function addLackingDocs($dvId){
        $valdoc[] = '';
        $dv_val = $dvId;
        $docs= \DB::table('docs')->get();
        $dv_doc = Dv::with('docs')->where('id',$dv_val)->get();
        
        foreach ($dv_doc as $dvdoc) {
          $dv_detail = $dvdoc;
            foreach ($dvdoc->docs as $lackdoc) {
             $valdoc[] = $lackdoc->description; 
            }
        }
      
   
        return view('finance.add_lacking_document',['documents'=>$docs,'dv_val'=>$dv_val,'valdocas'=>$valdoc,'dv_detail'=> $dv_detail],[],[]);
    }

    public function addingLackingDocs(Request $request){
        $dvId = $request->input('dv_id');
        $docId = $request->input('docId');

        $idDv = Dv::where('id', $dvId)->firstOrFail(); 
        $idDv->docs()->detach();
        $idDv->docs()->attach($docId);
       return redirect('dv/lacking-documents/'.$dvId);
    }
}
