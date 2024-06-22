<div class="tab-pane fade show active" id="list-contact" role="tabpanel" aria-labelledby="list-contact-list">
<div class="card border">
    <div class="card-body">
        <form action="{{route('settings.contact')}}" method="POST">
            @csrf
            @method('PUT')
           
            <div class="form-group">
                <label>Contact Email</label>
                <input type="email" class="form-control" name="contact_email" value="{{ $setting->contact_email ?? '' }}">
            </div>
            
            <div class="form-group">
                <label>Topbar Phone</label>
                <input type="text" class="form-control" name="topbar_phone" value="{{ $setting->topbar_phone ?? '' }}">
            </div>
            <div class="form-group">
                <label>Topbar Email</label>
                <input type="email" class="form-control" name="topbar_email" value="{{ $setting->topbar_email ?? '' }}">
            </div>
              <br>
                       <div style="text-align: center;">
  <button type="submit" class="btn btn-primary">Update</button>
</div>
        </form>
    </div>
</div>
</div>
