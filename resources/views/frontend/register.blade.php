@extends('frontend.layouts.app')


  
@section('content')
 
<main>
    <section class="breadcrumb-section">
      {{-- <div class="breadcrumb-image">
        <img
          src="assets/images/banners/breadcrumb_bag.jpg"
          alt="breadcrumb bg"
          width="1920"
          height="292"
        />
      </div> --}}
      {{-- <div class="breadcrumb-content text-center">
        <h2 class="mb-2">Login & Register</h2>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="#">Home</a></li>

            <li class="breadcrumb-item active" aria-current="page">
              Login & Register
            </li>
          </ol>
        </nav>
      </div> --}}

    

    <section class="my-login-page section-space-ptb border-bottom-1">
      <div class="container">
        <div class="row">


         
            </section>
          <div class="col-lg-5 mx-auto">
            <div class="sign-in-modal-body px-3 pb-5">
              <div class="modal-box-wrapper">
                <ul class="nav sign-in-tablist" role="tablist">
                  <li class="sign-in-tab--item nav-item" role="presentation">
                    <a
                      class="sign-in-tab--link active"
                      data-bs-toggle="tab"
                      href="#tab_list_06"
                      role="tab"
                      aria-selected="true"
                      >Login</a
                    >
                  </li>
                  <li class="sign-in-tab--item nav-item" role="presentation">
                    <a
                      class="sign-in-tab--link"
                      data-bs-toggle="tab"
                      href="#tab_list_07"
                      role="tab"
                      aria-selected="false"
                      tabindex="-1"
                      >Our Register</a
                    >
                  </li>
                </ul>
                <div class="tab-content">
                  <div
                    class="tab-pane fade show active"
                    id="tab_list_06"
                    role="tabpanel"
                  >
                    <form action="{{route('normaluser.login')}}"  method="post" class="account-form-box mx-auto">
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
                      <div class="single-input-gruop">
                        <label class="single-input-label" for="login-password"
                          >Password*</label
                        >
                        <input
                          class="single-input-fild"
                          type="password"
                          id="login-password"
                       name="password" required/>
                      </div>
                      <div
                        class="checkbox-wrap mt-3 mb-4 d-flex align-items-center justify-content-between fs-16"
                      >
                        <label
                          class="label-for-checkbox d-flex gap-1 align-items-center"
                        >
                          <input
                            class="input-checkbox"
                            name="rememberme"
                            type="checkbox"
                            id="rememberme"
                            value="forever"
                          />
                          <span>Remember me</span>
                        </label>
                        <a href="{{route('forgot')}}">Lost your password?</a>
                      </div>
                      <div class="button-box">
                        <button class="btn btn-full btn-md btn-primary"
                          >Log in</button
                        >
                      </div>
                    </form>
                  </div>
                  <div class="tab-pane fade" id="tab_list_07" role="tabpanel">
                    <form action="{{ route('normaluser.store') }}" method="POST" class="account-form-box mx-auto">
                        @csrf
                      <div class="single-input-gruop">
                        <label class="single-input-label" for="register-name"
                          >Username*</label
                        >
                        <input
                          class="single-input-fild"
                          type="text"
                          id="register-name"
                       name="name" />
                       @if($errors->has('name'))
                       @foreach ($errors->get('name') as $message)
                           <span class="error text-danger">{{ $message }}</span>
                       @endforeach
                   @endif
                      </div>
                      <div class="single-input-gruop">
                        <label class="single-input-label" for="register-email"
                          >Email address*</label
                        >
                        <input
                          class="single-input-fild"
                          type="email"
                          id="register-email"
                          name="email" />

                          @if($errors->has('email'))
            @foreach ($errors->get('email') as $message)
                <span class="error text-danger">{{ $message }}</span>
            @endforeach
        @endif   
                      
                    </div>
                      <div class="single-input-gruop">
                        <label
                          class="single-input-label"
                          for="register-password"
                          >Password*</label
                        >
                        <input
                          class="single-input-fild"
                          type="password"
                          id="register-password"
                          name="password" />
                          

                          @if($errors->has('password'))
            @foreach ($errors->get('password') as $message)
                <span class="error text-danger">{{ $message }}</span>
            @endforeach
        @endif 
                      </div>
                      <div class="g-recaptcha" data-sitekey="6Ldx8f8pAAAAAOap18arw95iuqWYlfEJehyYJ56o"></div>
  @if($errors->has('g-recaptcha-response'))
    <span class="error text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
  @endif
                      <!-- <p class="mt-3 text-center">
                        Your personal data will be used to support your
                        experience throughout this website, to manage access
                        to your account, and for other purposes described in
                        our
                        <a
                          href="#"
                          class="privacy-policy-link"
                          target="_blank"
                          >privacy policy</a
                        >.
                      </p> -->
                      <div class="button-box mt-4">
                        <button
                          type="submit"
                          class="btn btn-full btn-primary btn-md"
                        >
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
      </div>
    </section>
  </main>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
  
@endsection