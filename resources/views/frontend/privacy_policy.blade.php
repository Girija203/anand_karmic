   @extends('frontend.layouts.app')

   @section('content')
       <main>
           <section class="about-us-section section-space-ptb border-top-1">
               <div class="container">
                   @foreach ($privacyPolicies as $privacyPolicy)
                       <div class="privacy-policy-content">
                           
                           <p>{!! $privacyPolicy->privacy_policy !!}</p>
                           
                       </div>
                   @endforeach
               </div>
           </section>
       </main>
   @endsection
