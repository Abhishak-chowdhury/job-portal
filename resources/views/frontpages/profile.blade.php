@extends('frontpages.layouts.base')

@section('body')

<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Account Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <!-- this portion is side navbar -->
            @include('frontpages.layouts.side-nav')
            <!-- this portion is rest things -->
            <div class="col-lg-9">
                @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session()->get('success')}}</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if(session()->has('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{session()->get('warning')}}</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif


                <div class="card border-0 shadow mb-4">
                    <form action="{{route('update.profile')}}" method="post">
                        @csrf
                    <div class="card-body  p-4">
                        <h3 class="fs-4 mb-1">My Profile</h3>
                        <div class="mb-4">
                            <label for="" class="mb-2">Name*</label>
                            <input type="text" name="name" placeholder="Enter Name" class="form-control" value="{{$user->name}}">
                            @error('name')
                            <p style="color:red;font-size:13px;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Email*</label>
                            <input type="text" name="email" placeholder="Enter Email" class="form-control" value="{{$user->email}}" readonly>
                            @error('email')
                            <p style="color:red;font-size:13px;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Designation*</label>
                            <input type="text" name="designation" placeholder="Designation" class="form-control" @if($user->designation) value="{{$user->designation}}" @else value="{{old('designation')}}" @endif>
                            @error('designation')
                            <p style="color:red;font-size:13px;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Mobile*</label>
                            <input type="text" name="mobile" placeholder="Mobile" class="form-control"  @if($user->mobile) value="{{$user->mobile}}" @else value="{{old('mobile')}}" @endif>
                            @error('mobile')
                            <p style="color:red;font-size:13px;">{{ $message }}</p>
                            @enderror
                        </div>                        
                    </div>
                    <div class="card-footer  p-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>

                <div class="card border-0 shadow mb-4">
                    <div class="card-body p-4">
                        <h3 class="fs-4 mb-1">Change Password</h3>
                        <form action="{{route('change.password')}}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="" class="mb-2">Old Password*</label>
                            <input type="password" placeholder="Old Password" class="form-control" name="old_password">
                            @error('old_password')
                            <p style="color:red;font-size:13px;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">New Password*</label>
                            <input type="password" placeholder="New Password" class="form-control" name="new_password">
                            @error('new_password')
                            <p style="color:red;font-size:13px;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Confirm Password*</label>
                            <input type="password" placeholder="Confirm Password" class="form-control" name="confirm_password">
                            @error('confirm_password')
                            <p style="color:red;font-size:13px;">{{ $message }}</p>
                            @enderror
                        </div>  
                                              
                    </div>
                    <div class="card-footer  p-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>                
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title pb-0" id="exampleModalLabel">Change Profile Picture</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('upload.image')}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Profile Image</label>
                <input type="file" class="form-control" id="image"  name="image">
                
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mx-3">Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            
        </form>
      </div>
    </div>
  </div>
</div>

@endsection