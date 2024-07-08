   @extends('frontend.layouts.app')

   @section('content')
       <main>
           <section class="about-us-section section-space-ptb border-top-1">
               <div class="container">
                   @foreach ($termConditions as $termCondition)
                       <div class="privacy-policy-content">
                           
                           <p>{!! $termCondition->terms_and_condition !!}</p>
                           
                       </div>
                   @endforeach
               </div>
           </section>
       </main>
   @endsection
