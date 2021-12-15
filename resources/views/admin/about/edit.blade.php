@extends('admin.admin_master')
@section('admin')

  <div class="py-12">
    <div class="container">
      <div class="row">

        
        <div class="col-md-8">
          <div class="card">

            <div class="card-header">
              Edit About
            </div>
            <div class="card-body">
              <form action="{{ url('/update/about/'.$about->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                  <label for="title" class="form-label">Update Title</label>
                  <input type="text" name="title" class="form-control" id="title" value=" {{ $about->title }}">
                  @error('title')
                  <span class="text-danger"> {{ $message }} </span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="short_des" class="form-label">Update Short Description</label>
                  <textarea rows="3" name="short_des" class="form-control" id="short_des">{{ $about->short_des }}</textarea>
                  @error('short_des')
                  <span class="text-danger"> {{ $message }} </span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="long_des" class="form-label">Update Long Description</label>
                  <textarea rows="5" name="long_des" class="form-control" id="long_des">{{ $about->long_des }}</textarea>
                  @error('long_des')
                  <span class="text-danger"> {{ $message }} </span>
                  @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update About</button>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection