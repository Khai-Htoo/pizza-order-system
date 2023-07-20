@extends('admin.layouts.master')

@section('title', 'category list')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">

                    <div class="card">
                        <div class="card-body">
                            <div class="">
                                <a href="{{ route('admin#list') }}"><i
                                        class="fa-sharp fa-solid fa-arrow-left text-dark"></i></a>
                                <div class="card-title">
                                    <h3 class="text-center title-2">Change role</h3>
                                </div>
                                <hr>
                                <form action="{{ route('admin#change', $account->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-3 offset-1">
                                            @if ($account->image == null)
                                                <img src="{{ asset('image/Default_pfp.svg.png') }}"
                                                    class="img-thumbnail shadow-sm" />
                                            @else
                                                <img src="{{ asset('storage/' . $account->image) }}"
                                                    class="img-thumbnail shadow-sm" />
                                            @endif
                                            <div class=" mt-3">
                                                <button type="submit" class="btn btn-dark col-12">Update Profile
                                                    <i class="fa-solid fa-circle-chevron-right"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-5 offset-1">
                                            <div class="">

                                                <div class="form-group">
                                                    <label class="control-label  text-secondary">User Name</label>
                                                    <input name="name" type="text" disabled class="form-control   "
                                                        aria-required="true" aria-invalid="false"
                                                        value="{{ old('name', $account->name) }}"
                                                        placeholder="Enter  name...">
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label  text-secondary">Role</label>
                                                    <select name="role" class="form-control">

                                                        <option value="admin"
                                                            @if ($account->role == 'admin') selected @endif>Admin</option>
                                                        <option value="user"
                                                            @if ($account->role == 'user') selected @endif>User</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


@endsection
