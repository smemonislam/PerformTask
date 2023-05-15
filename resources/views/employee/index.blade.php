@extends('layouts.master')

@section('title', 'Employee')

@section('admin_content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Employee</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Employee</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
        
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">All Employee List</h3>
              <div class="card-tools">
                <a href="{{ route('employees.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
              </div>
            </div>
            @if( session()->has( 'message' ) )
              <div class="alert alert-{{ session('type') }}">{{ session('message') }}</div>
            @endif
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Company Name</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($employees as $data)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $data->name }}</td>
                          <td>{{ $data->first_name }} {{ $data->last_name }}</td>
                          <td>{{ $data->e_email }}</td>
                          <td>{{ $data->phone }}</td>
                          <td>
                            <form action="{{ route('employees.destroy', $data->eid) }}" method="POST">
                              <a href="{{ route('employees.edit', $data->eid) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash-alt"></i></button>
                            </form> 
                          </td>
                      </tr>
                  @endforeach                  
              </tbody>
              </table>
              {{ $employees->links() }}
            </div>
            <!-- /.card-body -->
          </div>
  
      </section>
      <!-- /.content -->
@endsection