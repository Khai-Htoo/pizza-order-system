@extends('user.layouts.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12  table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="data">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order Id</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($order as $o)
                            <tr>
                                <td class="align-middle">{{ $o->created_at->format('F-j-Y') }}</td>
                                <td class="align-middle">{{ $o->order_code }}</td>
                                <td class="align-middle">{{ $o->total_price }} Ks</td>
                                <td class="align-middle">
                                    @if ($o->status == 0)
                                        <button class=" btn btn-warning shadow-sm ">Pending</button>
                                    @elseif ($o->status == 1)
                                        <button class="btn btn-success shadow-sm">Success</button>
                                    @else
                                        <button class="btn btn-danger shadow-sm">Reject</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3 ">{{ $order->links() }}</div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
