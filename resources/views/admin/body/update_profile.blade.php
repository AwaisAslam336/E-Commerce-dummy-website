
@extends('admin.admin_master')
@section('admin')

<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Change Password</h2>
    </div>
    <div class="card-body">
    @if(session('error'))
          <div class="alert alert-danger" role="alert">
            {{ session('error') }}
          </div>
          @endif
        <form method="POST" action="{{route('update.profile')}}"  enctype="multipart/form-data" >
            @csrf
            <input type="hidden" name="old_image" value="{{ $user['profile_photo_path'] }}">
            <div class="form-group">
                <label for="photo">Profile Picture</label>
                <input type="file" name="photo" class="form-control" id="image">
                
            </div>
            <div class="form-group">
                <label for="current_password">User Name</label>
                <input type="text" name="name" class="form-control" id="name"  value="{{$user['name']}}">
                
            </div>
            <div class="form-group">
                <label for="new_password">User Email</label>
                <input type="text" name="email" class="form-control" id="email" value="{{$user['email']}}">
                
            </div>
            
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection