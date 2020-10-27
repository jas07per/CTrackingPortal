@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{  __('Attached users to single payee') }}</div>

                <div class="card-body">
                    <form action="/attach-single" method="post">
                        @csrf 
                                <select name="userid" data-live-search="true" data-live-search-style="startsWith" class="selectpicker">
                                    @foreach ($users as $user)
                                    <option  value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select> =
                                <select name="payee" data-live-search="true" data-live-search-style="startsWith" class="selectpicker">
                                    @foreach ($payees as $payee)
                                    <option  value="{{$payee->dv_number}}">{{$payee->dv_number}}</option>
                                    @endforeach
                                </select>
    
                                <button class="btn btn-primary" type="submit">Submit</button>
                      </form>
                </div>
{{-- <button class="btn button-small btn-info btn-sm" id="btn_import"><i class="fa fa-paperclip" aria-hidden="true"></i>Import Participants</button> --}}
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Attached users to multiple payee') }}</div>

                <div class="card-body">
                  <form action="/attach" method="post">
                    @csrf 
                            <select name="userid" data-live-search="true" data-live-search-style="startsWith" class="selectpicker">
                                @foreach ($users as $user)
                                <option  value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select> =
                            <select name="payee" data-live-search="true" data-live-search-style="startsWith" class="selectpicker">
                                @foreach ($payees as $payee)
                                <option  value="{{$payee->payee}}">{{$payee->payee}}</option>
                                @endforeach
                            </select>

                            <button class="btn btn-primary" type="submit">Submit</button>
                  </form>
                    
                
                </div>    
            </div>
            <br>
            <hr>
            {{-- start table --}}
            <h4>List of attached users and DV</h4>
            <table class="table">
                <thead class="thead-inverse">
                    <tr>
                        <th>User</th>
                        <th>DV Number</th>
                        <th>DV Payee</th>
                    </tr>
                    </thead>
                    <tbody>
           
             @foreach ($dvusers as $item)
                <tr>
                <td>{{$item->name}}</td>
                    @foreach ($item->dvs as $dv)
                <td>{{$dv->dv_number}}</td>
                <td>{{$dv->payee}}</td>
                    @endforeach
                
                </tr>
             @endforeach
           
      
                       
                    </tbody>
            </table>
            {{-- end table --}}
        </div>
        
    </div>
</div>


<div class="modal fade" id="modal_import" style="overflow: auto" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="modal_content_import">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_import_header">Import DV</h5>
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
                        like below.</p>
                    <img src="{{url('/')}}/excel_template.png">
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_notication_body" style="height: 100%;">

            </div>
        </div>

    </div>
</div>
@endsection

