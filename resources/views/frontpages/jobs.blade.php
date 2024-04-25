@extends('frontpages.layouts.base')

@section('body')

<section class="section-3 py-5 bg-2 ">
    <div class="container">     
        <div class="row">
            <div class="col-6 col-md-10 ">
                <h2>Find Jobs</h2>  
            </div>
            <div class="col-6 col-md-2">
                <div class="align-end">
                    <select name="sort" id="sort" class="form-control">
                        <option value="">Latest</option>
                        <option value="">Oldest</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row pt-5">
            <div class="col-md-4 col-lg-3 sidebar mb-4">
                <form>
                
                <div class="card border-0 shadow p-4">
                    <div class="mb-4">
                        <h2>Keywords</h2>
                        <input type="text" placeholder="Keywords or title" class="form-control" name="Keywords" value="{{Request::get('Keywords')}}">
                    </div>

                    <div class="mb-4">
                        <h2>Location</h2>
                        <input type="text" placeholder="Location" class="form-control" name="location" value="{{Request::get('location')}}">
                    </div>

                    <div class="mb-4">
                        <h2>Category</h2>
                        <select name="category" id="category" class="form-control">
                        @foreach($category as $cat)    
                        <option value="{{$cat->id}}" @if(Request::get('category') == $cat->id) selected @endif >{{$cat->name}}</option>
                         @endforeach   
                        </select>
                    </div>                   

                    <div class="mb-4">
                        <h2>Job Type</h2>
                        @foreach($j_types as $job_type)
                        <div class="form-check mb-2"> 
                            <input class="form-check-input " name="job_type" type="checkbox" value="{{$job_type->id}}" id="job-{{$job_type->id}}" @if(Request::get('job_type') == $job_type->id) checked @endif>    
                            <label class="form-check-label " for="job-{{$job_type->id}}">{{$job_type->name}}</label>
                        </div>

                        @endforeach

                        
                    </div>

                    <div class="mb-4">
                        <h2>Experience</h2>
                        <select name="experience" id="experience" class="form-control">
                            <option value="">---Select Experience---</option>
                            <option value="1" @if(Request::get('experience') == '1') selected @endif >1 Year</option>
                            <option value="2" @if(Request::get('experience') == '2') selected @endif >2 Years</option>
                            <option value="3" @if(Request::get('experience') == '3') selected @endif>3 Years</option>
                            <option value="4" @if(Request::get('experience') == '4') selected @endif>4 Years</option>
                            <option value="5" @if(Request::get('experience') == '5') selected @endif>5 Years</option>
                            <option value="6" @if(Request::get('experience') == '6') selected @endif>6 Years</option>
                            <option value="7" @if(Request::get('experience') == '7') selected @endif>7 Years</option>
                            <option value="8" @if(Request::get('experience') == '8') selected @endif>8 Years</option>
                            <option value="9" @if(Request::get('experience') == '9') selected @endif>9 Years</option>
                            <option value="10" @if(Request::get('experience') == '10') selected @endif>10 Years</option>
                            <option value="10+" @if(Request::get('experience') == '10+') selected @endif>10+ Years</option>
                        </select>
                    </div> 
                    <div class="d-grid mt-3">
                <button  class="btn btn-primary btn-lg">Details</button>
                </div>                   
                </div>
                
                </form>
            </div>
            <div class="col-md-8 col-lg-9 ">
                <div class="job_listing_area">                    
                    <div class="job_lists">
                    <div class="row">
                    @if($jobs->isNotEmpty())
                        @foreach($jobs as $job)
                        <div class="col-md-4">
                            <div class="card border-0 p-3 shadow mb-4">
                                <div class="card-body">
                                    <h3 class="border-0 fs-5 pb-2 mb-0">{{$job->title}}</h3>
                                    <p>{{Str::words($job->description, 10)}}</p>
                                    <div class="bg-light p-3 border">
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                            <span class="ps-1">{{$job->location}}</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                            <span class="ps-1">{{$job->jobNature->name}}</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                            <span class="ps-1">{{$job->salary}}/month</span>
                                        </p>
                                    </div>

                                    <div class="d-grid mt-3">
                                        <a href="{{route('job.details',$job->id)}}" class="btn btn-primary btn-lg">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                    <h1 style="color:red;">No Records Found ...</h1>
                    @endif    
                                                 
                    </div>
                    </div>
                </div>
                <div>
                    {{$jobs->links()}}
                </div>
            </div>
            
        </div>
    </div>
</section>

@endsection