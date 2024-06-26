@extends('Admin.layouts.app')
@section('content')
{{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> --}}

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="profile-bg-picture"
                        style="background-image:url('assets/images/bg-profile.jpg')">
                        <span class="picture-bg-overlay"></span>
                        <!-- overlay -->
                    </div>
                    <!-- meta -->
                    <div class="profile-user-box">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="profile-user-img"><img src="{{ asset('storage/' . $user->image) }}" alt=""
                                        class="avatar-lg rounded-circle " ></div>
                                <div class="">
                                    <h4 class="mt-4 fs-17 ellipsis">{{$user->name}}</h4>
                                    {{-- <p class="font-13"> User Experience Specialist</p>
                                    <p class="text-muted mb-0"><small>California, United States</small></p> --}}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex justify-content-end align-items-center gap-2">
                                    <a href="{{route('accountsetting.profile')}}"type="button" class="btn btn-soft-danger">
                                        <i class="ri-settings-2-line align-text-bottom me-1 fs-16 lh-1"></i>
                                        Edit Profile
                                    </a>
                                    {{-- <a class="btn btn-soft-info" href="#"> <i class="ri-check-double-fill fs-18 me-1 lh-1"></i> Following</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ meta -->
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="card p-0">
                        <div class="card-body p-0">
                            <div class="profile-content">
                                <ul class="nav nav-underline nav-justified gap-0">
                                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#aboutme" type="button" role="tab"
                                            aria-controls="home" aria-selected="true" href="#aboutme">About</a>
                                    </li>
                                    {{-- <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#user-activities" type="button" role="tab"
                                            aria-controls="home" aria-selected="true"
                                            href="#user-activities">Activities</a></li> --}}
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#edit-profile" type="button" role="tab"
                                            aria-controls="home" aria-selected="true"
                                            href="#edit-profile">Change Password</a></li>
                                    {{-- <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#projects" type="button" role="tab"
                                            aria-controls="home" aria-selected="true"
                                            href="#projects">Projects</a></li> --}}
                                </ul>

                                <div class="tab-content m-0 p-4">
                                    <div class="tab-pane active" id="aboutme" role="tabpanel"
                                        aria-labelledby="home-tab" tabindex="0">
                                        <div class="profile-desk">
                                            <h5 class="text-uppercase fs-17 text-dark">{{$user->name}}</h5>
                                            

                                            <h5 class="mt-4 fs-17 text-dark">Contact Information</h5>
                                            <table class="table table-condensed mb-0 border-top">
                                                <tbody>
                                                    <tr>
                                                        
                                                     
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Email</th>
                                                        <td>
                                                            <a href="" class="ng-binding">
                                                               {{$user->email}}
                                                            </a>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">Phone</th>
                                                        <td class="ng-binding"> {{$user->phone}}</td>
                                                    </tr>
                                                   
                                                </tbody>
                                            </table>
                                        </div> <!-- end profile-desk -->
                                    </div> <!-- about-me -->

                                    <!-- Activities -->
                                    {{-- <div id="user-activities" class="tab-pane">
                                        <div class="timeline-2">
                                            <div class="time-item">
                                                <div class="item-info ms-3 mb-3">
                                                    <div class="text-muted">5 minutes ago</div>
                                                    <p><strong><a href="#" class="text-info">John
                                                                Doe</a></strong>Uploaded a photo</p>
                                                    <img src="assets/images/small/small-3.jpg" alt=""
                                                        height="40" width="60" class="rounded-1">
                                                    <img src="assets/images/small/small-4.jpg" alt=""
                                                        height="40" width="60" class="rounded-1">
                                                </div>
                                            </div>

                                            <div class="time-item">
                                                <div class="item-info ms-3 mb-3">
                                                    <div class="text-muted">30 minutes ago</div>
                                                    <p><a href="" class="text-info">Lorem</a> commented your
                                                        post.
                                                    </p>
                                                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing
                                                            elit.
                                                            Aliquam laoreet tellus ut tincidunt euismod. "</em>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="time-item">
                                                <div class="item-info ms-3 mb-3">
                                                    <div class="text-muted">59 minutes ago</div>
                                                    <p><a href="" class="text-info">Jessi</a> attended a meeting
                                                        with<a href="#" class="text-success">John Doe</a>.</p>
                                                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing
                                                            elit.
                                                            Aliquam laoreet tellus ut tincidunt euismod. "</em>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="time-item">
                                                <div class="item-info ms-3 mb-3">
                                                    <div class="text-muted">5 minutes ago</div>
                                                    <p><strong><a href="#" class="text-info">John
                                                                Doe</a></strong> Uploaded 2 new photos</p>
                                                    <img src="assets/images/small/small-2.jpg" alt=""
                                                        height="40" width="60" class="rounded-1">
                                                    <img src="assets/images/small/small-1.jpg" alt=""
                                                        height="40" width="60" class="rounded-1">
                                                </div>
                                            </div>

                                            <div class="time-item">
                                                <div class="item-info ms-3 mb-3">
                                                    <div class="text-muted">30 minutes ago</div>
                                                    <p><a href="" class="text-info">Lorem</a> commented your
                                                        post.
                                                    </p>
                                                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing
                                                            elit.
                                                            Aliquam laoreet tellus ut tincidunt euismod. "</em>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="time-item">
                                                <div class="item-info ms-3 mb-3">
                                                    <div class="text-muted">59 minutes ago</div>
                                                    <p><a href="" class="text-info">Jessi</a> attended a meeting
                                                        with<a href="#" class="text-success">John Doe</a>.</p>
                                                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing
                                                            elit.
                                                            Aliquam laoreet tellus ut tincidunt euismod. "</em>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <!-- settings -->
                                    <div id="edit-profile" class="tab-pane">
                                        <div class="user-profile-content">
                                            <form action="{{ route('adminaccount.changepassword') }}" method="POST">
                                                @csrf
                                                <div class="row row-cols-sm-2 row-cols-1">
                                                
                                                    <div class="mb-3" style="position: relative;">
                                                        <label class="form-label"
                                                            for="Password">Old Password</label>
                                                        <input type="password" placeholder="6 - 15 Characters"
                                                            id="old_password" class="form-control" name="old_password">
                                                            <button type="button" class="btn" onclick="togglePasswordVisibility('old_password', 'toggleOldPasswordIcon')" style="position: absolute; right: 10px; top: 70%; transform: translateY(-50%); border: none; background: none;">
                                                                <i id="toggleOldPasswordIcon" class="bi bi-eye"></i>
                                                            </button>
                                                            @error('old_password')
                                                            <span class="error" style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3" style="position: relative;">
                                                        <label class="form-label"
                                                            for="RePassword">New Password</label>
                                                        <input type="password" placeholder="6 - 15 Characters"
                                                        id="new_password" name="new_password" class="form-control">
                                                        <button type="button" class="btn" onclick="togglePasswordVisibility('new_password', 'toggleNewPasswordIcon')" style="position: absolute; right: 10px; top: 70%; transform: translateY(-50%); border: none; background: none;">
                                                            <i id="toggleNewPasswordIcon" class="bi bi-eye"></i>
                                                        </button>
                                                        @error('new_password')
                                                        <span class="error" style="color: red;">{{ $message }}</span>
                                                    @enderror
                                                    </div>

                                                    <div class="mb-3" style="position: relative;">
                                                        <label class="form-label"
                                                            for="RePassword">Confirm Password</label>
                                                        <input type="password" placeholder="6 - 15 Characters"
                                                        id="new_password_confirmation" name="new_password_confirmation" class="form-control">
                                                        <button type="button" class="btn" onclick="togglePasswordVisibility('new_password_confirmation', 'toggleConfirmPasswordIcon')" style="position: absolute; right: 10px; top: 70%; transform: translateY(-50%); border: none; background: none;">
                                                            <i id="toggleConfirmPasswordIcon" class="bi bi-eye"></i>
                                                        </button>
                                                        @error('new_password_confirmation')
                                                        <span class="error" style="color: red;">{{ $message }}</span>
                                                    @enderror
                                                    </div>
                                                  
                                                </div>
                                                <button class="btn btn-primary" type="submit"><i
                                                        class="ri-save-line me-1 fs-16 lh-1"></i> Save</button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- profile -->
                                    {{-- <div id="projects" class="tab-pane">
                                        <div class="row m-t-10">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Project Name</th>
                                                                <th>Start Date</th>
                                                                <th>Due Date</th>
                                                                <th>Status</th>
                                                                <th>Assign</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>Velonic Admin</td>
                                                                <td>01/01/2015</td>
                                                                <td>07/05/2015</td>
                                                                <td><span class="badge bg-info">Work
                                                                        in Progress</span></td>
                                                                <td>Techzaa</td>
                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td>Velonic Frontend</td>
                                                                <td>01/01/2015</td>
                                                                <td>07/05/2015</td>
                                                                <td><span
                                                                        class="badge bg-success">Pending</span>
                                                                </td>
                                                                <td>Techzaa</td>
                                                            </tr>
                                                            <tr>
                                                                <td>3</td>
                                                                <td>Velonic Admin</td>
                                                                <td>01/01/2015</td>
                                                                <td>07/05/2015</td>
                                                                <td><span class="badge bg-pink">Done</span>
                                                                </td>
                                                                <td>Techzaa</td>
                                                            </tr>
                                                            <tr>
                                                                <td>4</td>
                                                                <td>Velonic Frontend</td>
                                                                <td>01/01/2015</td>
                                                                <td>07/05/2015</td>
                                                                <td><span class="badge bg-purple">Work
                                                                        in Progress</span></td>
                                                                <td>Techzaa</td>
                                                            </tr>
                                                            <tr>
                                                                <td>5</td>
                                                                <td>Velonic Admin</td>
                                                                <td>01/01/2015</td>
                                                                <td>07/05/2015</td>
                                                                <td><span class="badge bg-warning">Coming
                                                                        soon</span></td>
                                                                <td>Techzaa</td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

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
        <!-- end row -->

    </div>
    <!-- container -->

</div>


<script>
    function togglePasswordVisibility(fieldId, iconId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById(iconId);
        const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
        field.setAttribute('type', type);
        icon.classList.toggle('bi-eye');
        icon.classList.toggle('bi-eye-slash');
    }
</script>

@endsection



