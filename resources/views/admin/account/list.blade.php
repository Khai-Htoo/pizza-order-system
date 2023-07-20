@extends('admin.layouts.master')

@section('title', 'category list')

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
                    <div class="row">
                        <div class="col-3">
                            <h4 class=" text-secondary">Search Key : <span class="text-danger">{{ request('key') }}</span>
                            </h4>
                        </div>
                        <div class=" col-3 offset-6 mb-2 d-flex">
                            <form action="{{ route('admin#list') }}" method="get">
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
                                <h4><i class="fa-solid fa-coins text-warning"></i> : {{ $admin->total() }}<span
                                        class=" text-secondary"></span>
                                </h4>
                            </div>
                        </div>

                    </div>


                    @if (session('accdelete'))
                        <div class="alert alert-warning alert-dismissible fade show col-3 offset-9" role="alert">
                            <i class="fa-solid fa-circle-xmark me-2"></i>{{ session('accdelete') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    {{-- @if (count($categories) != 0) --}}
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>phone</th>
                                    <th>address</th>
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $a)
                                    <tr class="tr-shadow">
                                        <td style="width : 150px">
                                            @if ($a->image != null)
                                                <img src="{{ asset('storage/' . $a->image) }}"
                                                    class="img-thumbnail shadow-sm ">
                                            @else
                                                <img src="{{ asset('admin/images/Default_pfp.svg.png') }}" alt="">
                                            @endif
                                            <input type="hidden" class="userId" value="{{ $a->id }}">
                                        </td>
                                        <td>{{ $a->name }}</td>
                                        <td>{{ $a->email }}</td>
                                        <td>{{ $a->gender }}</td>
                                        <td>{{ $a->phone }}</td>
                                        <td>{{ $a->address }}</td>
                                        <td class=" col-3">
                                            @if (Auth::user()->id == $a->id)
                                            @else
                                                <div class="table-data-feature" id="parents">
                                                    <a href="{{ route('admin#delete', $a->id) }}">
                                                        <button class="item me-3 " data-toggle="tooltip"
                                                            data-placement="top" title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>

                                                    <select name="role" class="form-control change ">

                                                        <option value="admin">Admin
                                                        </option>
                                                        <option value="user">User
                                                        </option>
                                                    </select>

                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                        <div class=" mt-3">
                            {{ $admin->appends(request()->query())->links() }}
                        </div>
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
            $('.change').change(function() {
                $parent = $(this).parents('tr')
                $role = $(this).val();
                $userId = $(this).parents('tr').find('.userId').val();

                $data = {
                    'role': $role,
                    'userId': $userId
                }

                $.ajax({
                    type: 'get',
                    url: '/admin/changeStatus',
                    data: $data,
                    dataType: 'json',
                })
                location.reload();
            })
        })
    </script>

@endsection
