<div class="tab-pane fade show active" id="list-stripe" role="tabpanel" aria-labelledby="list-stripe-list">
<div class="card border">
    <div class="card-body">
        <form action="{{route('payment_methods.stripe')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Country</label>
               <select class="form-control" name="country_code" id="">
                <option value="">select</option>
                @foreach ($country as $item)
                                                    <option value="{{ $item->id }}" {{ $stripe && $stripe->country_code == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                    @endforeach

               </select>
            </div>
             <div class="form-group">
                <label>Currency</label>
                <select class="form-control" name="currency_code" id="">
                <option value="">select</option>
                @foreach ($currency as $item)
                                                    <option value="{{ $item->id }}" {{ $stripe && $stripe->currency_code == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                    @endforeach

               </select>
            </div>

             <div class="form-group">
                <label>Currency Rate</label>
                <input type="text" class="form-control" name="currency_rate"  id="" value="{{ $stripe->currency_rate ?? '' }}">
            </div>
            <div class="form-group">
                <label>Stripe Key</label>
                <input type="text" class="form-control" name="stripe_key" id="" value="{{ $stripe->stripe_key ?? '' }}">
            </div>
            <div class="form-group">
                <label>Stripe Secret</label>
                <input type="text" class="form-control" name="stripe_secret" id="" value="{{ $stripe->stripe_secret ?? '' }}">
            </div>

                         <div class="form-group">
                <label>Status</label>

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
