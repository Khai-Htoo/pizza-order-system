@extends('user.layouts.master')

@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter
                        by Categories</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class=" d-flex align-items-center justify-content-between mb-3 bg-dark text-white p-2">
                            <input type="checkbox" class="custom-control-input " checked id="price-all">
                            <label class="mt-2" for="price-all">Categories</label>
                            <span class="badge border font-weight-normal">{{ count($category) }}</span>
                        </div>

                        <a href="{{ route('user#home') }}">
                            <div class="d-flex align-items-center justify-content-between text-dark mb-3">
                                <label for="price-1">All</label>
                            </div>
                        </a>

                        @foreach ($category as $c)
                            <a href="{{ route('user#filter', $c->id) }}">
                                <div class="d-flex align-items-center justify-content-between text-dark mb-3">
                                    <label for="price-1">{{ $c->name }}</label>
                                </div>
                            </a>
                        @endforeach

                    </form>
                </div>
                <!-- Price End -->

                <!-- Color Start -->

                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>

            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a href="{{ route('cart#list') }}"> <button class="btn btn-dark rounded "><i
                                            class="fa-solid fa-cart-shopping text-warning"></i>
                                        {{ count($cart) }}</button></a>
                                <a href="{{ route('user#history') }}"> <button class="btn btn-dark rounded "
                                        title="history"><i class="fa-solid fa-clock-rotate-left text-warning"></i>
                                        {{ count($history) }}</button></a>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="sorting" id="sortingOption" class="form-control">
                                        <option value="">Choose Option</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (count($pizza) != null)
                        <div id="datalist" class="row">
                            @foreach ($pizza as $p)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1 ">
                                    <div class="product-item bg-light mb-4 myform">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height : 230px"
                                                src="{{ asset('storage/' . $p->image) }}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('cart#list') }}"><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('pizza#details', $p->id) }}">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href="">{{ $p->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $p->price }} kyats</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <h4 class="text-center ">There is no pizza</h4>
                    @endif

                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection


@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('#sortingOption').change(function() {
                $sort = $('#sortingOption').val();
                if ($sort == 'asc') {
                    $.ajax({
                        type: 'get',
                        url: '/user/ajax/list',
                        data: {
                            'status': 'asc'
                        },
                        dataType: 'json',
                        success: function(response) {
                            $list = '';
                            for ($i = 0; $i < response.length; $i++) {
                                $list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1 ">
                                    <div class="product-item bg-light mb-4 myform">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height : 230px"
                                                src="{{ asset('storage/${response[$i].image}') }}" >
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('cart#list') }}"><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('pizza#details', $p->id) }}">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href=""> ${response[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5> ${response[$i].price} kyats</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `;
                            }
                            $('#datalist').html($list);
                        }
                    })
                } else if ($sort == 'desc') {
                    $.ajax({
                        type: 'get',
                        url: '/user/ajax/list',
                        data: {
                            'status': 'desc'
                        },
                        dataType: 'json',
                        success: function(response) {
                            $list = '';
                            for ($i = 0; $i < response.length; $i++) {
                                $list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1 ">
                                    <div class="product-item bg-light mb-4 myform">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height : 230px"
                                                src="{{ asset('storage/${response[$i].image}') }}" >
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('cart#list') }}"><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('pizza#details', $p->id) }}">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href=""> ${response[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5> ${response[$i].price} kyats</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `;
                            }
                            $('#datalist').html($list);
                        }
                    })
                }
            })
            // $.ajax({
            //     type: 'get',
            //     url: '/user/ajax/list',
            //     dataType: 'json',
            //     success: function(response) {
            //         console.log(response);
            //     }
            // })
        })
    </script>
@endsection
