@extends('admin.layouts.master')

@section('title', 'product list')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('product#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>
                <div class="col-lg-8 offset-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Create Your Pizza</h3>
                            </div>
                            <hr>
                            <form action="{{ route('product#create') }}" enctype="multipart/form-data" method="post"
                                novalidate="novalidate">
                                @csrf


                                <div class="form-group">
                                    <label class="control-label mb-1">Name</label>
                                    <input name="name" type="text"
                                        class="form-control @error('name') is-invilid @enderror" aria-required="true"
                                        aria-invalid="false" placeholder="Enter pizza name..." value="{{ old('name') }}">
                                    @error('name')
                                        <div class=" text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Price</label>
                                    <input name="price" type="number"
                                        class="form-control @error('price') is-invilid @enderror" aria-required="true"
                                        aria-invalid="false" placeholder="Enter pizza price..." value="{{ old('price') }}">
                                    @error('price')
                                        <div class=" text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Waiting Time</label>
                                    <input name="time" type="number"
                                        class="form-control @error('price') is-invilid @enderror" aria-required="true"
                                        aria-invalid="false" placeholder="Enter waiting time..."
                                        value="{{ old('time') }}">
                                    @error('time')
                                        <div class=" text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Category</label>
                                    <select name="category" class="form-control" id="">
                                        <option value="">Choose your category</option>
                                        @foreach ($category as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <div class=" text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Description</label>
                                    <textarea name="description" class="form-control" cols="30" rows="10" placeholder="Enter description"></textarea>
                                    @error('description')
                                        <div class=" text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Image</label>
                                    <input type="file" name="image" class="form-control">
                                    @error('image')
                                        <div class=" text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>



                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Create</span>
                                        {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                        <i class="fa-solid fa-circle-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
