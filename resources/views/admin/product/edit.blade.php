@extends('admin.layouts.master')

@section('title', 'category list')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                @if (session('imageSuccess'))
                    <div class="alert alert-success alert-dismissible fade show col-4 offset-7" role="alert">
                        <i class="fa-solid fa-circle-xmark me-2"></i>{{ session('imageSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="col-lg-10 offset-1">

                    <div class="card">
                        <div class="card-body">
                            <div class="">
                                <a href="{{ route('product#list') }}">
                                    <i class="fa-sharp fa-solid fa-arrow-left text-dark"></i></a>
                                <div class="card-title">
                                    <h3 class="text-center title-2"> Pizzas details</h3>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-4 offset-1 mt-3  ">

                                        <div class="image">
                                            <img src="{{ asset('storage/' . $pizzas->image) }}"
                                                class="img-thumbnail shadow-sm" />
                                        </div>

                                    </div>

                                    <div class="col-5 offset-1">
                                        <form action="">
                                            @csrf
                                            <h4 class=" text-dark my-3"><i
                                                    class="fa-solid fa-pizza-slice me-3 text-dark"></i>{{ $pizzas->name }}
                                            </h4>
                                            <hr>
                                            <h4 class=" text-dark my-3"><i
                                                    class="fa-solid fa-money-bill-wave me-3 text-dark"></i>{{ $pizzas->price }}Ks
                                            </h4>
                                            <hr>
                                            <h4 class=" text-dark my-3"><i
                                                    class="fa-solid fa-list-check me-3 text-dark"></i>{{ $pizzas->category_name }}
                                            </h4>
                                            <hr>
                                            <h4 class=" text-dark my-3"><i
                                                    class="fa-solid fa-envelope-circle-check me-3 text-dark"></i>{{ $pizzas->description }}
                                            </h4>
                                            <hr>
                                            <h4 class=" text-dark my-3"><i
                                                    class="fa-solid fa-calendar-days me-3 text-dark"></i>{{ $pizzas->created_at->format('j-F-Y') }}
                                            </h4>
                                            <hr>
                                            <h4 class=" text-dark my-3"><i
                                                    class="fa-solid fa-clock me-3 text-dark"></i>{{ $pizzas->waiting_time }}
                                            </h4>
                                            <hr>

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
