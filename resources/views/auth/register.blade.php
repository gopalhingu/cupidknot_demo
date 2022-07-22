@extends('layouts.layout')
  
@section('content')
<div class="register-form">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Register</div>
                  <div class="card-body">
  
                      <form action="{{ route('register.post') }}" method="POST">
                          @csrf

                          <h2 style="text-align: center;">Basic Information Section</h2><br>

                          <div class="form-group row">
                              <label for="first_name" class="col-md-4 col-form-label text-md-right"> First Name</label>
                              <div class="col-md-6">
                                  <input type="text" id="first_name" class="form-control" name="first_name" required />
                                  @if ($errors->has('first_name'))
                                      <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                  @endif
                              </div>
                          </div>


                          <div class="form-group row">
                              <label for="last_name" class="col-md-4 col-form-label text-md-right">Last name</label>
                              <div class="col-md-6">
                                  <input type="text" id="last_name" class="form-control" name="last_name" required />
                                  @if ($errors->has('last_name'))
                                      <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="email_address" class="col-md-4 col-form-label text-md-right">Email Address</label>
                              <div class="col-md-6">
                                  <input type="text" id="email_address" class="form-control" name="email" required />
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                              <div class="col-md-6">
                                  <input type="password" id="password" class="form-control" name="password" required />
                                  @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                              </div>
                          </div>


                           <div class="form-group row">
                              <label for="confirm_password" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                              <div class="col-md-6">
                                  <input type="password" id="confirm_password" class="form-control" name="confirm_password" required />
                                  @if ($errors->has('confirm_password'))
                                      <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="dob" class="col-md-4 col-form-label text-md-right">DOB</label>
                              <div class="col-md-6">
                                 <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror"
                                           name="dob" required>
                                  @if ($errors->has('dob'))
                                      <span class="text-danger">{{ $errors->first('dob') }}</span>
                                  @endif
                              </div>
                          </div>


                           <div class="form-group row">
                              <label for="last_name" class="col-md-4 col-form-label text-md-right">Gender</label>
                              <div class="col-md-6">
                                    <input type="radio" name="gender" value="male" checked> Male &nbsp;
                                    <input type="radio" name="gender" value="female"> Female<br>  
                                  @if ($errors->has('gender'))
                                      <span class="text-danger">{{ $errors->first('gender') }}</span>
                                  @endif
                              </div>
                          </div>


                          <div class="form-group row">
                              <label for="income" class="col-md-4 col-form-label text-md-right">Annual income</label>
                              <div class="col-md-6">
                                  <input type="text" id="income" class="form-control" name="income" required />
                                  @if ($errors->has('income'))
                                      <span class="text-danger">{{ $errors->first('income') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="occupation" class="col-md-4 col-form-label text-md-right">Occupation</label>
                              <div class="col-md-6">
                                   <select class="form-control" name="occupation" id="occupation" required>
                                        <option value="1">Private job</option>
                                        <option value="2">Government Job</option>
                                        <option value="3">Business</option>
                                    </select>
                                  @if ($errors->has('occupation'))
                                      <span class="text-danger">{{ $errors->first('occupation') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="family_type" class="col-md-4 col-form-label text-md-right">Family type</label>
                              <div class="col-md-6">
                                   <select class="form-control" name="family_type" id="family_type" required>
                                        <option value="1">Joint family</option>
                                        <option value="2">Nuclear family</option>
                                    </select>
                                  @if ($errors->has('family_type'))
                                      <span class="text-danger">{{ $errors->first('family_type') }}</span>
                                  @endif
                              </div>
                          </div>


                          <div class="form-group row">
                              <label for="manglik" class="col-md-4 col-form-label text-md-right">Manglik</label>
                              <div class="col-md-6">
                                    <select class="form-control" name="manglik" id="manglik" required>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                  @if ($errors->has('manglik'))
                                      <span class="text-danger">{{ $errors->first('manglik') }}</span>
                                  @endif
                              </div>
                          </div>

                          <h2 style="text-align: center;">Partner Preference</h2><br>

                          <div class="form-group row">
                              <label for="pre_income" class="col-md-4 col-form-label text-md-right">Annual income</label>
                              <div class="col-md-6">
                                  <input type="text" id="amount" name="pre_income" readonly
                                           style="border:0; color:#f6931f; font-weight:bold;">
                                   <div id="slider-range"></div>         
                                 
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="pre_occupation" class="col-md-4 col-form-label text-md-right">Occupation</label>
                              <div class="col-md-6">
                                   <select class="form-control select2-multiple" name="pre_occupation[]" id="pre_occupation"  multiple="multiple" required>
                                        <option value="1">Private job</option>
                                        <option value="2">Government Job</option>
                                        <option value="3">Business</option>
                                    </select>
                                  @if ($errors->has('pre_occupation'))
                                      <span class="text-danger">{{ $errors->first('pre_occupation') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="pre_family_type" class="col-md-4 col-form-label text-md-right">Family type</label>
                              <div class="col-md-6">
                                   <select class="form-control select2-multiple" name="pre_family_type[]" id="pre_family_type"  multiple="multiple" required>
                                        <option value="1">Joint family</option>
                                        <option value="2">Nuclear family</option>
                                    </select>
                                  @if ($errors->has('pre_family_type'))
                                      <span class="text-danger">{{ $errors->first('pre_family_type') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="pre_manglik" class="col-md-4 col-form-label text-md-right">Manglik</label>
                              <div class="col-md-6">
                                    <select class="form-control" name="pre_manglik" id="pre_manglik" required>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                        <option value="both">Both</option>
                                     
                                    </select>
                                  @if ($errors->has('pre_manglik'))
                                      <span class="text-danger">{{ $errors->first('pre_manglik') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <div class="col-md-6 offset-md-4">
                                  <div class="checkbox">
                                      <label>
                                          <input type="checkbox" name="remember"> Remember Me
                                      </label>
                                  </div>
                              </div>
                          </div>
  
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Register
                              </button>
                          </div>
                      </form>
                        
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection


@section('scripts')
 <script>
  $( function() {

    $('.select2-multiple').select2({
        placeholder: "Select",
        allowClear: true
    });

    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 500,
      values: [ 75, 300 ],
      slide: function( event, ui ) {
        $( "#amount" ).val(ui.values[ 0 ] + " -" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val($( "#slider-range" ).slider( "values", 0 ) +
      " - " + $( "#slider-range" ).slider( "values", 1 ) );
  } );
  </script> 
@endsection