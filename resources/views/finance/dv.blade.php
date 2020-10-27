@extends('layouts.app')

@section('content')
<div class="container">
    <h3>List of Disbursement Voucher</h3>
  <hr>
   <button type="button" class="btn btn-primary" data-toggle="modal" id="btn_add_dv">Add DV</button>
   <button type="button" class="btn btn-primary" data-toggle="modal" id="btn_import">Import DV</button>
   {{-- <a href="/dv/attach"><button type="button" class="btn btn-info" data-toggle="modal">Attach DV</button></a>  --}}
   <button type="button" class="btn btn-primary"  onclick="window.location.href='/dv/attach';">Attach DV</button>
  

   <br>
    <br>
    <table id="dv_tbl" class="table table-responsive table-striped w-100 d-block d-xs-table table-bordered">
        <thead>
            <tr>
                <th>DATE OF DV</th>
                <th>DV NUMBER</th>
                <th>PAYEE</th>
                <th>NATURE OF PAYMENT</th>
                <th>NET AMOUNT</th>
                <th>DATE OBLIGATED</th>
                <th>ORS/BURS NO.</th>
                <th>ACCOUNT DESCRIPTION</th>
                <th>MONTH CHECK IS ISSUED</th>
                <th>DATE OF CHECK</th>
                <th>CHECK NUMBER</th>
                <th>STATUS</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dvs as $dv)
                    <tr>
                        <td>{{$dv->dv_date}}</td>
                        <td>{{$dv->dv_number}}</td>
                        <td>{{$dv->payee}}</td>
                        <td>{{$dv->nop}}</td>
                        <td>{{$dv->net_amount}}</td>
                        
                      
                        <td>{{$dv->date_obligated}}</td>
                    
                        <td>{{$dv->ors_no}}</td>
                        
                        <td>{{$dv->account_desc}}</td>
                        <td>{{$dv->month_check_issued}}</td>
                        <td>{{$dv->check_date}}</td>
                        <td>{{$dv->check_no}}</td>
                        <td>
                            @if (empty($dv->month_check_issued && $dv->check_date && $dv->check_no ))
                            <strong style="color:rgb(253, 11, 124)">On Processed </strong>   
                            @else
                            <strong style="color:rgb(21, 170, 21)"> To be claimed </strong>  
                            @endif
                        </td>
                        @if (empty($dv->month_check_issued && $dv->check_date && $dv->check_no ))
                        <td  style="color: rgb(194, 48, 48)"><i class="fa fa-file"><i class="fa fa-plus"></i><a href="/dv/lacking-documents/{{$dv->id}}" ><strong>Lacking Documents</strong></a></i></td>    
                        @else
                        <td></td>
                        @endif
                   
                       
                   </tr>  
            @endforeach
          
     
        </tbody>
    </table>
    {{-- test table --}}
    {{-- <table class="table">
   
        <thead>
            
        {{-- @foreach($values[0] as $row)
           
              <th>{{$row}}</th>
        @endforeach --}}
           
        </thead>
      
        {{-- @foreach($values as $row)
        <tr>
                <td>{{$row[0]}}</td>        
        </tr>
       @endforeach --}}
      
      
    </table> 

    {{-- end test table --}}
</div>
<div class="modal fade" id="modal_add" style="overflow: auto" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document" >
        <div class="modal-content" id="modal_add_dv">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_import_header">Add Disbursement Voucher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form action="/dvadd" id="dvadd" name="dvadd" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <br>
                <div class="row">
                    <div class="col 3">
                        <label for="">Select Year:</label>
                        <select name="cy" data-live-search="true" data-live-search-style="startsWith">
                            <option value="">Select Option</option>
                            @foreach($values as $row)
                              <option value="{{$row[0]}}">{{$row[0]}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col 3">
                        <label for="">DATE OF DV:</label>
                        <select name="datedv" data-live-search="true" data-live-search-style="startsWith">
                            <option value="">Select Option</option>
                            @foreach($values as $row)
                                <option value="{{$row[1]}}">{{$row[1]}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col 3">
                        <label for="">DV NUMBER:</label>
                        <select name="dvnum" data-live-search="true" data-live-search-style="startsWith">
                            <option value="">Select Option</option>
                            @foreach($values as $row)
                              <option value="{{$row[2]}}">{{$row[2]}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col 3">
                        <label for="">PAYEE:</label>
                        <select name="payee" data-live-search="true" data-live-search-style="startsWith">
                            <option value="">Select Option</option>
                            @foreach($values as $row)
                              <option value="{{$row[3]}}">{{$row[3]}}</option>
                            @endforeach
                        </select>
                    </div>
                 
                </div>
                <hr>
                <div class="row">
                    <div class="col 3">
                        <label for="">NATURE OF PAYMENT:</label>
                        <select name="nop" data-live-search="true" data-live-search-style="startsWith">
                            <option value="">Select Option</option>
                            @foreach($values as $row)
                              <option value="{{$row[4]}}">{{$row[4]}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col 3">
                        <label for="">NET AMOUNT:</label>
                        <select name="netamount" data-live-search="true" data-live-search-style="startsWith">
                            <option value="">Select Option</option>
                            @foreach($values as $row)
                                <option value="{{$row[5]}}">{{$row[5]}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col 3">
                        <label for="">value-added tax (VAT):</label>
                        <select name="vat" data-live-search="true" data-live-search-style="startsWith">
                            <option value="">Select Option</option>
                            @foreach($values as $row)
                              <option value="{{$row[6]}}">{{$row[6]}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col 3">
                        <label for="">GROSS AMOUNT:</label>
                        <select name="grossamount" data-live-search="true" data-live-search-style="startsWith">
                            <option value="">Select Option</option>
                            @foreach($values as $row)
                              <option value="{{$row[7]}}">{{$row[7]}}</option>
                            @endforeach
                        </select>
                    </div>
                 
                </div>
                <hr>
                <div class="row">
                    <div class="col 3">
                        <label for="">MONTH OBLIGATED:</label>
                        <select name="mobligated" data-live-search="true" data-live-search-style="startsWith">
                            <option value="">Select Option</option>
                            @foreach($values as $row)
                              <option value="{{$row[8]}}">{{$row[8]}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col 3">
                        <label for="">DATE OBLIGATED:</label>
                        <select name="dobligated" data-live-search="true" data-live-search-style="startsWith">
                            <option value="">Select Option</option>
                            @foreach($values as $row)
                                <option value="{{$row[9]}}">{{$row[9]}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col 3">
                        <label for="">ALLOTMENT CLASS:</label>
                        <select name="allclass" data-live-search="true" data-live-search-style="startsWith">
                            <option value="">Select Option</option>
                            @foreach($values as $row)
                              <option value="{{$row[10]}}">{{$row[10]}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col 3">
                        <label for="">ORS/BURS NO.:</label>
                        <select name="ors" data-live-search="true" data-live-search-style="startsWith">
                            <option value="">Select Option</option>
                            @foreach($values as $row)
                              <option value="{{$row[11]}}">{{$row[11]}}</option>
                            @endforeach
                        </select>
                    </div>
                 
                </div>
                <hr>
                <div class="row">
                    <div class="col 3">
                        <label for="">UACS OBJECT CODE:</label>
                        <select name="uacs" data-live-search="true" data-live-search-style="startsWith">
                            <option value="">Select Option</option>
                            @foreach($values as $row)
                              <option value="{{$row[12]}}">{{$row[12]}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col 3">
                        <label for="">ACCOUNT DESCRIPTION:</label>
                        <select name="adesc" data-live-search="true" data-live-search-style="startsWith">
                            <option value="">Select Option</option>
                            @foreach($values as $row)
                                <option value="{{$row[13]}}">{{$row[13]}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col 3">
                        <label for="">MONTH CHECK IS ISSUED:</label>
                        <select name="monthissued" data-live-search="true" data-live-search-style="startsWith">
                            <option value="">Select Option</option>
                            @foreach($values as $row)
                              <option value="{{$row[14]}}">{{$row[14]}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col 3">
                        <label for="">DATE OF CHECK:</label>
                        <select name="dcheck" data-live-search="true" data-live-search-style="startsWith">
                            <option value="">Select Option</option>
                            @foreach($values as $row)
                              <option value="{{$row[15]}}">{{$row[15]}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col 3">
                        <label for="">CHECK NUMBER:</label>
                        <select name="cnumber" data-live-search="true" data-live-search-style="startsWith">
                            <option value="">Select Option</option>
                            @foreach($values as $row)
                              <option value="{{$row[16]}}">{{$row[16]}}</option>
                            @endforeach
                        </select>
                    </div>
                 
                </div>  
                <br>  
                <button style="float:left" class="btn btn-primary" type="submit">Save</button>   
                </form>


            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-primary" id="btn_upload">Save</button> --}}
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>

        {{-- <div class="modal-content" id="modal_content_notification" style="display: none;">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_import_header">Import DV</h5>
                <button type="button" class="close" onclick="javascript:window.location.reload()" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_notication_body" style="height: 100%;">

            </div>
        </div> --}}

    </div>
</div>




<div class="modal fade" id="modal_import" style="overflow: auto" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="modal_content_import">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_import_header">Import Disbursement Voucher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12" style="overflow-x: scroll">
                    <p>Only <code>.xls</code>, <code>.xlsx</code>, <code>.csv</code> files are
                        allowed to be uploaded.
                    </p>
                    <p>Please make sure that you follow the <a
                            href="{{url('/')}}/home/download_excel_template">prescribed template
                        </a> to upload just
                        like below. At pakichange po ng dates ng sumusunod: DATE OF DV, DATE OBLIGATED, DATE OF CHECK sa ganitong format YYYY/MM/DD.</p>
                    <img src="{{url('/')}}/dv_sample_template.png">
                </div>
                <form action="#" id="form_upload" name="form_upload" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <br>
                    <input type="file" accept=".xls,.xlsx,.csv" name="file_upload" id="file_upload">

                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_upload">Import
                    DV</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>

        <div class="modal-content" id="modal_content_notification" style="display: none;">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_import_header">Import DV</h5>
                <button type="button" class="close" onclick="javascript:window.location.reload()" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_notication_body" style="height: 100%;">

            </div>
        </div>

    </div>
</div>
@endsection

