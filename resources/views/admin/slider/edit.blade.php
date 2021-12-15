@extends('admin.admin_master')
@section('admin')

  <div class="py-12">
    <div class="container">
      <div class="row">

        
        <div class="col-md-8">
          <div class="card">

            <div class="card-header">
              Edit Slider
            </div>
            <div class="card-body">
              <form action="{{ url('/update/slider/'.$slider->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="old_image" value="{{ $slider->image }}">
                <div class="mb-3">
                  <label for="title" class="form-label">Update Title</label>
                  <input type="text" name="title" class="form-control" id="title" value=" {{ $slider->title }}">
                  @error('title')
                  <span class="text-danger"> {{ $message }} </span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="description" class="form-label">Update Description</label>
                  <textarea rows="3" name="description" class="form-control" id="description">{{ $slider->description }}</textarea>
                  @error('description')
                  <span class="text-danger"> {{ $message }} </span>
                  @enderror
                </div>


                <div class="mb-3">
                  <label for="image" class="form-label">Update Slider Image</label>
                  <input type="file" name="image" class="form-control" id="image" value=" {{ $slider->image }}">
                  @error('image')
                  <span class="text-danger"> {{ $message }} </span>
                  @enderror
                </div>

                <div class="form-group">
                  <img src="{{ asset($slider->image) }}" style="width: 400px; height: 200px;">
                </div>

                <button type="submit" class="btn btn-primary">Update Slider</button>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection