@extends('frontend.layouts.app')
@section('content')

<main class="pt-4">
   <section class="breadcrumb-section">
      {{-- 
      <div class="breadcrumb-image">
         <img src="{{asset('assets/images/banners/breadcrumb_bag.jpg')}}" alt="breadcrumb bg" width="1920" height="292" />
      </div>
      --}}
      <div class="text-center">
         <h2 class="mb-2">My Accounts</h2>
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
               <li class="breadcrumb-item"><a href="#">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">
                  My Accounts
               </li>
            </ol>
         </nav>
      </div>
   </section>
   <section class="my-account-page section-space-ptb border-bottom-1">
      <div class="container">
         <div class="row">
            <div class="col-12">
               <div class="account-dashboard fs-16">
                  <div class="dashboard-upper-info">
                     <div class="row align-items-center no-gutters">
                        <div class="col-lg-3 col-md-12">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12 col-lg-2">
                        <!-- Nav tabs -->
                        <ul role="tablist" class="nav flex-column dashboard-list">
                           <li>
                              <a href="#dashboard" data-bs-toggle="tab" class="nav-link active"
                                 aria-selected="true" role="tab">Dashboard</a>
                           </li>
                           <li>
                              <a href="#orders" data-bs-toggle="tab" class="nav-link" aria-selected="false"
                                 tabindex="-1" role="tab">Orders</a>
                           </li>
                           <li>
                              <a href="#address" data-bs-toggle="tab" class="nav-link" aria-selected="false"
                                 tabindex="-1" role="tab">Addresses</a>
                           </li>
                           <li>
                              <a href="#account" data-bs-toggle="tab" class="nav-link" aria-selected="false"
                                 tabindex="-1" role="tab">Account Setting</a>
                           </li>
                           <li>
                              <a href="{{ route('user.logout') }}" class="nav-link" aria-selected="false"
                                 tabindex="-1" role="tab">logout</a>
                           </li>
                        </ul>
                     </div>
                     <div class="col-md-12 col-lg-10">
                        <!-- Tab panes -->
                        <div class="tab-content dashboard-content">
                           <div class="tab-pane active" id="dashboard" role="tabpanel">
                              <h3>Dashboard</h3>
                              <p>
                                 Hello, <span>{{ $user->name ?? '' }}</span>
                              </p>
                           </div>
                           <div class="tab-pane fade" id="orders" role="tabpanel">
                              <h3>Orders</h3>
                              <div class="table-responsive">
                                 <table class="table">
                                    <thead>
                                       <tr>
                                          <th>Order</th>
                                          <th>Date</th>
                                          <th>Status</th>
                                          <th>Total</th>
                                          <th>Actions</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($order as $orders)
                                       <tr>
                                          <td>{{ $orders->id }}</td>
                                          <td>{{ $orders->created_at->format('F d, Y') }}</td>
                                          <td>
                                             @switch($orders->order_status)
                                             @case(0)
                                             Pending
                                             @break
                                             @case(1)
                                             In Progress
                                             @break
                                             @case(2)
                                             Delivered
                                             @break
                                             @case(3)
                                             Complete
                                             @break
                                             @case(4)
                                             Declined
                                             @break
                                             @default
                                             Unknown Status
                                             @endswitch
                                          </td>
                                          <td>${{ number_format($orders->total_amount, 2) }} for
                                             {{ $orders->product_qty }} item(s)
                                          </td>
                                          <td>
                                             <a href="" class="view">view</a>
                                          </td>
                                       </tr>
                                       @endforeach
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                           <!--my account-->
                           <div id="account" class="tab-pane" role="tabpanel">
                           <form method="POST" action="{{route('profile.update')}}"  enctype="multipart/form-data">
                              @csrf
                              <div class="p-2">
                                 <div class="container">
                                    <div class="picture-container">
                                       <div class="picture">
                                          @if (!empty($user->image))
                                          <img src="{{ asset('storage/' . $user->image) }}" class="rounded-circle p-1 bg-primary" height="110" width="110" id="wizardPicturePreview" title="">
                                          @else
                                          <img src="" class="picture-src rounded-circle" id="wizardPicturePreview" title="" style="display: none;">
                                          @endif
                                          <input type="file" name="image" id="wizard-picture" class="">
                                       </div>
                                       <h6 class="">Choose Picture</h6>
                                       <p style="color: red;">500x500</p>
                                    </div>
                                 </div>
                              </div>
                              <div class="row mb-3">
                                 <div class="col-sm-3">
                                    <h6 class="mb-0">Name</h6>
                                 </div>
                                 <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" name="name" value="{{$user->name}}" placeholder="First Name" required>
                                 </div>
                              </div>
                              <div class="row mb-3">
                                 <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                 </div>
                                 <div class="col-sm-9 text-secondary">
                                    <input type="email" class="form-control" name="email" value="{{$user->email}}" required>
                                 </div>
                              </div>
                              <div class="row mb-3">
                                 <div class="col-sm-3">
                                    <h6 class="mb-0">Mobile</h6>
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
                           <hr>
                           <h3>Change Password</h3>

                           <form action="{{ route('account.changepassword') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-3">
                                
                                    <label for="old_password">Old Password</label>
                                </div>
                                <div class="col-lg-9">
                                    <div style="position: relative;">
                                        <input type="password" id="old_password" name="old_password" class="form-control">
                                        <button type="button" class="btn" onclick="togglePasswordVisibility('old_password', 'toggleOldPasswordIcon')" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); border: none; background: none;">
                                            <i id="toggleOldPasswordIcon" class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('old_password')
                                    <span class="error" style="color: red;">{{ $message }}</span>
                                @enderror
                                </div>
                              
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-3">

                                    <label for="new_password">New Password</label>
                                </div>
                               <div class="col-lg-9">
                                <div style="position: relative;">
                                    <input type="password" id="new_password" name="new_password" class="form-control">
                                    <button type="button" class="btn" onclick="togglePasswordVisibility('new_password', 'toggleNewPasswordIcon')" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); border: none; background: none;">
                                        <i id="toggleNewPasswordIcon" class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('new_password')
                                    <span class="error" style="color: red;">{{ $message }}</span>
                                @enderror
                               </div>
                                
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-3">

                                    <label for="new_password_confirmation">Confirm New Password</label>
                                </div>
                                <div class="col-lg-9">
                                    <div style="position: relative;">
                                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control">
                                        <button type="button" class="btn" onclick="togglePasswordVisibility('new_password_confirmation', 'toggleConfirmPasswordIcon')" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); border: none; background: none;">
                                            <i id="toggleConfirmPasswordIcon" class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('new_password_confirmation')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                            </div>
                            <div class="row" style="margin-top:18px !important;">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                   <button type="submit" class="btn btn-primary px-4">Change Password</button>
                                </div>
                             </div>
                        </form>
                        
                           </div>
                           <!-- modal start -->
                           <!-- Edit Address Modal -->
                           <div class="modal fade" id="editAddressModal" tabindex="-1" role="dialog"
                              aria-labelledby="editAddressModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                    <form id="editAddressForm" action="{{ route('update.address') }}"
                                       method="POST">
                                       @csrf
                                       @method('PUT')
                                       <div class="modal-header">
                                          <h5 class="modal-title" id="editAddressModalLabel">Edit Address
                                          </h5>
                                          <button type="button" class="close" data-dismiss="modal"
                                             aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                          </button>
                                       </div>
                                       <div class="modal-body">
                                          <input type="hidden" name="id" id="address-id">
                                          <div class="form-group">
                                             <label for="address-name">Name</label>
                                             <input type="text" class="form-control" id="address-name"
                                                name="name" required>
                                          </div>
                                          <div class="form-group">
                                             <label for="address-address">Address</label>
                                             <input type="text" class="form-control"
                                                id="address-address" name="address" required>
                                          </div>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary"
                                             data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Save
                                          changes</button>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                           <!-- modal end -->
                           <div class="tab-pane" id="address" role="tabpanel">
                              <p>
                                 The following addresses will be used on the checkout
                                 page by default.
                              </p>
                              @if ($address)
                              @foreach ($address as $addresses)
                              <h4 class="billing-address">Billing address</h4>
                              <button class="view" data-toggle="modal"
                                 data-target="#editAddressModal" data-id="{{ $addresses->id }}"
                                 data-name="{{ $addresses->name }}"
                                 data-address="{{ $addresses->address }}">edit</button>
                              <p class="biller-name">{{ $addresses->name }}</p>
                              <p>{{ $addresses->address }}</p>
                              @endforeach
                              @else
                              <p>No addresses found.</p>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
   </section>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
   $('#editAddressModal').on('show.bs.modal', function(event) {
       var button = $(event.relatedTarget);
       var id = button.data('id');
       var name = button.data('name');
       var address = button.data('address');
   
       var modal = $(this);
       modal.find('#address-id').val(id);
       modal.find('#address-name').val(name);
       modal.find('#address-address').val(address);
   });
</script>

<script>
    function togglePasswordVisibility(fieldId, iconId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById(iconId);
        const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
        field.setAttribute('type', type);
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    }
</script>

@endsection