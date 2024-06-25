<div class="tab-pane fade show active" id="list-email" role="tabpanel" aria-labelledby="list-email-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{route('settings.email')}}" method="POST">
                @csrf
                @method('PUT')
               
                <div class="form-group">
                    <label class="mandatory">Email</label>
                    <input type="email" class="form-control" required name="mail" value="{{ $emailconfiguration->mail ?? '' }}">
                </div>

                <div class="form-group">
                    <label class="mandatory">Host</label>
                    <input type="text" class="form-control" required name="mail_host" value="{{  $emailconfiguration->mail_host ?? '' }}">
                </div>
                
                <div class="form-group">
                    <label class="mandatory">Username</label>
                    <input type="text" class="form-control" required name="smtp_username" value="{{  $emailconfiguration->smtp_username ?? '' }}">
                </div>
                <div class="form-group">
                    <label class="mandatory">Password</label>
                    <input type="text" class="form-control" required name="smtp_password" value="{{  $emailconfiguration->smtp_password ?? '' }}">
                </div>
                <div class="form-group">
                    <label class="mandatory">Port</label>
                    <input type="text" class="form-control" required name="mail_port" value="{{  $emailconfiguration->mail_port ?? '' }}">
                </div>
                <div class="form-group">
                    <label class="mandatory">Encryption</label>
                    <input type="text" class="form-control" required name="mail_encryption" value="{{  $emailconfiguration->mail_encryption ?? '' }}">
                </div>

                    <div class="form-group">
                        <label class="mandatory">Status</label>
                    <select name="status" id="" class="form-control select2">
                        <option value="">Select</option>
                        @if( $emailconfiguration && $emailconfiguration->status == '1')
                        <option value="1" selected>Active</option>
                    @else
                        <option value="1">Active</option>
                    @endif

                    @if( $emailconfiguration && $emailconfiguration->status == '0')
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
    