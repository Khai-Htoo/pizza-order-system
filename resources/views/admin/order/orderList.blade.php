@extends('admin.layouts.master')

@section('title', 'Order list')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <form action="{{ route('admin#getStatus') }}" method="get">
                                @csrf
                                <div class="overview-wrap col-12">
                                    <select name="status" id="status" class="form-control">
                                        <option value="">All</option>
                                        <option value="0" @if (request('status') == '0') selected @endif>Pending
                                        </option>
                                        <option value="1" @if (request('status') == '1') selected @endif>Success
                                        </option>
                                        <option value="2" @if (request('status') == '2') selected @endif>Reject
                                        </option>
                                    </select>
                                    <button type="submit" class="btn btn-dark">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <h4 class=" text-secondary">Search Key : <span class="text-danger">{{ request('key') }}</span>
                            </h4>
                        </div>
                        <div class=" col-3 offset-6 mb-2 d-flex">
                            <form action="{{ route('admin#orderList') }}" method="get">
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
                                <h4><i class="fa-solid fa-coins text-warning"></i> : {{ count($order) }}<span
                                        class=" text-secondary"></span>
                                </h4>
                            </div>
                        </div>

                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>User Name</th>
                                    <th>Order Date</th>
                                    <th>Order Code</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($order as $o)
                                    <tr class="tr-shadow">
                                        <input type="hidden" value="{{ $o->id }}" class="orderId">
                                        <td>{{ $o->user_id }}</td>
                                        <td>{{ $o->name }}</td>
                                        <td>{{ $o->created_at->format('F-j-Y') }}</td>
                                        <td><a
                                                href="{{ route('admin#orderShow', $o->order_code) }}">{{ $o->order_code }}</a>
                                        </td>
                                        <td class="amount">{{ $o->total_price }} Ks</td>
                                        <td class=" col-2">
                                            <select name="status" class="form-control statusChange">
                                                <option value="0" @if ($o->status == 0) selected @endif>
                                                    Pending
                                                </option>
                                                <option value="1" @if ($o->status == 1) selected @endif>
                                                    Success
                                                </option>
                                                <option value="2" @if ($o->status == 2) selected @endif>
                                                    Reject
                                                </option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
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

@section('scriptSource')
    <script>
        $(document).ready(() => {
            $('#status').change(function() {
                $status = $('#status').val();
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/order/status',
                    data: {
                        'status': $status
                    },
                    datatype: 'Json',
                    success: function(response) {
                        $list = '';

                        for ($i = 0; $i < response.length; $i++) {
                            $months = ['January', 'February', 'March', 'April', 'May', 'June',
                                'July', 'August', 'September', 'October', '	November',
                                'December'
                            ];
                            $dbdate = new Date(response[$i].created_at);
                            $finalDate = $months[$dbdate.getMonth()] + '-' + $dbdate.getDate() +
                                '-' + $dbdate.getFullYear();


                            if (response[$i].status == 0) {
                                $statusMsg = `
                                <select name="status" class="form-control statusChange">
                                    <option value="0" selected>Pending</option>
                                    <option value="1">Success </option>
                                    <option value="2"> Reject</option>
                                </select>
                                `;
                            } else if (response[$i].status == 1) {
                                $statusMsg = `
                                <select name="status" class="form-control statusChange">
                                    <option value="0" >Pending</option>
                                    <option value="1" selected >Success </option>
                                    <option value="2"> Reject</option>
                                </select>
                                `;
                            } else if (response[$i].status == 2) {
                                $statusMsg = `
                                <select name="status" class="form-control statusChange">
                                    <option value="0" >Pending</option>
                                    <option value="1">Success </option>
                                    <option value="2" selected>Reject</option>
                                </select>
                                `;

                            }

                            $list += `

                                <tr class="tr-shadow">
                                    <input type="hidden" value="${response[$i] .id}" class="orderId">
                                    <td>${response[$i] . user_id}</td>
                                    <td>${response[$i] . name}</td>
                                    <td>${$finalDate}</td>
                                    <td>${response[$i] . order_code}</td>
                                    <td>${response[$i] . total_price} Ks</td>
                                    <td class="col-2">${$statusMsg}</td>
                                </tr>
                                `
                        }
                        $('#dataList').html($list);
                    }
                })
            })

            $('.statusChange').change(function() {
                $change = $(this).val();
                $parent = $(this).parents('tr');
                $orderId = $(this).parents('tr').find('.orderId').val()

                $data = {
                    'status': $change,
                    'orderId': $orderId
                };

                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/order/changestatus',
                    data: $data,
                    dataType: 'json',
                })
                location.reload();
            })
        })
    </script>
@endsection
