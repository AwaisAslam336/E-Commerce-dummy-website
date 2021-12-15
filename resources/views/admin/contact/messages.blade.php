@extends('admin.admin_master')
@section('admin')

<div class="py-12">
  <div class="container">
    <div class="row">
   
      <div class="col-md-12">
        <div class="card">
         
        @if(session('success'))
          <div class="alert alert-success" role="alert">
            {{ session('success') }}
          </div>
          @endif

          <div class="card-header">
            All Messages
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" width='5%'>SL No.</th>
                  <th scope="col" width='15%'>Name</th>
                  <th scope="col" width='15%'>Email</th>
                  <th scope="col" width='15%'>Subject</th>
                  <th scope="col" width='30%'>Message</th>
                  <th scope="col" width='10%'>Action</th>
                </tr>
              </thead>
              <tbody>
                @php $i=1; @endphp
                @foreach($messages as $message)
                <tr>
                  <th scope="row">{{ $i++ }}</th>
                  <td>{{ $message->name }}</td> 
                  <td>{{ $message->email }}</td>
                  <td>{{ $message->subject }}</td>
                  <td>{{ $message->message }}</td>
                  <td><a href="{{ url('/delete/message/'.$message->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">Delete</a></td>
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