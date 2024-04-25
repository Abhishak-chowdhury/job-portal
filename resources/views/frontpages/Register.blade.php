@extends('frontpages.layouts.base')

@section('body')

<section class="section-5">
    <div class="container my-5">
        <div class="py-lg-2">&nbsp;</div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h1 class="h3">Register</h1>
                    <form action="{{route('register.process')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="mb-2">Name*</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" value="{{old('name')}}">
                            @error('name')
                            <p style="color:red;font-size:13px;">{{ $message }}</p>
                            @enderror
                        </div> 
                        <div class="mb-3">
                            <label for="email" class="mb-2">Email*</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email" value="{{old('email')}}">
                            @error('email')
                            <p style="color:red;font-size:13px;">{{ $message }}</p>
                            @enderror
                        </div> 
                        <div class="mb-3">
                            <label for="password" class="mb-2">Password*</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" value="{{old('password')}}">
                            @error('password')
                            <p style="color:red;font-size:13px;">{{ $message }}</p>
                            @enderror
                        </div> 
                        <div class="mb-3">
                            <label for="confirm-password" class="mb-2">Confirm Password*</label>
                            <input type="password" name="confirm-password" id="confirm-password" class="form-control" placeholder="Please confirm Password" value="{{old('confirm-password')}}">
                            @error('confirm-password')
                            <p style="color:red;font-size:13px;">{{ $message }}</p>
                            @enderror
                        </div> 
                        <button class="btn btn-primary mt-2" type="submit">Register</button>
                    </form>                    
                </div>
                <div class="mt-4 text-center">
                    <p>Have an account? <a  href="{{route('login')}}">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection