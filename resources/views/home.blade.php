@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($users as $user)
        
    @endforeach
    @if (Auth::user()->hasRole('finance'))
            <div class="row justify">
                <div class="col-md-4">
                <div class="card text-white bg-info mb-3">
                    <h4 class="card-header">Disbursement Voucher</h4>
                    <div class="card-body">
                        <h4 class="card-title">No. of DVs</h4>
                        <p class="card-text">  {{count($dvcounts)}}</p>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="{{route('dv')}}">
                        <span class="float-left">  <i class="fa fa-eye"></i>  View Details</span>
                        <span class="float-right">
                        <i class="fa fa-angle-right"></i>
                        </span>
                    </a>
                    </div>
                </div>  
            </div>
        
            <hr>
    @endif
    @if (Auth::user()->hasRole('guest'))
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">{{ __('Dashboard') }}</div>

                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                {{ __('Welcome! Please note that your account is still being verified. Thank you!') }}
                            </div>

                       
                        </div>
                    </div>
                </div>
    @else
            {{-- new dv --}}
          
            {{-- end new dv --}}
            
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">{{ __('List of Disbursement Voucher') }}</div>

                        <div class="card-body">
                            @foreach ($dvs as $fdv)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>DATE OF DV PROCESSED</th>
                                        <th>DATE ISSUED</th>
                                        <th>CHECK/ADA NO.</th>
                                        <th>NATURE OF PAYMENT</th>
                                        <th>AMOUNT</th>
                                        <th>STATUS</th>
                                        <th>LACKING DOCUMENTS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fdv->dvs as $dv)
                                    <tr>
                                        <td>{{$dv->dv_date}}</td>
                                        <td>{{$dv->dv_date}}</td>
                                        <td>{{$dv->check_no}}</td>
                                        <td>{{$dv->nop}}</td>
                                        <td>{{$dv->net_amount}}</td>
                                         <td>
                                         @if (empty($dv->month_check_issued && $dv->check_date && $dv->check_no ))
                                         <strong style="color:rgb(253, 11, 124)">On Processed </strong>   
                                         @else
                                         <strong style="color:rgb(21, 170, 21)"> To be claimed </strong>  
                                         @endif
                                        </td> 
                                        <td>
                                                @if (empty($dv->month_check_issued && $dv->check_date && $dv->check_no ))
                                                    @foreach ($dv->docs as $lackdv)
                                                     <li>{{$lackdv->description}}</li> 
                                                    @endforeach  
                                                @else
                                         <td></td>
                                         @endif
                                        </td>
                                         
                                    </tr>
                                    
                            @endforeach
                          
                         
                                
                                </tbody>
                            </table>
                           
                            @endforeach
                        </div>

                    {{-- <button class="btn button-small btn-info btn-sm" id="btn_import"><i class="fa fa-paperclip" aria-hidden="true"></i>Import Participants</button> --}}
                    </div>
                </div>
            </div>
    @endif
    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=michelle.siarez@dict.gov.ph&su=Cashier Inquiry&body=Greetings!&bcc=renato.baga@dict.gov.ph" class="float" style="position:fixed;
	width:60px;
	height:60px;
	bottom:40px;
	right:40px;
	background-color:#0C9;
	color:#FFF;
	border-radius:50px;
	text-align:center;
	box-shadow: 2px 2px 3px #999;" target="_blank">
        <i class="fa fa-lg fa-envelope" style="margin-top:22px;"></i>
    </a>
    <br>
    <div class="row justify">
        <div class="col-md-12">
          <div class="card">
              <h4 class="card-header">Announcement</h4>
              <div class="card-body">
                <h4 class="card-title">Under Maintenance <i class="fa fa-exclamation-triangle"></i></h4>
                {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
                <a href="#!" class="btn btn-primary">Go somewhere else</a>
              </div>
            </div>
        </div>
    </div>
 
    
</div>



@endsection

