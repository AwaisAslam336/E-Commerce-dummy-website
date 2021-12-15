@extends('admin.admin_master')
@section('admin')

  <div class="py-12">
    <div class="container">
      <div class="row">

        
        <div class="col-md-8">
          <div class="card">

            <div class="card-header">
              Edit Contact
            </div>
            <div class="card-body">
              <form action="{{ url('/update/contact/'.$contact->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                  <label for="email" class="form-label">Update Email</label>
                  <input type="email" name="email" class="form-control" id="email" value=" {{ $contact->email }}">
                  @error('email')
                  <span class="text-danger"> {{ $message }} </span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="address" class="form-label">Update Address</label>
                  <textarea rows="3" name="address" class="form-control" id="address">{{ $contact->address }}</textarea>
                  @error('address')
                  <span class="text-danger"> {{ $message }} </span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="phone" class="form-label">Update Phone Number</label>
                  <input type="text" name="phone" class="form-control" id="phone" value=" {{ $contact->phone }}">
                  @error('phone')
                  <span class="text-danger"> {{ $message }} </span>
                  @enderror
                </div>
                

                <button type="submit" class="btn btn-primary">Update contact</button>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection