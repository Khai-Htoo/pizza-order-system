@extends('admin.layouts.master')

@section('title', 'category list')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-6 offset-3">
                    @if (session('change'))
                        <div class="alert alert-success alert-dismissible fade show col-9 offset-3" role="alert">
                            <i class="fa-solid fa-circle-xmark me-2"></i>{{ session('change') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="">

                                <a href="{{ route('category#list') }}"><i
                                        class="fa-sharp fa-solid fa-arrow-left text-dark"></i></a>
                                <div class="card-title">
                                    <h3 class="text-center title-2">Change Your Password</h3>
                                </div>
                            </div>
                            <hr>
                            <form action="{{ route('admin#changePassword') }}" method="post" novalidate="novalidate">
                                @csrf

                                <div class="form-group">
                                    <label class="control-label mb-1">Old Password</label>
                                    <input name="oldPassword" type="password"
                                        class="form-control  @error('oldPassword') is-invalid @enderror @if (session('notMatch')) is-invalid @endif "
                                        aria-required="true" aria-invalid="false" placeholder="Enter Old Password...">
                                    @error('oldPassword')
                                        <div class=" text-danger"> {{ $message }}</div>
                                    @enderror
                                    @if (session('notMatch'))
                                        <small class=" text-danger">{{ session('notMatch') }}</small>
                                    @endif

                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">New Password</label>
                                    <input name="newPassword" type="password"
                                        class="form-control @error('newPassword') is-invalid @enderror  "
                                        aria-required="true" aria-invalid="false" placeholder="Enter New Password...">
                                    @error('newPassword')
                                        <div class=" text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Confirm Password</label>
                                    <input name="confirmPassword" type="password"
                                        class="form-control @error('confirmPassword') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="Enter Confirm Password...">
                                    @error('confirmPassword')
                                        <div class=" text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <i class="fa-sharp fa-solid fa-key me-2"></i>
                                        <span id="payment-button-amount">Change Password</span>
                                        {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}

                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
