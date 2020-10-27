@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Set Lacking Documents</h3>
   <hr>
<form action="/add-doc" method="post">
        @csrf
        <input hidden type="text" name="dv_id" id="" value="{{$dv_val}}">
        <label for=""><strong>Documents Lacking:</strong> </label>
        @foreach ($valdocas as $valdocs)
            @php
                $newval[] = $valdocs
            @endphp

          @endforeach
          {{-- {{dd($newval)}} --}}
        <select name="docId[]" multiple data-live-search="true" data-live-search-style="startsWith" class="selectpicker">
            
            @foreach ($documents as  $item)

           
        @if(in_array($item->description, $newval)){
            <option value="{{$item->id}}" selected>{{$item->description  }}</option>
        @else
            <option value="{{$item->id}}">{{$item->description}}</option>
        @endif
    {{-- <option  value="{{$item->id}}">  {{$item->description}}</option>  --}}
    @endforeach 
        </select>

        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>DV NUMBER</th>
                <th>DV DATE</th>
                <th>NATURE OF PAYMENT</th>
                <th>PAYEE</th>
            </tr>
        </thead>
        <tbody>
           
       
            <tr>
                <td scope="row">{{$dv_detail->dv_number}}</td>
                <td scope="row">{{$dv_detail->dv_date}}</td>
                <td scope="row">{{$dv_detail->payee}}</td>
                <td scope="row">{{$dv_detail->nop}}</td>
            </tr>
           
            
        
        </tbody>
    </table>
  
</div>

@endsection

