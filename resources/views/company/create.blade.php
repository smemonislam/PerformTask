@extends('layouts.master')

@section('title', 'Company Create')

@section('admin_content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Company</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Company</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>
  
    <!-- Main content -->
    <section class="content">  
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add New Company</h3>
                <div class="card-tools">
                    <a href="{{ route('companies.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
                </div>
            </div>
            
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="companyname">Compnay Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="companyname" placeholder="Enter comapny name">
                        @error('name')
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
                        <label>File input</label>
                        <input type="file" name="logo" class="form-control dropify @error('logo') is-invalid @enderror">
                        <div class="form-text">Logo size minimum 100x100</div>
                        @error('logo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="companywebsite">Website</label>
                        <input type="text" class="form-control @error('website') is-invalid @enderror" name="website" id="companywebsite" placeholder="Enter website">
                        @error('website')
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