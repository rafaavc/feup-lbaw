@extends('layouts.app')

@section('title', "Users Management")

@push('css')
    <link href="{{ asset('css/components/breadcrumb.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/adminArea.css') }}" rel="stylesheet"/>
@endpush

@push('js')
    <script src="{{ asset('js/usersManagement.js') }}" type="module"></script>
@endpush

@section('content')

    @include('partials.breadcrumb', ['pages' => ["Users Management" => ""], 'withoutMargin' => false])

    <div class="content-general-margin user-search-page mt-5 margin-to-footer">
        <h1 class="mb-4">Users Management</h1>
        <form class="search-users-form" method="GET">
            <div class="d-flex admin-search-input">
                <input type="text" class="form-control icon-right mb-3" placeholder="Search" aria-label="User Search Query" name="searchUser">
                <i class="fas fa-search fa-icon-right"></i>
            </div>
        </form>
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table align-middle table-striped table-hover users-table">
                    <thead>
                        <tr>
                            <th style="padding: 0; padding-bottom: 0.5em;">Username</th>
                            <th style="padding: 0; padding-bottom: 0.5em;">Name</th>
                            <th style="padding: 0; padding-bottom: 0.5em;">E-Mail</th>
                            <th style="padding: 0; padding-bottom: 0.5em;">Country</th>
                            <th style="padding: 0; padding-bottom: 0.5em;">City</th>
                            <th style="padding: 0; padding-bottom: 0.5em; padding-right: 1em;">N<sup>er</sup> of posts</th>
                            <th style="padding: 0; padding-bottom: 0.5em; padding-right: 1em;">N<sup>er</sup> of Cmts.</th>
                            <th style="padding: 0; padding-bottom: 0.5em; padding-right: 1em;">N<sup>er</sup> of reports</th>
                            <th style="padding: 0; padding-bottom: 0.5em;" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                @include('partials.search.pagination', ['navigationClass' => 'users-navigation', 'paginationClass' => 'users-page'])
            </div>
        </div>
    </div>

@endsection
