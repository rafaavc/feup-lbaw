@extends('layouts.app')

@section('title', "Users Management")

@push('css')
    <link href="{{ asset('css/components/breadcrumb.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/components/adminArea.css') }}" rel="stylesheet"/>
@endpush

@section('content')

    @include('partials.breadcrumb', ['pages' => ["Users Management"], 'withoutMargin' => false])

    <div class="content-general-margin mt-5 margin-to-footer">
        <h1 class="mb-4">Users Management</h1>
        <div class="d-flex admin-search-input">
            <input type="text" class="form-control icon-right mb-3" placeholder="Search" aria-label="User Search Query">
            <i class="fas fa-search fa-icon-right"></i>
        </div>
        <div class="card">
            <div class="card-body table-responsive">
                @if(count($users) > 0)
                    <table class="table align-middle table-striped table-hover">
                        <thead>
                            <th >Username</th>
                            <th >Name</th>
                            <th colspan="3">E-Mail</th>
                            <th>Country</th>
                            <th>City</th>
                            <th>N<sup>er</sup> of posts</th>
                            <th>N<sup>er</sup> of comments</th>
                            <th>N<sup>er</sup> of reports</th>
                            <th colspan="3">Actions</th>
                        </thead>
                        <tbody>
                            @if(count($users) > 0)
                                @foreach ($users as $user)
                                    @include('partials.admin.userRow', ['user' => $user])
                                @endforeach
                            @else
                                <h1>No users to be shown.<h1>
                            @endif
                        </tbody>
                    </table>
                @else
                    <h1>No users to be shown.<h1>
                @endif
            </div>
        </div>
    </div>

@endsection
