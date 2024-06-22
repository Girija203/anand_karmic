<div class="tab-pane fade show active" id="list-theme" role="tabpanel" aria-labelledby="list-theme-list">
<div class="card border">
    <div class="card-body">
        <form action="{{route('settings.theme')}}" method="POST">
            @csrf
            @method('PUT')
           

            <div class="form-group">
                <label>Primary Color</label>
                <input type="color" class="form-control" name="primary_color" value="{{ $setting->primary_color ?? '#000000' }}">
            </div>
            <div class="form-group">
                <label>Secondary Color</label>
                <input type="color" class="form-control" name="secondary_color" value="{{ $setting->secondary_color ?? '#000000' }}">
            </div>
            <br>
            <div style="text-align: center;">
  <button type="submit" class="btn btn-primary">Update</button>
</div>
        </form>
    </div>
</div>
</div>
