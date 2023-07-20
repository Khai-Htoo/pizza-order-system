@extends('admin.layouts.master') @section('title', 'category list')
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
                                <h2 class="title-1">Admin List</h2>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        @if (count($contact) != 0)
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contact as $c)
                                        <tr class="tr-shadow">
                                            <td>{{ $c->name }}</td>
                                            <td>{{ $c->email }}</td>
                                            <td>{{ $c->message }}</td>
                                            <td>
                                                <a href="{{ route('admin#deleteSent', $c->id) }}" class="">
                                                    <button class="btn btn-danger"><i
                                                            class="fa-solid fa-calendar-xmark"></i>
                                                        delete</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>

                                <div class="mt-3">
                                    {{ $contact->appends(request()->query())->links() }}
                                </div>
                    </div>

                    </table>

                    <!-- END DATA TABLE -->
                </div>
            @else
                <div class="text-center">There is no message</div>
                @endif
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

    @endsection @section('scriptSource')

    <script>
        $(document).ready(() => {
            $(".change").change(function() {
                $parent = $(this).parents("tr");
                $role = $(this).val();
                $userId = $(this).parents("tr").find(".userId").val();

                $data = {
                    role: $role,
                    userId: $userId,
                };

                $.ajax({
                    type: "get",
                    url: "/admin/changeStatus",
                    data: $data,
                    dataType: "json",
                });
                location.reload();
            });
        });
    </script>

@endsection
