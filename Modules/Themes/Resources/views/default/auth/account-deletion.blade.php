@extends('themes::default.layout')
@section('content')
    <section class="pb-4">
        <div class="home-center">
            <div class="home-desc-center">
                <div class="container">
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="row mb-2 text-center">
                                <div class="col-md-12">
                                    <h3 style="color: white;"><strong>@lang('Request Account Deletion')</strong></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <p>@lang('To request deletion of your account, please provide your registered email and phone number. We will review your request and get back to you.')</p>
                
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <form method="post" action="{{ route('account.deletion.submit') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label label-required">@lang('Email Address') <span style="color: red;">*</span></label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required />
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="list-unstyled mb-0">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <div class="row justify-content-center">
                                <div class="col-auto">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger">@lang('Submit Deletion Request')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
