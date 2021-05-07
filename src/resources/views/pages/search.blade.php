@extends('layouts.app')

@section('title', "Search Results" )

@push('css')
    <link href="{{ asset('css/search.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/components/search_results_cards.css') }}" rel="stylesheet" />
@endpush

@section('content')

    @php
        $breadcrumbArgs = array();
        $hasSearch = $searchStr != null;
        ($hasSearch) ? array_push($breadcrumbArgs, "Recipe", $searchStr) : array_push($breadcrumbArgs, "Recipe");
    @endphp
    @include('partials.breadcrumb', ['pages' => $breadcrumbArgs, 'withoutMargin' => false])

    <div class="container search-page content-general-margin mt-5 margin-to-footer">
        <div class="search-header">
            <h1 class="mb-5">Search Results</h1>

            @include('partials.search.filterSortBar')

            <div class="col info-text mt-5">
                @if($hasSearch)
                    <strong>{{ $numResults }}</strong>
                    Results for "<strong>{{ $searchStr }}</strong>"
                @else
                    <strong>Results:</strong>
                @endif
            </div>
            <div class="card shadow-sm w-auto h-auto search-area searched-recipes p-2 p-sm-4 mb-5 mt-3">
                <h3 class="section-title ps-2 mb-4 text-center text-md-start">Recipes</h3>
                <div class="row gx-2 gy-5 justify-content-around justify-content-md-between items mx-0">
                    @if(count($recipes) > 0)
                        @foreach ($recipes as $recipe)
                            <div class="col-lg-1 col-md-6 w-auto">
                                @include('partials.search.recipeCard', ['recipe' => $recipe])
                            </div>
                        @endforeach
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center mt-4">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">Page 1 of 12</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    @else
                        <h3>No results found.</h3>
                    @endif
                </div>
            </div>
            <div class="card shadow-sm p-2 w-auto h-auto search-area searched-recipes p-sm-4 my-5">
                <h3 class="section-title ps-2 mb-4 text-center text-md-start">People</h3>
                <div class="row gx-2 gy-5 justify-content-around justify-content-md-between items mx-0">
                   @if(count($users) > 0)
                        @foreach ($users as $user)
                            <div class="col-lg-1 col-md-6 w-auto">
                                @include('partials.search.userCard', ['user' => $user])
                            </div>
                        @endforeach
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center mt-4">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">Page 1 of 12</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    @else
                        <h3>No results found.</h3>
                    @endif
                </div>
            </div>
            <div class="card shadow-sm p-2 w-auto h-auto search-area searched-recipes p-sm-4 my-5">
                <h3 class="section-title ps-2 mb-4 text-center text-md-start">Categories</h3>
                <div class="row gx-2 gy-5 justify-content-around justify-content-md-between items mx-0">
                    @if(count($categories) > 0)
                        @foreach ($categories as $category)
                            <div class="col-lg-1 col-md-6 w-auto">
                                @include('partials.search.categoryCard', ['category' => $category])
                            </div>
                        @endforeach
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center mt-4">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">Page 1 of 12</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    @else
                        <h3>No results found.</h3>
                    @endif
                </div>
            </div>
            <div class="card shadow-sm p-2 w-auto h-auto search-area searched-recipes p-sm-4 my-5">
                <h3 class="section-title ps-2 mb-4 text-center text-md-start">Groups</h3>
                <div class="row gx-2 gy-5 justify-content-around justify-content-md-between items mx-0">
                    {{-- @if(count($groups) > 0)
                        @foreach ($groups as $group)
                            <div class="col-lg-1 col-md-6 w-auto">
                                @include('partials.search.groupCard', ['group' => $group])
                            </div>
                        @endforeach
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center mt-4">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">Page 1 of 12</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    @else
                        <h3>No results found.</h3>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
@endsection
