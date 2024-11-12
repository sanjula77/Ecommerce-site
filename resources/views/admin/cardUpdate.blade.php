@extends('layouts.layout')
@section('title', 'Admin')
@section('csss')

@endsection
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        @if($errors->any())
        <div class="col-12">
            @foreach($errors->all() as $error)
              <div class="alert alert-danger" >
                {{$error}}
              </div>           
            @endforeach
        </div>
      @endif
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Add New Item</h4>
                </div>
                <div class="card-body">
                    <form action="{{route("insert.post")}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="image">Item Image</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Item Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="price">Price (LKR)</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="category">Category</label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="">Select Category</option>
                                <option value="Electronics">Electronics</option>
                                <option value="Fashion">Fashion</option>
                                <option value="Home Appliances">Home Appliances</option>
                                <option value="Beauty & Health">Beauty & Health</option>
                                <option value="Sports & Outdoors">Sports & Outdoors</option>
                                <option value="Automotive">Automotive</option>
                                <option value="Toys & Hobbies">Toys & Hobbies</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Add Item</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
