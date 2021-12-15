@extends('admin.admin_master')
@section('admin')

<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Create Service</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('store.service') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Title">
                </div>
                <div class="form-group">
                    <label for="service_des">Service Description</label>
                    <textarea name="service_des" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="icon">Icon</label>
                    <input type="file" name="icon" class="form-control-file">
                </div>
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>



</div>
@endsection