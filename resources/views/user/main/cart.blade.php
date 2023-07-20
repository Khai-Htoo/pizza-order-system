@extends('user.layouts.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="data">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    @foreach ($cartlist as $c)
                        <tbody class="align-middle">
                            <tr>
                                <td><img class="img-thumbnail shadow-sm" src="{{ asset('storage/' . $c->image) }}"
                                        alt="" style="width: 100px;height:60px"></td>
                                <td class="align-middle">{{ $c->pizza_name }}
                                    <input type="hidden" class="id" value="{{ $c->id }}">
                                    <input type="hidden" class="userId" value="{{ $c->user_id }}">
                                    <input type="hidden" class="productId" value="{{ $c->product_id }}">
                                </td>
                                <td class="align-middle" id="price">{{ $c->pizza_price }} Ks</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-sm bg-secondary border-0 text-center "
                                            value="{{ $c->qty }}" id="qty">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle col-3" id="total">{{ $c->pizza_price * $c->qty }} Ks</td>
                                <td class="align-middle "><button class="btn btn-sm btn-danger btnRemove"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>

                        </tbody>
                    @endforeach
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="sub">{{ $total }} Ks</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">2000Ks</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="final">{{ $total + 2000 }} Ks</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3 orderBtn">Proceed To
                            Checkout</button>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3 remove">Clear Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {
            // click plus button
            $(".btn-plus").click(function() {
                $parent = $(this).parents('tr');
                $price = Number($parent.find('#price').text().replace('Ks', ''));
                $qty = Number($parent.find('#qty').val());
                $total = $price * $qty
                $parent.find('#total').html($total + 'Ks');

                summary();
            })

            // click minus button
            $(".btn-minus").click(function() {
                $parent = $(this).parents('tr');
                $price = Number($parent.find('#price').text().replace('Ks', ''));
                $qty = Number($parent.find('#qty').val());
                $total = $price * $qty
                $parent.find('#total').html($total + 'Ks');

                summary();
            })




            // circulate final price for order
            function summary() {
                $subTotal = 0;
                $('#data tbody tr').each(function(index, row) {
                    $subTotal += Number(($(row).find('#total').text().replace("Ks", "")));
                })

                $('#sub').html($subTotal + 'Ks')
                $('#final').html(`${$subTotal + 2000}Ks`)

            }


        })
        // proceed to checkout
        $(document).ready(function() {
            $('.orderBtn').click(function() {

                $random = Math.floor(Math.random() * 100000001);

                $orderList = [];
                $('#data tbody tr').each(function(index, row) {
                    $orderList.push({
                        'user_id': $(row).find('.userId').val(),
                        'product_id': $(row).find('.productId').val(),
                        'qty': $(row).find('#qty').val(),
                        'total': $(row).find('#total').html().replace('Ks', '') * 1,
                        'order_code': 'POS' + $random
                    })
                })

                $.ajax({
                    type: 'get',
                    url: '/user/ajax/order',
                    data: Object.assign({}, $orderList),
                    datatype: 'Json',
                    success: function(response) {
                        if (response.status == 'true') {
                            window.location.href = '/user/homePage';
                        }
                    }
                })
            })
        })
        // remove button
        $(document).ready(function() {
            $('.remove').click(function() {
                $('#data tbody tr').remove();
                $('#sub').html('0 Ks')
                $('#final').html('2000 Ks')

                $.ajax({
                    type: 'get',
                    url: '/user/ajax/clear',
                    datatype: 'Json',
                })
            })
        })
        // click cross btn
        $('.btnRemove').click(function() {
            $parent = $(this).parents("tr");
            $productId = $parent.find('.productId').val();
            $id = $parent.find('.id').val();
            $parent.remove();

            $.ajax({
                type: 'get',
                url: '/user/ajax/remove',
                data: {
                    'productId': $productId,
                    'id': $id
                },
                datatype: 'Json',
            })

            $subTotal = 0;
            $('#data tbody tr').each(function(index, row) {
                $subTotal += Number(($(row).find('#total').text().replace("Ks", "")));
            })

            $('#sub').html($subTotal + 'Ks')
            $('#final').html(`${$subTotal + 2000}Ks`)
        })
    </script>
@endsection
