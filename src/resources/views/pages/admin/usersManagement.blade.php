@extends('layouts.app')

@section('title', "Users Management")

@push('css')
    <link href="{{ asset('css/components/breadcrumb.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/adminArea.css') }}" rel="stylesheet"/>
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
                    <table class="table align-middle table-striped table-hover users-table">
                        <thead>
                            <th style="padding: 0; padding-bottom: 0.5em;">Username</th>
                            <th style="padding: 0; padding-bottom: 0.5em;">Name</th>
                            <th style="padding: 0; padding-bottom: 0.5em;">E-Mail</th>
                            <th style="padding: 0; padding-bottom: 0.5em;">Country</th>
                            <th style="padding: 0; padding-bottom: 0.5em;">City</th>
                            <th style="padding: 0; padding-bottom: 0.5em; padding-right: 1em;">N<sup>er</sup> of posts</th>
                            <th style="padding: 0; padding-bottom: 0.5em; padding-right: 1em;">N<sup>er</sup> of Cmts.</th>
                            <th style="padding: 0; padding-bottom: 0.5em; padding-right: 1em;">N<sup>er</sup> of reports</th>
                            <th style="padding: 0; padding-bottom: 0.5em;" class="text-center">Actions</th>
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
