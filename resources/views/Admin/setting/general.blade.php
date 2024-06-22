<div class="tab-pane fade show active" id="list-general" role="tabpanel" aria-labelledby="list-general-list">
<div class="card border">
    <div class="card-body">
        <form action="{{route('settings.general')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Site Title</label>
                <input type="text" class="form-control" name="site_title" value="{{ $setting->site_title ?? '' }}">
            </div>
            <div class="form-group">
    
    <label>Logo</label>
    <input type="file" class="form-control" name="logo" value="">
    <input type="hidden" class="form-control" name="old_logo" value="{{ $setting->logo ?? '' }}">
</div>
@if($setting && $setting->logo)
    <img src="{{ asset(Storage::url($setting->logo)) }}" width="50px" alt="Logo">
@else
    <img src="{{ asset('path_to_default_logo_image') }}" width="50px" alt="Default Logo">
@endif

    <br>

<div class="form-group">
    
    <label>Favicon</label>
    <input type="file" class="form-control" name="favicon" value="">
    <input type="hidden" class="form-control" name="old_favicon" value="{{ $setting->favicon ?? '' }}">
</div>
@if($setting && $setting->favicon)
    <img src="{{ asset(Storage::url($setting->favicon)) }}" width="50px" alt="Logo">
@else
    <img src="{{ asset('path_to_default_favicon_image') }}" width="50px" alt="Default Logo">
@endif
    <br>

            <div class="form-group">
                <label>Timezone</label>
                <select name="time_zone" id="" class="form-control select2">
                    <option value="">Select</option>
                    @if($setting && $setting->timezone == 'india')
    <option value="india" selected>India</option>
@else
    <option value="india">India</option>
@endif

@if($setting && $setting->timezone == 'usa')
    <option value="usa" selected>USA</option>
@else
    <option value="usa">USA</option>
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
