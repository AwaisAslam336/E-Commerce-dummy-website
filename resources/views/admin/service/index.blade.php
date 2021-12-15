@extends('admin.admin_master')
@section('admin')

<div class="py-12">
  <div class="container">
    <div class="row">
      <a href="{{ route('add.service') }}" class="btn btn-info ml-auto m-3">Add New Service</a>

      <div class="col-md-12">
        
        <div class="card">
          @if(session('success'))
          <div class="alert alert-success" role="alert">
            {{ session('success') }}
          </div>
          @endif
          <div class="card-header">
            All Services
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" width='5%'>SL No.</th>
                  <th scope="col" width='10%'>Service Title</th>
                  <th scope="col" width='25%'>Service Description</th>
                  <th scope="col" width='10%'>Service Image</th>
                  <th scope="col" width='15%'>Action</th>
                </tr>
              </thead>
              <tbody>
                @php $i=1; @endphp
                @foreach($services as $service)
                <tr>
                  <th scope="row">{{ $i++ }}</th>
                  <td>{{ $service->title }}</td>
                  <td>{{ $service->service_des }}</td>
                  <td><img src="{{ asset($service->icon) }}" style="height: 60px; width: 60px;"></td>
                  <td><a href="{{ url('/edit/service/'.$service->id) }}" class="btn btn-info">Edit</a>
                    <a href="{{ url('/delete/service/'.$service->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">Delete</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection