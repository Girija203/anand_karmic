@extends('frontend.layouts.app')


  
@section('content')
<section class="my-login-page section-space-ptb border-bottom-1">
    <div class="container">
      <div class="row">


          {{-- @if (session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
      @endif --}}
          </section>
        <div class="col-lg-5 mx-auto">
          <div class="sign-in-modal-body px-3 pb-5">
            <div class="modal-box-wrapper">
              <ul class="nav sign-in-tablist" role="tablist">
                <li class="sign-in-tab--item nav-item" role="presentation">
                 <h3>Forgot Password </h3>
                 
                </li>
              </ul>
              <div class="tab-content">
                <div
                  class="tab-pane fade show active"
                  id="tab_list_06"
                  role="tabpanel"
                >
                  <form action="{{route('forget.password.post')}}"  method="post" class="account-form-box mx-auto">
                      @csrf
                    <div class="single-input-gruop">
                      <label class="single-input-label" for="login-username"
                        >Email address*</label
                      >
                      <input
                        class="single-input-fild"
                        type="text"
                        id="login-username"
                     name="email" required/>
                    </div>
                   
                    <div
                      class="checkbox-wrap mt-3 mb-4 d-flex align-items-center justify-content-between fs-16"
                    >
                      {{-- <label
                        class="label-for-checkbox d-flex gap-1 align-items-center"
                      >
                        <input
                          class="input-checkbox"
                          name="rememberme"
                          type="checkbox"
                          id="rememberme"
                          value="forever"
                        /> --}}
                        <span></span>
                      </label>
                      {{-- <a href="{{route('forgot')}}">Lost your password?</a> --}}
                    </div>
                    <div class="button-box">
                      <button class="btn btn-full btn-md btn-primary"
                        >Send link</button
                      >
                    </div>
                    <div class="button-box" style="
                    margin: inherit; ">
                        <a href="{{route('normaluser.register')}}"
                          >Go to login</a
                        >
                      </div>
                  </form>
                </div>
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection