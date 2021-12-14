@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="row">
                <div class="col-4 d-flex justify-content-center">
                    <img class="rounded-circle" src="{{ $user->profile_picture ?? "https://via.placeholder.com/100x100" }}" style="width:100px;object-fit:cover;">
                </div>
                <div class="col-8 d-flex align-items-center">
                    <h3>{{ $user->name }}</h3>
                </div>
            </div>
            <hr>
            <div class="row">
                <form action="/profile/update" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PATCH")
                    <h4>Update user information</h4>
                    <div class="form-group row pt-3">
                        <label for="name" class="col-4 col-form-label">Name</label>
                        <div class="col-8">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') ?? $user->name }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row pt-3">
                        <label for="email" class="col-4 col-form-label">Email</label>
                        <div class="col-8">
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') ?? $user->email }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row pt-3">
                        <label for="profile_picture" class="col-4 col-form-label">Profile picture</label>
                        <div class="col-8">
                            <input type="file" name="profile_picture" class="form-control @error('profile_picture') is-invalid @enderror" id="profile_picture">
                            @error('profile_picture')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3" name="user_update">Update</button>
                </form>
                <form action="/profile/update" method="POST" class="pt-5">
                    @csrf
                    @method("PATCH")
                    <h4>Update password</h4>
                    <div class="form-group row pt-3">
                        <label for="oldpassword" class="col-4 col-form-label">Old password</label>
                        <div class="col-8">
                            <input type="text" name="oldpassword" class="form-control @error('oldpassword') is-invalid @enderror" id="oldpassword">
                            @error('oldpassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row pt-3">
                        <label for="newpassword" class="col-4 col-form-label">New password</label>
                        <div class="col-8">
                            <input type="text" name="newpassword" class="form-control @error('newpassword') is-invalid @enderror" id="newpassword">
                            @error('newpassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3" name="password_update">Update</button>
                </form>
                <div class="stats pt-5">
                    <h4>Statistics</h4>
                    <div class="row pt-3">
                        <div class="col-4">Number of lists</div>
                        <div class="col-8">123</div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-4">Completed items</div>
                        <div class="col-8">1</div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-4">Uncompleted items</div>
                        <div class="col-8">2</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!--
Needed:

Profile image
Name
Email
Number of lists?
Completed/uncompleted items
Change password
-->
