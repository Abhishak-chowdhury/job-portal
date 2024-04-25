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
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                <strong>{{session()->get('success')}}</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
                <div class="card border-0 shadow mb-4 p-3">
                    <div class="card-body card-form">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="fs-4 mb-1">Saved Jobs</h3>
                            </div>
                            <div style="margin-top: -10px;">
                                <a href="post-job.html" class="btn btn-primary">Jobs Applied</a>
                            </div>
                            
                        </div>
                        <div class="table-responsive">
                            @if($saved_jobs->isEmpty())
                            <h1 style="color:red;font-size:25px">No Data Is Available. Please saved a job</h1>
                            @else
                            <table class="table ">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Job applied</th>
                                        <th scope="col">Applicants</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @foreach($saved_jobs as $jb)
                                    <tr class="active">
                                        <td>
                                            <div class="job-name fw-500">{{$jb->job->title}}</div>
                                            <div class="info1">{{$jb->job->jobNature->name}} . {{$jb->job->location}}</div>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($jb->created_at)->format('d/m/Y')}}</td>
                                        <td>{{$jb->job->jobapply->count()}} Applications</td>
                                        <td>
                                            @if($jb->job->status==1)
                                            <div class="job-status text-capitalize">active</div>
                                            @else
                                            <div class="job-status text-capitalize">ended</div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="action-dots float-end">
                                                <a href="#" class="" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="{{route('job.details',$jb->id)}}"> <i class="fa fa-eye" aria-hidden="true"></i>View</a></li>
                                                    <li><a class="dropdown-item" href="{{route('delete.savejob',$jb->id)}}"> <i class="fa fa-trash" aria-hidden="true"></i>Remove</a></li>
                                                    
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
                            @endif
                        </div>
                    </div>
                    <div>
                    {{ $saved_jobs->links() }}
                    </div>
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