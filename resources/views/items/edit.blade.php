@extends('layouts.admin')

@section('content')
    
    <div class="m-5">
        <div class="mb-3">
            <h1>Update item</h1>
        </div>
        <div class="card p-2">
    
            <form action="{{ route('items.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">Name :</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" required value="{{ $data->name }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>                    
                    @enderror
                </div>
    
                <div class="form-group">
                    <label for="">Start price :</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                        </div>
                        <input value="{{ $data->start_price }}" type="number" name="start_price" class="form-control @error('start_price') is-invalid @enderror" aria-describedby="basic-addon1">
                    </div>
                    @error('start_price')
                        <span class="text-danger">{{ $message }}</span>                    
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Image :</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>                    
                    @enderror
                    <div class="d-flex flex-column">
                        <img class="img-fluid mt-3 mb-1" width="256" src="/img/items/{{ $data->image }}" alt="">
                        <span>{{ $data->image }}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Description :</label>
                    <textarea class="form-control  @error('description') is-invalid @enderror" name="description" id="" cols="30" rows="10">{{ $data->description }}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>                    
                    @enderror
                </div>
    
                <div class="form-group">
                    <button class="btn btn-primary">Submit</button>
                    <a href="{{ route('items.index') }}" class="btn btn-primary btn-link">Back</a>
                </div>
    
    
            </form>
    
        </div>
    </div>



@endsection
