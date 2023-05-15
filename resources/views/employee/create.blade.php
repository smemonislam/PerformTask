@extends('layouts.master')

@section('title', 'Employee Create')

@section('admin_content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Add Employee</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Add Employee</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>
  
    <!-- Main content -->
    <section class="content">  
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add New Employee</h3>
                <div class="card-tools">
                    <a href="{{ route('employees.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
                </div>
            </div>
            @if( session()->has( 'message' ) )
              <div class="alert alert-{{ session('type') }}">{{ session('message') }}</div>
            @endif
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="companyname">Compnay Name</label>
                        <select name="name" id="companyname" class="form-control @error('name') is-invalid @enderror">
                            @foreach ($companies as $row)
                                <option value="{{ $row->id }}">{{ $row->name }}</option> 
                            @endforeach                            
                        </select>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="fname" placeholder="Enter First Name">
                        @error('first_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="lname" placeholder="Enter Last Name">
                        @error('last_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="companyemail">Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="companyemail" placeholder="Enter email">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="phoneNumber">Phone</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phoneNumber" placeholder="Enter phone number">
                        @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>  
    </section>

    @push('script')
        <script type="text/javascript">
            $(document).ready(function(){
                $('.dropify').dropify();
            });
        </script>
    @endpush
@endsection