@extends('Admin.layouts.app')
@section('content')

<div class="content-page">
    <div class="content">
<form method="POST" action="{{route('adminprofile.update')}}"  enctype="multipart/form-data">
    @csrf
    <div class="p-2">
       <div class="container">
          <div class="picture-container">
             <div class="picture" style="margin-left:50% !important ">
                @if (!empty($user->image))
                <img src="{{ asset('storage/' . $user->image) }}" class="rounded-circle p-1 bg-primary " height="110" width="110" id="wizardPicturePreview" title="">
                @else
                <img src="" class="picture-src rounded-circle" id="wizardPicturePreview" title="" style="display: none;">
                @endif
                <input type="file" name="image" id="wizard-picture" class="">
             </div>
             <h6 class=""style="margin-left:52% !important;">Choose Picture</h6>
             <p style="color: red;margin-left:52% !important;">500x500</p>
          </div>
       </div>
    </div>
    <div class="row mb-3">
       <div class="col-sm-3">
          <h6 class="mb-0" style= "margin-left: 50% !important;margin-top: 10px!important;">Name</h6>
       </div>
       <div class="col-sm-9 text-secondary">
          <input type="text" class="form-control" name="name" value="{{$user->name}}" placeholder="First Name" required>
       </div>
    </div>
    <div class="row mb-3">
       <div class="col-sm-3">
          <h6 class="mb-0"style= "margin-left: 50% !important;margin-top: 10px!important;">Email</h6>
       </div>
       <div class="col-sm-9 text-secondary">
          <input type="email" class="form-control" name="email" value="{{$user->email}}" required>
       </div>
    </div>
    <div class="row mb-3">
       <div class="col-sm-3">
          <h6 class="mb-0" style= "margin-left: 50% !important;margin-top: 10px!important;">Mobile</h6>
       </div>
       <div class="col-sm-9 text-secondary">
          <input type="text" class="form-control" name="phone" value="{{$user->phone}}" required>
       </div>
    </div>
    <div class="row">
       <div class="col-sm-3"></div>
       <div class="col-sm-9 text-secondary">
          <button type="submit" class="btn btn-primary px-4">Save Changes</button>
       </div>
    </div>
 </form>
    </div>

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> © Karmic - Theme by <b>Syscorp</b>
                </div>
            </div>
        </div>
    </footer>
</div>



@endsection