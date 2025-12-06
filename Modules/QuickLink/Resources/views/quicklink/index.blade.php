@extends('core::layouts.app')
@section('title', __('Quick Links'))
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-4 text-gray-800">@lang('Quick Links')</h1>
        <div class="ml-auto d-sm-flex">
            <a href="{{ route('quick-link.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> @lang('Create Quick Link')
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if ($data->count() > 0)
                <div class="card">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>@lang('Title')</th>
                                    <th>@lang('Link Url')</th>
                                    <th>@lang('Serial')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $link)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $link->title }}</td>
                                        <td>{{ $link->link_url }}</td>
                                        <td>{{ $link->serial }}</td>
                                        <td>
                                            @if ($link->is_active)
                                                <span class="small text-success"><i class="fas fa-check-circle"></i>
                                                    @lang('Active')</span>
                                            @else
                                                <span class="small text-danger"><i class="fas fa-times-circle"></i>
                                                    @lang('No Active')</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('quick-link.edit', $link) }}"><span
                                                        class="badge badge-primary mr-2">@lang('Edit')</span></a>
                                                <form method="post" action="{{ route('quick-link.destroy', $link->id) }}"
                                                    onsubmit="return confirm('@lang('Confirm delete?')');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="badge badge-danger border-0">
                                                        @lang('Delete')
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            <div class="mt-4">
                {{ $data->appends(Request::all())->links() }}
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            @if ($data->count() == 0)
                <div class="text-center">
                    <div class="error mx-auto mb-3"><i class="fas fa-link"></i></div>
                    <p class="lead text-gray-800">@lang('No Link Found')</p>
                    <p class="text-gray-500">@lang("You don't have any job").</p>
                    <a href="{{ route('quick-link.create') }}" class="btn btn-primary">
                        <span class="text">@lang('New Link')</span>
                    </a>
                </div>
            @endif
        </div>
    </div>

@stop
