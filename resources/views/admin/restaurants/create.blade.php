@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8 mx-auto">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>Create Restaurant</h1>
                </div>
                <div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <form action="{{ route('admin.restaurant.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label>Restaurant name</label>
                        <input type="text" name="name" class="form-control"
                               placeholder="Restaurant name" value="{{ old('name') }}" maxlength="50" minlength="1" required autocomplete="on">
                    </div>

                    <div class="form-group">
                        <p>Store cover image</p>
                        <img class="w-25" src="{{ asset('images/general/no_cover.png') }}" alt="no cover">
                        <label class="d-block">Upload image</label>
                        <input type="file" class="form-control-file" name="cover">
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" class="form-control"
                                  rows="10" placeholder="Address"
                                  autocomplete="on"
                                  required> {{ old('address') }} </textarea>
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control"
                               maxlength="20" minlength="1" autocomplete="on"
                               placeholder="Phone" value="{{ old('phone') }}">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control"
                               placeholder="Email" value="{{ old('email') }}" minlength="1">
                    </div>

                    <div class="form-group">
                        <label class="d-block">Restaurant categories</label>
                            @foreach ($categories as $category)
                                @if (old('restaurant_category_id') !== null)
                                    <input type="checkbox" name="restaurant_category_id[]" value="{{ $category->id }}" {{
                                        in_array($category->id, old('restaurant_category_id')) ? 'checked' : ''}}>
                                    <label class="mr-2" for="{{ $category->id }}"> {{ $category->name }} </label>
                                @else
                                    <input type="checkbox" name="restaurant_category_id[]" value="{{ $category->id }}">
                                    <label class="mr-2" for="{{ $category->id }}"> {{ $category->name }} </label>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                            Save restaurant
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
