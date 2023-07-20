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
                                <a href="{{ route('category#list') }}"><i
                                        class="fa-sharp fa-solid fa-arrow-left text-dark"></i></a>
                                <div class="card-title">
                                    <h3 class="text-center title-2">account info</h3>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-3 offset-2 mt-3  ">
                                        @if (Auth::user()->image == null)
                                            <div class="">
                                                <img src="{{ asset('image/Default_pfp.svg.png') }}"
                                                    class="img-thumbnail shadow-sm" />
                                            </div>
                                        @else
                                            <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                class="img-thumbnail shadow-sm" />
                                        @endif
                                    </div>

                                    <div class="col-5 offset-1">
                                        <form action="">
                                            @csrf
                                            <h4 class=" text-secondary my-3"><i
                                                    class="fa-solid fa-user-pen me-2"></i>{{ Auth::user()->name }}</h4>
                                            <hr>
                                            <h4 class=" text-secondary my-3"><i
                                                    class="fa-solid fa-envelope me-2"></i>{{ Auth::user()->email }}</h4>
                                            <hr>
                                            <h4 class=" text-secondary my-3"><i
                                                    class="fa-solid fa-phone me-2"></i>{{ Auth::user()->phone }}</h4>
                                            <hr>
                                            <h4 class=" text-secondary my-3"><i
                                                    class="fa-solid fa-address-card me-2"></i>{{ Auth::user()->address }}
                                            </h4>
                                            <hr>
                                            <h4 class=" text-secondary my-3"><i
                                                    class="fa-solid fa-mars-and-venus me-2"></i>{{ Auth::user()->gender }}
                                            </h4>
                                            <hr>
                                            <h4 class=" text-secondary my-3"><i
                                                    class="fa-solid fa-user-clock me-2"></i>{{ Auth::user()->created_at->format('j-F-Y') }}
                                            </h4>
                                            <hr>
                                        </form>
                                    </div>
                                    <div class="row">
                                        <div class=" col-2 offset-9">
                                            <a href="{{ route('admin#edit') }}">
                                                <button class="btn btn-dark">
                                                    <i class="fa-solid fa-pen-to-square me-3"></i>Edit Profile
                                                </button>
                                            </a>
                                        </div>
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
