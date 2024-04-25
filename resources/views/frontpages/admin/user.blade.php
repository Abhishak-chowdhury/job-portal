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
                                <h3 class="fs-4 mb-1">All users</h3>
                            </div>
                            
                            
                        </div>
                        @if($users->isNotEmpty())
                        <div class="table-responsive">
                            
                            <table class="table ">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Mobile</th>
                                        <th scope="col">Created At</th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @foreach($users as $ur)
                                    <tr class="active">
                                        <td>
                                            <div class="job-name fw-500">{{$ur->id}}</div>
                                            
                                        </td>
                                        <td>{{$ur->name}}</td>
                                        <td>{{$ur->email}}</td>
                                        <td>
                                            @if(empty($ur->mobile))
                                            <div class="job-status text-capitalize">Null</div>
                                            @else
                                            <div class="job-status text-capitalize">{{$ur->mobile}}</div>
                                            @endif
                                        </td>
                                        <td>
                                        {{ Carbon\Carbon::parse($ur->created_at)->format('d-m-Y h:m:s') }}

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
                        {{$users->links()}}
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