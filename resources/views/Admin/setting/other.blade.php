<div class="tab-pane fade show active" id="list-other" role="tabpanel" aria-labelledby="list-other-list">
<div class="card border">
    <div class="card-body">
        <form action="{{route('settings.other')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
           
            <div class="form-group">
                <label class="mandatory">Current Version</label>
                <input type="text" class="form-control" name="current_version" value="{{ $setting->current_version ?? '' }}">
            </div>
            <div class="form-group">
    <label>Maintenance Mode</label>
    <select name="maintenance_mode" class="form-control select2">
    <option value="">Select</option>
    <option value="0" {{ isset($setting) && $setting->maintenance_mode == 0 ? 'selected' : '' }}>ON</option>
    <option value="1" {{ isset($setting) && $setting->maintenance_mode == 1 ? 'selected' : '' }}>OFF</option>
</select>
</div>
            <div class="form-group">
                <label class="mandatory">Frontend Url</label>
                <input type="text" class="form-control" name="frontend_url" value="{{ $setting->frontend_url ?? '' }}">
            </div>
            <div class="form-group">
                    @if($setting && $setting->error)
    <img src="{{ asset(Storage::url($setting->error)) }}" width="50px" alt="Logo">
@else
    <img src="{{ asset('path_to_default_error') }}" width="50px" alt="Default Logo">
@endif
                    <br>
                    <label>404 image</label>
                    <input type="file" class="form-control" name="error" value="">
                    <input type="hidden" class="form-control" name="old_error" value="{{ $setting->error ?? '' }}">

                </div>
                 <div class="form-group">
                <label>Sidebar lg header</label>
                <input type="text" class="form-control" name="sidebar_lg_header" value="{{ $setting->sidebar_lg_header ?? '' }}">
            </div>
             <div class="form-group">
                <label>Sidebar sm header</label>
                <input type="text" class="form-control" name="sidebar_sm_header" value="{{ $setting->sidebar_sm_header ?? '' }}">
            </div>
                <br>

                       <div style="text-align: center;">
  <button type="submit" class="btn btn-primary">Update</button>
</div>
        </form>
    </div>
</div>
</div>
