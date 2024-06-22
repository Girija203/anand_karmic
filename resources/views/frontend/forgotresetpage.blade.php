@extends('frontend.layouts.app')


<link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  
@section('content')
<main>
    <!-- About Us Section Start -->
    <section class="about-us-section section-space-ptb border-top-1">
      <div class="container">

        <div class="about-body-section section-space-pt fs-16 row align-items-center">

    {{-- <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100"> --}}
           <div class="bg-overlay"></div>
           <!-- auth-page content -->
           <div class="auth-page-content overflow-hidden pt-lg-5">
               <div class="container">
                   <div class="row">
                       <div class="col-lg-12">
                           <div class="card overflow-hidden">
                               <div class="row g-0">
                                   <div class="col-lg-6">
                                       {{-- <div class="p-lg-5 p-4 auth-one-bg h-100"> --}}
                                           <!-- <div class="bg-overlay"></div> -->
                                           <div class="position-relative h-100 d-flex flex-column">
                                               <div class="mb-4">
                                                   <a href="index.html" class="d-block">
                                                       {{-- <img src="assets/images/logo-light.png" alt="" height="18"> --}}
                                                   </a>
                                               </div>
                                               <div class="mt-auto">
                                                   <div class="mb-3">
                                                       <i class="ri-double-quotes-l display-4 text-success"></i>
                                                   </div>
   
                                                   <div id="qoutescarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                                       <div class="carousel-indicators">
                                                           <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                           <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                           <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                       </div>
                                                       <div class="carousel-inner text-center text-white-50 pb-5">
                                                           <!-- <div class="carousel-item active">
                                                               <p class="fs-15 fst-italic">" Great! Clean code, clean design, easy for customization. Thanks very much! "</p>
                                                           </div>
                                                           <div class="carousel-item">
                                                               <p class="fs-15 fst-italic">" The theme is really great with an amazing customer support."</p>
                                                           </div>
                                                           <div class="carousel-item">
                                                               <p class="fs-15 fst-italic">" Great! Clean code, clean design, easy for customization. Thanks very much! "</p>
                                                           </div> -->
                                                       </div>
                                                   </div>
                                                   <!-- end carousel -->
                                               </div>
                                           </div>
                                       </div>
                                   </div>
   
       <!-- Begin page -->
       <div class="accountbg"></div>
       <div class="wrapper-page">
           <div class="panel panel-color panel-primary panel-pages">
               <div class="panel-body">
                   <div class="container">
                       <div class="row">
                           <div class="col-md-6 offset-md-3">
                   <h4 class="text-muted text-center m-t-0"><b>Reset Password Form</b></h4>
   
                   <form class="form-horizontal m-t-20 needs-validation" action="{{ route('reset.password.post') }}"
                       method="post">
                       @csrf
                       <input type="hidden" name="token" value="{{ $token }}">
                       <div class="form-group">
                           <div class="col-xs-12 mb-3">
                               <label for="email" class="form-label">Email</label>
                               <input class="form-control" type="text" name="email"
                                   placeholder="E-mail">
                           </div>
                           @error('email')
                           <span class="text-danger">{{ $message }}</span>
                       @enderror
                       </div>
                       <div id="passwordErrorMessage" style="color: red; display: none;">
                       </div>
                       <div class="form-group">
                           <div class="col-xs-12 mb-3">
                               <label for="email" class="form-label">Password</label>
                               <div class="position-relative">
                               <input class="form-control" type="password" id="password" name="password" 
                                   placeholder="Password">
                                   <i class="bx bx-show password-icon position-absolute top-50 end-0 translate-middle-y mx-3" onclick="togglePasswordVisibility('password')"></i>
                               </div>
                               </div>
                               @error('password')
                               <span class="text-danger">{{ $message }}</span>
                           @enderror
                       </div>
                       <div class="form-group">
                           <div class="col-xs-12 mb-3">
                               <label for="email" class="form-label">Confirm Password</label>
                               <div class="position-relative">
                               <input class="form-control" type="password" id="confirmpassword"
                                   name="password_confirmation"  placeholder="Confirm Password">
                                   <i class="bx bx-show password-icon position-absolute top-50 end-0 translate-middle-y mx-3" onclick="togglePasswordVisibility('confirmpassword')"></i>
                               </div>
                               </div>
                               @error('password_confirmation')
                               <span class="text-danger">{{ $message }}</span>
                           @enderror
                       </div>
                       <div class="form-group text-right m-t-20">
                           <div class="row">
                               <div class="col-xs-12">
                                   <button id="submitBtn" class="btn btn-primary w-md waves-effect waves-light" type="submit">Change Password</button>
                               </div>
                           </div>
   
                           <div class="form-group text-center m-t-20 mb-3">
                               <div class="text-center mt-3">
                                   <a href="{{ route('normaluser.register') }}" class="btn btn-link">Go to Login</a>
                               </div>
                           </div>
   
   
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>
   
   
   </div>
   </div>
   
   
                               </div>
   
</div>    <!-- Parsleyjs -->
</section>
</main>
 
<script>

function togglePasswordVisibility(passwordId) {
    const passwordField = document.getElementById(passwordId);
    const passwordIcon = passwordField.nextElementSibling;

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        passwordIcon.classList.remove('bx-show');
        passwordIcon.classList.add('bx-hide');
    } else {
        passwordField.type = 'password';
        passwordIcon.classList.remove('bx-hide');
        passwordIcon.classList.add('bx-show');
    }
}
    </script>


   @endsection