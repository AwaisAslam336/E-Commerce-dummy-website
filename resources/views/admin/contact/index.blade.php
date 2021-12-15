@extends('admin.admin_master')
@section('admin')

<div class="py-12">
  <div class="container">
    <div class="row">
        <a href="{{ route('add.contact') }}" class="btn btn-info ml-auto m-3">Add Contact</a>

      <div class="col-md-12">
        <div class="card">
          @if(session('success'))
          <div class="alert alert-success" role="alert">
            {{ session('success') }}
          </div>
          @endif
          <div class="card-header">
            All Contacts
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" width='5%'>SL No.</th>
                  <th scope="col" width='10%'>Address</th>
                  <th scope="col" width='20%'>Email</th>
                  <th scope="col" width='30%'>Phone</th>
                  <th scope="col" width='15%'>Action</th>
                </tr>
              </thead>
              <tbody>
                @php $i=1; @endphp
                @foreach($contacts as $contact)
                <tr>
                  <th scope="row">{{ $i++ }}</th>
                  <td>{{ $contact->address }}</td> 
                  <td>{{ $contact->email }}</td>
                  <td>{{ $contact->phone }}</td>
                  <td><a href="{{ url('/edit/contact/'.$contact->id) }}" class="btn btn-info">Edit</a>
                  <a href="{{ url('/delete/contact/'.$contact->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">Delete</a></td>
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