@extends('user.layouts.master')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">

                    <div class="card">
                        <div class="card-body">
                            <div class="">
                                <a href="{{ route('category#list') }}"><i
                                        class="fa-sharp fa-solid fa-arrow-left text-dark"></i></a>
                                <div class="card-title">
                                    <h3 class="text-center title-2">Account profile</h3>
                                </div>
                                <hr>
                                @if (session('updateSuccess'))
                                    <div class="alert alert-success alert-dismissible fade show col-9 offset-1"
                                        role="alert">
                                        <i class="fa-solid fa-circle-xmark me-2"></i>{{ session('updateSuccess') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <form action="{{ route('user#accountChange', Auth::user()->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-3 offset-1">
                                            @if (Auth::user()->image == null)
                                                <img src="{{ asset('image/Default_pfp.svg.png') }}"
                                                    class="img-thumbnail shadow-sm" />
                                            @else
                                                <img src="{{ asset('storage/' . Auth::user()->image) }}" style="width:330px"
                                                    class="img-thumbnail shadow-sm" />
                                            @endif
                                            <div class=" mt-3">
                                                <div class="">
                                                    <input type="file" class="form-control" name="image">
                                                </div>
                                            </div>
                                            @error('image')
                                                <div class=" text-danger"> {{ $message }}</div>
                                            @enderror
                                            <div class=" mt-3">
                                                <button type="submit" class="btn btn-dark col-12">Update Profile
                                                    <i class="fa-solid fa-circle-chevron-right"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-5 offset-1">
                                            <div class="">

                                                <div class="form-group">
                                                    <label class="control-label  text-dark">User Name</label>
                                                    <input name="name" type="text"
                                                        class="form-control @error('name') is-invalid @enderror  "
                                                        aria-required="true" aria-invalid="false"
                                                        value="{{ old('name', Auth::user()->name) }}"
                                                        placeholder="Enter  name...">
                                                    @error('name')
                                                        <div class=" text-danger"> {{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label  text-dark"> Email</label>
                                                    <input name="email" type="email"
                                                        class="form-control @error('email') is-invalid @enderror  "
                                                        aria-required="true" aria-invalid="false"
                                                        value="{{ old('email', Auth::user()->email) }}"
                                                        placeholder="Enter  email...">
                                                    @error('email')
                                                        <div class=" text-danger"> {{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label  text-dark">Phone</label>
                                                    <input name="phone" type="number"
                                                        class="form-control @error('phone') is-invalid @enderror  "
                                                        aria-required="true" aria-invalid="false"
                                                        value="{{ old('phone', Auth::user()->phone) }}"
                                                        placeholder="Enter  phone...">
                                                    @error('phone')
                                                        <div class=" text-danger"> {{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label  text-dark">Gender</label>
                                                    <select name="gender" class="form-control">
                                                        <option value="">Choose
                                                            gender</option>
                                                        <option value="male"
                                                            @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                                        <option value="female"
                                                            @if (Auth::user()->gender == 'female') selected @endif>Female
                                                        </option>
                                                    </select>
                                                    @error('gender')
                                                        <div class=" text-danger"> {{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label  text-dark">Address</label>
                                                    <textarea name="address" class=" form-control" id="" cols="30" rows="10">{{ old('address', Auth::user()->address) }}</textarea>
                                                    @error('address')
                                                        <div class=" text-danger"> {{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label  text-dark">Role</label>
                                                    <input name="role" type="text"
                                                        class="form-control @error('role') is-invalid @enderror  "
                                                        aria-required="true" aria-invalid="false" disabled
                                                        value="{{ Auth::user()->role }}">
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
@endsection
