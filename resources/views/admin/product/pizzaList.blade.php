@extends('admin.layouts.master')

@section('title', 'product list')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Products List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add Products
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <h4 class=" text-secondary">Search Key : <span class="text-danger">{{ request('key') }}</span>
                            </h4>
                        </div>
                        <div class=" col-3 offset-6 mb-2 d-flex">
                            <form action="{{ route('product#list') }}" method="get">
                                @csrf
                                <div class="d-flex">
                                    <div class="d-flex">
                                        <input type="text" name="key" class="form-control "
                                            placeholder="Search Key..." value="{{ request('key') }}">
                                        <button type="submit" class="btn btn-dark "><i
                                                class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="row">
                            <div class="col-1 offset-11  mb-3">
                                <h4><i class="fa-solid fa-coins text-warning"></i> : <span
                                        class=" text-secondary">{{ $pizzas->total() }}</span>
                                </h4>
                            </div>
                        </div>

                    </div>

                    @if (session('pizza'))
                        <div class="alert alert-success alert-dismissible text-center fade show col-4 offset-8"
                            role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>{{ session('pizza') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('deleteSuccess'))
                        <div class="alert alert-warning alert-dismissible text-center fade show col-4 offset-8"
                            role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>{{ session('deleteSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif


                    @if (count($pizzas) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>View Count</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pizzas as $p)
                                        <tr class="tr-shadow">
                                            <td class="col-2"><img src="{{ asset('storage/' . $p->image) }}"
                                                    style=" width : 170px" class="img-thumbnail shadow-sm"></td>
                                            <td class="col-3">{{ $p->name }}</td>
                                            <td class="col-2">{{ $p->price }}</td>
                                            <td class="col-2">{{ $p->category_name }}</td>
                                            <td class="col-2">{{ $p->view_count }}</td>

                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="{{ route('product#updatePage', $p->id) }}">
                                                        <button class="item ml-3" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('product#delete', $p->id) }}">
                                                        <button class="item ml-3" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('product#edit', $p->id) }}">
                                                        <button class="item ml-3" data-toggle="tooltip" data-placement="top"
                                                            title="More">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class=" mt-3">
                                {{ $pizzas->links() }}
                            </div>
                        </div>
                    @else
                        <h3 class="text-secondary text-center">There is no pizza here</h3>
                    @endif

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
