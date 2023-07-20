@extends('admin.layouts.master')

@section('title', 'category list')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">

                    <div class="card">
                        <div class="card-body">
                            <div class="">
                                <a href="{{ route('product#list') }}"><i
                                        class="fa-sharp fa-solid fa-arrow-left text-dark"></i></a>
                                <div class="card-title">
                                    <h3 class="text-center title-2">Update Pizza</h3>
                                </div>
                                <hr>
                                <form action="{{ route('product#update') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-4 offset-1">
                                            <input type="hidden" name="pizzaId" value="{{ $pizzas->id }}">
                                            <img src="{{ asset('storage/' . $pizzas->image) }}"
                                                class="img-thumbnail shadow-sm" />

                                            <div class=" mt-3">
                                                <div class="">
                                                    <input type="file" class="form-control" name="image">
                                                </div>
                                            </div>
                                            @error('image')
                                                <div class=" text-danger"> {{ $message }}</div>
                                            @enderror
                                            <div class=" mt-3">
                                                <button type="submit" class="btn btn-dark col-12">Update pizza
                                                    <i class="fa-solid fa-circle-chevron-right"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-5 offset-1">
                                            <div class="">

                                                <div class="form-group">
                                                    <label class="control-label  text-secondary">pizza Name</label>
                                                    <input name="name" type="text"
                                                        class="form-control @error('name') is-invalid @enderror  "
                                                        aria-required="true" aria-invalid="false"
                                                        value="{{ old('name', $pizzas->name) }}"
                                                        placeholder="Enter pizza  name...">
                                                    @error('name')
                                                        <div class=" text-danger"> {{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label  text-secondary">Price</label>
                                                    <input name="price" type="number"
                                                        class="form-control @error('price') is-invalid @enderror  "
                                                        aria-required="true" aria-invalid="false"
                                                        value="{{ old('price', $pizzas->price) }}"
                                                        placeholder="Enter pizza  price...">
                                                    @error('price')
                                                        <div class=" text-danger"> {{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label  text-secondary">Category</label>
                                                    <select name="category" class="form-control">
                                                        <option value="">Choose Category</option>
                                                        @foreach ($category as $c)
                                                            <option value="{{ $c->id }}"
                                                                @if ($pizzas->category_id == $c->id) selected @endif>
                                                                {{ $c->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category')
                                                        <div class=" text-danger"> {{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label  text-secondary">Waiting-time</label>
                                                    <input name="time" type="number"
                                                        class="form-control @error('time') is-invalid @enderror  "
                                                        aria-required="true" aria-invalid="false"
                                                        value="{{ old('time', $pizzas->waiting_time) }}"
                                                        placeholder="Enter  waiting waiting_time...">
                                                    @error('time')
                                                        <div class=" text-danger"> {{ $message }}</div>
                                                    @enderror
                                                </div>



                                            </div>

                                            <div class="form-group">
                                                <label class="control-label  text-secondary">Description</label>
                                                <textarea name="description" class=" form-control" id="" cols="30" rows="10">{{ old('description', $pizzas->description) }}</textarea>
                                                @error('description')
                                                    <div class=" text-danger"> {{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label  text-secondary">Created At</label>
                                                <input name="created" type="text"
                                                    class="form-control @error('role') is-invalid @enderror  "
                                                    aria-required="true" aria-invalid="false" disabled
                                                    value="{{ $pizzas->created_at->format('j-F-Y') }}">
                                            </div>

                                        </div>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>


@endsection
