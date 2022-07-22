@extends('layouts.layout')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('My demo - Dashboard') }}</div>
  
                <div class="card-body">
                    @if (Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
  
                    <h3>Welcome</h3>

                    <div class="row">
                        <div class="col-6">
                            <span>Name: <b>{{$currentUser->first_name }} {{$currentUser->last_name }}</b></span><br>
                        </div>
                    </div>
                    <br>
                    <br>

                    <h3>Suggested Partner</h3>
                    <div class="col-md-12">
                        <div class="row">
                            @foreach($countedUsers as $user)
                            <div class="col-md-6 ">
                                <div class="card" style="width: 18rem;">
                                  <div class="card-body">
                                    <h5 class="card-title">{{$user->first_name}} {{$user->last_name}}</h5>
                                    <span>Gender: <b>{{$user->gender}}</b></span><br>
                                    <span>DOB: <b>{{$user->dob}}</b></span><br>
                                    <span>Income: <b>{{$user->income}}</b></span><br>
                                    <span>Occupation: <b>{{$user->occupation == 1? "Private job" : ($user->occupation == 2 ? "Government Job" : "Business") }}</b></span><br>
                                    <span>Family type: <b>{{$user->family_type == 1 ? "Joint family" : "Nuclear family"}}</b></span><br>
                                    <span>Manglik: <b>{{$user->manglik}}</b></span><br>
                                    <a href="#" class="btn btn-primary">Match <b>{{$user->matchCount}}</b> %</a>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
</div>
@endsection