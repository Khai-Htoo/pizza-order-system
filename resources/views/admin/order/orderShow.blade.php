@extends('admin.layouts.master')

@section('title', 'Order list')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">

                            <thead>
                                <a href="{{ route('admin#orderList') }}" class="text-dark">Back</a>
                                <tr>
                                    <th></th>
                                    <th>User Id</th>
                                    <th>User Name</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Order Date</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($order as $o)
                                    <tr class="tr-shadow">
                                        <td></td>
                                        <td>{{ $o->user_id }}</td>
                                        <td>{{ $o->name }}</td>
                                        <td><img src="{{ asset('storage/' . $o->image) }}"
                                                style=" width : 100px; height : 70px" class="img-thumbnail" alt="">
                                        </td>
                                        <td>{{ $o->created_at->format('F-j-Y') }}</td>
                                        <td>{{ $o->productname }}</td>
                                        <td>{{ $o->qty }}</td>
                                        <td>{{ $o->total }} Ks</td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                        <div class="col-3 offset-9 text-center">
                            <hr>
                            <div class="text-warning mb-2">Include delivery charges!</div>
                            <div class="bg-secondary text-white py-1"><span class="me-4">Total :</span><span
                                    class="ml-5">{{ $orderTotal->total_price }}
                                    Ks</span></div>
                        </div>
                        {{-- <div class=" mt-3">
                            {{ $order->appends(request()->query())->links() }}
                        </div> --}}
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
