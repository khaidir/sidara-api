@extends('layouts.admin.app')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box mb-0 d-sm-flex align-items-center justify-content-between">
                    <h2 class="mb-sm-0 m-0 font-size-18 page-title">Profile</h2>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item">Profile</li>
                            <li class="breadcrumb-item active">Update</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-xl-8 col-sm-12">
                            <h4 class="card-title">Update Your Profile</h4>
                            <p class="card-title-desc">Please fill out the form below completely.</p>
                            <form action="/profile/store" method="post" class="needs-validation">
                                @csrf
                                <div class="row mb-4">
                                    <label for="name" class="col-sm-3 col-form-label">Your Name</label>
                                    <div class="col-sm-6">
                                        <input name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', @$data->name) }}" placeholder="Your Name">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-5">
                                        <input name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', @$data->email) }}" placeholder="Your Email">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-4">
                                        <input name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Your Password">
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm Password</label>
                                    <div class="col-sm-4">
                                        <input name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Your Password">
                                        @if ($errors->has('password_confirmation'))
                                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="position" class="col-sm-3 col-form-label">Position</label>
                                    <div class="col-sm-5">
                                        <input name="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position', @$data->position) }}" placeholder="Your Position">
                                        @if ($errors->has('position'))
                                            <span class="text-danger">{{ $errors->first('position') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="address" class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-8">
                                        <input name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', @$data->address) }}" placeholder="Your Address">
                                        @if ($errors->has('address'))
                                            <span class="text-danger">{{ $errors->first('address') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary w-md">Save</button>
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


@section('scripts')
<script>
$(document).ready(function() {
    $('select').select2({
        placeholder: 'Choose'
    });
});
</script>
@endsection
