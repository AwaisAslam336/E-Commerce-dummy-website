@extends('admin.admin_master')
@section('admin')

  <div class="py-12">
    <div class="container">
      <div class="row">

        
        <div class="col-md-8">
          <div class="card">

            <div class="card-header">
              Edit Service
            </div>
            <div class="card-body">
              <form action="{{ url('/update/service/'.$service->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="old_image" value="{{ $service->icon }}">

                <div class="mb-3">
                  <label for="icon" class="form-label">Update service Icon</label>
                  <input type="file" name="icon" class="form-control" id="icon" value=" {{ $service->icon }}">
                  @error('icon')
                  <span class="text-danger"> {{ $message }} </span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="title" class="form-label">Update Title</label>
                  <input type="text" name="title" class="form-control" id="title" value=" {{ $service->title }}">
                  @error('title')
                  <span class="text-danger"> {{ $message }} </span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="service_des" class="form-label">Update Service Description</label>
                  <textarea rows="3" name="service_des" class="form-control" id="service_des">{{ $service->service_des }}</textarea>
                  @error('service_des')
                  <span class="text-danger"> {{ $message }} </span>
                  @enderror
                </div>

                <div class="form-group">
                  <img src="{{ asset($service->icon) }}" style="width: 60px; height: 60px;">
                </div>

                <button type="submit" class="btn btn-primary">Update Service</button>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection