@extends('layouts.app')

@section('content')
<div class="container">
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

                    {{ __('Welcome to Admin Dashboard. You are logged in!') }}
                </div>
{{-- <table class="table">
   
    <thead>
        @foreach($values as $row)
        <tr>
         
                <td></td>
          
        </tr>
    @endforeach
       
    </thead>
    @foreach($values as $row)
    <tr>
        @foreach($row as $value)
            <td>{{ data_get($value, 'name') }}</td>
        @endforeach
    </tr>
@endforeach
  
  
</table> --}}

            </div>
        </div>
    </div>
</div>
@endsection

