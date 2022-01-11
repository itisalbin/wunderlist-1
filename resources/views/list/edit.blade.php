@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-4 col-md-6 col-10">
            <h1>Update list</h1>
            <div class="row">
                <form action="{{ route('list.patch', $list->getHashId()) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-group row pt-3 required">
                        <label for="title" class="col-4 col-form-label">Title</label>
                        <div class="col-8">
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title') ?? $list->title }}" placeholder="My awesome list" autofocus>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
