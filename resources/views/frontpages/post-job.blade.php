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
                <div class="card border-0 shadow mb-4 ">
                <form action="{{route('posts-process')}}" method="post">
                    @csrf
                    <div class="card-body card-form p-4">
                        <h3 class="fs-4 mb-1">Job Details</h3>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="title" class="mb-2">Title<span class="req">*</span></label>
                                <input type="text" placeholder="Job Title" id="title" name="title" class="form-control" value="{{old('title')}}">
                                @error('title')
                                <p style="color:red;font-size:13px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6  mb-4">
                                <label for="category" class="mb-2">Category<span class="req">*</span></label>
                                <select name="category" id="category" class="form-control">
                                    <option value="">---- Select a Category ----</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <p style="color:red;font-size:13px;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="j_roll" class="mb-2">Job Nature<span class="req">*</span></label>
                                <select name="job_roll" class="form-select" id="j_roll">
                                @foreach($job_rolls as $job_roll)    
                                <option value="{{$job_roll->id}}">{{$job_roll->name}}</option>
                                 @endforeach   
                                </select>
                                @error('job_roll')
                                <p style="color:red;font-size:13px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6  mb-4">
                                <label for="vacancy" class="mb-2">Vacancy<span class="req">*</span></label>
                                <input type="number" min="1" placeholder="Vacancy" id="vacancy" name="vacancy" class="form-control" value="{{old('vacancy')}}">
                                @error('vacancy')
                                <p style="color:red;font-size:13px;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-4 col-md-6">
                                <label for="salary" class="mb-2">Salary</label>
                                <input type="text" placeholder="Salary" id="salary" name="salary" class="form-control">
                            </div>

                            <div class="mb-4 col-md-6">
                                <label for="location" class="mb-2">Location<span class="req">*</span></label>
                                <input type="text" placeholder="location" id="location" name="location" class="form-control" value="{{old('location')}}">
                                @error('location')
                                <p style="color:red;font-size:13px;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="mb-2">Description<span class="req">*</span></label>
                            <textarea class="trumbowyg-demo" name="description" id="description" cols="5" rows="5" placeholder="Description">{{old('description')}}</textarea>
                            @error('description')
                                <p style="color:red;font-size:13px;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                                <label for="exprience" class="mb-2">Job Nature<span class="req">*</span></label>
                                <select name="exprience" class="form-select" id="exprience">
                                   
                                <option value="1">1 year</option>
                                <option value="2">2 year</option>
                                <option value="3">3 year</option>
                                <option value="4">4 year</option>
                                <option value="5">5 year</option>
                                <option value="6">6 year</option>
                                <option value="7">7 year</option>
                                <option value="8">8 year</option>

                                <option value="9">9 year</option>
                                <option value="10">10 year</option>
                                <option value="10+">10+ year</option>
                                    
                                </select>
                                @error('exprience')
                                <p style="color:red;font-size:13px;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="benefits" class="mb-2">Benefits</label>
                            <textarea class="trumbowyg-demo" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="responsibility" class="mb-2">Responsibility</label>
                            <textarea class="trumbowyg-demo" name="responsibility" id="responsibility" cols="5" rows="5" placeholder="Responsibility"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="qualifications" class="mb-2">Qualifications</label>
                            <textarea class="trumbowyg-demo" name="qualifications" id="qualifications" cols="5" rows="5" placeholder="Qualifications"></textarea>
                        </div>
                        
                        

                        <div class="mb-4">
                            <label for="keywords" class="mb-2">Keywords<span class="req">*</span></label>
                            <input type="text" placeholder="keywords" id="keywords" name="keywords" class="form-control">
                        </div>

                        <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>

                        <div class="row">
                            <div class="mb-4 col-md-6">
                                <label for="company_name" class="mb-2">Name<span class="req">*</span></label>
                                <input type="text" placeholder="Company Name" id="company_name" name="company_name" class="form-control">
                            </div>

                            <div class="mb-4 col-md-6">
                                <label for="company_location" class="mb-2">Location</label>
                                <input type="text" placeholder="Location" id="company_location" name="company_location" class="form-control">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="company_website" class="mb-2">Website</label>
                            <input type="text" placeholder="Website" id="company_website" name="company_website" class="form-control">
                        </div>
                    </div> 
                    <div class="card-footer  p-4">
                        <button type="submit" class="btn btn-primary">Save Job</button>
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