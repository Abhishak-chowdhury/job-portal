@extends('frontpages.layouts.base')

@section('body')

<section class="section-4 bg-2">    
    <div class="container pt-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{route('jobs')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Back to Jobs</a></li>
                    </ol>
                </nav>
            </div>
        </div> 
    </div>
    <div class="container job_details_area">
        <div class="row pb-5">
            <div class="col-md-8">
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                <strong>{{session()->get('success')}}</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if(session()->has('warning'))
            <div class="alert alert-warning alert-dismissible fade show mb-3" role="alert">
                <strong>{{session()->get('warning')}}</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
                <div class="card shadow border-0">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                
                                <div class="jobs_conetent">
                                    
                                        <h4>{{$job->title}}</h4>
                                    
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p> <i class="fa fa-map-marker"></i> {{$job->location}}, India</p>
                                        </div>
                                        <div class="location">
                                            <p> <i class="fa fa-clock-o"></i> {{$job->jobNature->name}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="jobs_right">
                                <div class="apply_now">
                                    @if(empty($saved_job_or_not))
                                        <a class="heart_mark" href="{{route('save.job').'?job_id='.$job->id}}"> <i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                    @else
                                    <a class="heart_mark" style="background-color:#00D363;"> <i class="fa fa-heart-o" aria-hidden="true" style="color:#fff;"></i></a>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="descript_wrap white-bg">
                        @if(!empty($job->description))
                        <div class="single_wrap">
                            <h4>Job description</h4>
                            <p>{!! nl2br($job->description) !!}</p>
                            
                        </div>
                        @endif
                        @if(!empty($job->responsibility))
                        <div class="single_wrap">
                            <h4>Responsibility</h4>
                            <p>{!! nl2br($job->responsibility) !!}</p>
                        </div>
                        @endif
                        @if(!empty($job->qualifications))
                        <div class="single_wrap">
                            <h4>Qualifications</h4>
                            <p>{!! nl2br($job->qualifications) !!}</p>
                        </div>
                        @endif
                        @if(!empty($job->benefits))
                        <div class="single_wrap">
                            <h4>Benefits</h4>
                            <p>{!! nl2br($job->benefits) !!}</p>
                        </div>
                        @endif
                        <div class="border-bottom"></div>
                        <div class="pt-3 text-end" style="display:flex;justify-content: end; gap:10px">
                            @if(Auth::check()) 
                            <form action="{{route('save.job')}}" method="post">
                                @csrf
                                <input type="hidden" name="job_id" value="{{$job->id}}">
                            <button type="submit" class="btn btn-secondary">Save</button>
                            </form>
                            @else
                            <button type="submit" class="btn btn-secondary" disabled>Save</button>
                            @endif
                            @if(Auth::check())
                            <form action="{{route('job.applay')}}" method="post">
                                @csrf
                                <input type="hidden" name="job_id" value="{{$job->id}}">
                            <button type="submit" class="btn btn-primary">Apply</button>
                            </form>
                            @else
                            <button class="btn btn-primary" disabled>Login to Apply</button>
                            @endif
                        </div>
                    </div>
                </div>
                @if(Auth::user()->id == $job->user_id)
                <div class="card shadow border-0 mt-3">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                        <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Applied Date</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        @if($job_apply_users->isEmpty())
                        <tr>
                            <td colspan='3'>No records found.</td>
                        </tr>
                        @else
                            @foreach($job_apply_users as $job_apply_user)
                            <tr>
                            <th scope="row">{{$job_apply_user->user->name}}</th>
                            <td>{{$job_apply_user->user->email}}</td>
                            @if(empty($job_apply_user->user->mobile))
                            <td>Null</td>
                            @else
                            <td>{{$job_apply_user->user->mobile}}</td>
                            @endif
                            <td>{{ Carbon\Carbon::parse($job_apply_user->applied_time)->format('d/m/Y ') }}</td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                        
                        </table>
                        </div>
                    </div>
                    
                </div>
                @endif
            </div>
            <div class="col-md-4">
                <div class="card shadow border-0">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Job Summery</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                <li>Published on: <span>{{ Carbon\Carbon::parse($job->created_at)->format('d/m/Y') }}</span></li>
                                <li>Vacancy: <span>{{$job->vacancy}} Position</span></li>
                                @if(!empty($job->salary))
                                <li>Salary: <span>{{$job->salary}}/Month</span></li>
                                @endif
                                <li>Location: <span>{{$job->location}}, INDIA</span></li>
                                <li>Job Nature: <span> {{$job->jobNature->name}}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card shadow border-0 my-4">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Company Details</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                <li>Name: <span>{{$job->company_name}}</span></li>
                                <li>Locaion: <span>{{$job->company_location}}</span></li>
                                <li>Webite: <span><a href="https:{{$job->company_website}}">{{$job->company_website}}</a></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection