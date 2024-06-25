<div class="tab-pane fade show active" id="list-razorpay" role="tabpanel" aria-labelledby="list-razorpay-list">
<div class="card border">
    <div class="card-body">
        <form action="{{route('payment_methods.razorpay')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
           
            <div class="form-group">
                <label class="mandatory">Razorpay Key</label>
                <input type="text" class="form-control" name="razorpay_key" value="{{$razorpay->razorpay_key ?? ''}}">
            </div>
            <div class="form-group">
                <label class="mandatory">Razorpay Secret</label>
                <input type="text" class="form-control" name="razorpay_secret" value="{{$razorpay->razorpay_secret ?? ''}}">
            </div>
            <div class="form-group">
                <label class="mandatory">Name</label>
                <input type="text" class="form-control" name="name" value="{{$razorpay->name ?? ''}}">
            </div>
            <div class="form-group">
                <label class="mandatory">Description</label>
                <input type="text" class="form-control" name="description" value="{{$razorpay->description ?? ''}}">
            </div>
            <div class="form-group">
                <label class="mandatory">Country</label>
               <select class="form-control" name="country_code" id="">
                <option value="">select</option>
                @foreach ($country as $item)
                                                    <option value="{{ $item->id }}" {{ $razorpay && $razorpay->country_code == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                    @endforeach

               </select>
            </div>
             <div class="form-group">
                <label class="mandatory">Currency</label>
                <select class="form-control" name="currency_code" id="">
                <option value="">select</option>
                @foreach ($currency as $item)
                                                    <option value="{{ $item->id }}" {{ $razorpay && $razorpay->currency_code == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                    @endforeach

               </select>
            </div>

             <div class="form-group">
                <label class="mandatory">Currency Rate</label>
                <input type="text" class="form-control" name="currency_rate"  id="" value="{{$razorpay->currency_rate ?? ''}}">
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" class="form-control" name="image"  id="" value="">
                <input type="hidden" class="form-control" name="old_logo" value="{{ $razorpay->image ?? '' }}">
            </div>
 

@if($razorpay && $razorpay->image)
    <img src="{{ asset(Storage::url($razorpay->image)) }}" width="50px" alt="Logo">
@else
    <img src="{{ asset('path_to_default_logo_image') }}" width="50px" alt="Default Logo">
@endif


           <div class="form-group">
                <label class="mandatory">Status</label>

                               <select name="status" id="" class="form-control select2">
                    <option value="">Select</option>
                    @if($stripe && $stripe->status == '1')
    <option value="1" selected>Active</option>
@else
    <option value="1">Active</option>
@endif

@if($stripe && $stripe->status == '0')
    <option value="0" selected>Inactive</option>
@else
    <option value="0">Inactive</option>
@endif

             
                </select>
            </div>
           
              <br>
                       <div style="text-align: center;">
  <button type="submit" class="btn btn-primary">Update</button>
</div>
        </form>
    </div>
</div>
</div>
