@extends('admin.admin_master')
@section('admin')

<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Create About</h2>
        </div>
        <div class="card-body">
        <form action="{{ route('store.about') }}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Title</label>
                    <input type="text" name="title" class="form-control"  placeholder="Title">
                </div>
                <div class="form-group">
                    <label for="short_des">Short Description</label>
                    <textarea name="short_des" class="form-control" rows="2"></textarea>
                </div>
                <div class="form-group">
                    <label for="long_des">Lond Description</label>
                    <textarea name="long_des" class="form-control" rows="4"></textarea>
                </div>
                
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>

   
    
</div>
@endsection