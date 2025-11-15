@extends('themes::default.layout')
@section('content')
    @include('themes::default.nav')

    <div class="employer-header bg-light blog-detail-header">
        <div class="container">
            <div class="clearfix">
                <div class="text-center">
                    <div class="employer-info-detail">
                        <div class="title-wrapper">
                            <h1 class="employer-title text-center">{{ $blog->title }}</h1>
                        </div>
                        <div class="employer-metas mt-3">
                            <div class="employer-location">
                                <a
                                    href="{{ route('blogs', ['category_id' => $blog->category->id]) }}">{{ $blog->category->name }}</a>
                            </div>
                            <div class="employer-location">
                                {{ \Carbon\Carbon::parse($blog->created_at)->toFormattedDateString() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row pt-4">
            <div class="col-md-8">
                <div class="blog-content" style="max-width: 100% !important;">
                    <div class="thumb-image">
                        <figure class="entry-thumb"><a class="blog-thumbnail" href="{{ $blog->getPublishLink() }}"
                                aria-hidden="true">
                                <div class="image-wrapper">
                                    <img width="388" height="250" src="{{ $blog->getThumbLink() }}" class="img-fluid"
                                        alt="">
                                </div>
                            </a></figure>
                    </div>
                    <div class="inner-bottom">
                        <div class="top-info">
                            <div class="date">
                                {{ $blog->category->name }} ||
                                {{ \Carbon\Carbon::parse($blog->created_at)->toFormattedDateString() }}
                            </div>
                        </div>
                        <h4 class="entry-title">
                            <a href="{{ $blog->getPublishLink() }}">{{ $blog->title }}</a>
                        </h4>
                        <div class="description">{!! $blog->content !!}</div>
                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <h3>@lang('Other Related Blogs')</h3>
                <div class="row">
                    @foreach ($other_blogs as $item)
                        <div class="col-md-12">
                            @include('themes::default.includes.item_blog', ['blog' => $item])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop
