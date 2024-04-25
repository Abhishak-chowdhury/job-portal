@extends('frontpages.layouts.base')

@section('body')

<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <!-- this portion is side navbar -->
            @include('frontpages.admin.sidenav')
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
                                <h3 class="fs-4 mb-1">All jobs</h3>
                            </div>
                            
                            
                        </div>
                        @if($jobs->isNotEmpty())
                        <div class="table-responsive">
                            
                            <table class="table ">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">created by</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @foreach($jobs as $job)
                                    <tr class="active">
                                        <td>
                                            <div class="job-name fw-500">{{$job->id}}</div>
                                            
                                        </td>
                                        <td><p style="font-weight: 800;">{{$job->title}}</p>
                                        <p>Application : {{$job->jobapply->count()}}</p>
                                    </td>
                                        <td>{{$job->user->name}}</td>
                                        
                                        <td>
                                        {{ Carbon\Carbon::parse($job->created_at)->format('d-m-Y h:m:s') }}

                                        </td>
                                        @if($job->status=='1')
                                        <td>
                                            <form action="{{route('job.status')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="job_id" value="{{$job->id}}">
                                            <button style="background-color:green;color:#fff;border:none;">Active</button>
                                            </form>
                                        </td>
                                        @else
                                        <td>
                                        <form action="{{route('job.status')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="job_id" value="{{$job->id}}">
                                                <button style="background-color:red;color:#fff;border:none;">Block</button>
                                            </form>
                                        </td>
                                        @endif
                                        <td>
                                        <div class="action-dots float-end">
                                                <a href="#" class="" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="{{route('job.details',$job->id)}}"> <i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
                                                    
                                                    <li><a class="dropdown-item" href="{{route('delete.job',$job->id)}}"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach    
                                </tbody>
                                
                            </table>
                        </div>
                        @else
                        <h1 style="color:red;">No data is available</h1>
                        @endif
                    </div>
                    <!-- add pagination -->
                    <div style="display:flex;justify-content:flex-end;">
                        {{$jobs->links()}}
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