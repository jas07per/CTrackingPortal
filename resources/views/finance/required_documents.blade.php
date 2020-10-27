@extends('layouts.app')

@section('content')
<div class="container">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="btn-add-doc">Add Document Requirement</button>
   
   <table class="table">
       <thead>
           <tr>
               <th>#</th>
               <th>Required Document</th>
               <th>Action</th>
           </tr>
       </thead>
       <tbody>
           @foreach ($doc as $item)
             <tr>
                 <td>{{$item->id}}</td>
                 <td>{{$item->description}}</td>
                 <td><a href="docs/{{$item->id}}"><i class="fa fa-trash"></i></a></td>
             </tr>
           
           @endforeach
      
       </tbody>
   </table>
</div>
{{-- start modal add requirement --}}
<div class="modal fade" id="modal_add_doc" style="overflow: auto" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="modal_content_add">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_import_header">Import Disbursement Voucher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- form --}}
                <form  method="post" action="/docs">
                    @csrf 
          
                    <div class="form-group">
                        <label class="control-label">Required Document</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="req_doc" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-success">Save</button> 
                        </div>
                    </div>
                
              
                </form>
       
             
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             
            </div>
        </div>
  
   
          
              
    
      

    </div>
</div>
@endsection