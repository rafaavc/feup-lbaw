@extends('layouts.app')

@section('title', "Search Results" )

@push('css')
    <link href="{{ asset('css/search.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/components/search_results_cards.css') }}" rel="stylesheet" />
@endpush

@push('js')
    <script src="{{ asset('js/searchResults.js') }}" type="module" defer></script>
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
                <strong class="total-results"></strong>
                Results for "<strong class="search-result"></strong>"
            </div>
            <div class="card shadow-sm w-auto h-auto search-area searched-recipes p-2 p-sm-4 mb-5 mt-3">
                <h3 class="section-title ps-2 mb-4 text-center text-md-start">Recipes</h3>
                <div class="row gx-2 gy-5 justify-content-around justify-content-md-between items mx-0 recipes-box">
                    <nav aria-label="Page navigation" class="recipes-navigation">
                        <ul class="pagination justify-content-center mt-4">
                            <li class="page-item">
                                <a class="page-link" aria-label="Previous">
                                    &laquo;
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link recipes-page" href="#">Page 1 of 1</a></li>
                            <li class="page-item">
                                <a class="page-link" aria-label="Next">
                                    &raquo;
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="card shadow-sm p-2 w-auto h-auto search-area searched-recipes p-sm-4 my-5">
                <h3 class="section-title ps-2 mb-4 text-center text-md-start">People</h3>
                <div class="row gx-2 gy-5 justify-content-around justify-content-md-between items mx-0 people-box">
                    <nav aria-label="Page navigation" class="people-navigation">
                        <ul class="pagination justify-content-center mt-4">
                            <li class="page-item">
                                <a class="page-link" aria-label="Previous">
                                    &laquo;
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link people-page" href="#">Page 1 of 1</a></li>
                            <li class="page-item">
                                <a class="page-link" aria-label="Next">
                                    &raquo;
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="card shadow-sm p-2 w-auto h-auto search-area searched-recipes p-sm-4 my-5">
                <h3 class="section-title ps-2 mb-4 text-center text-md-start">Categories</h3>
                <div class="row gx-2 gy-5 justify-content-around justify-content-md-between items mx-0 categories-box">
                    <nav aria-label="Page navigation" class="categories-navigation">
                        <ul class="pagination justify-content-center mt-4">
                            <li class="page-item">
                                <a class="page-link" aria-label="Previous">
                                    &laquo;
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link categories-page" href="#">Page 1 of 1</a></li>
                            <li class="page-item">
                                <a class="page-link" aria-label="Next">
                                    &raquo;
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            {{-- <div class="card shadow-sm p-2 w-auto h-auto search-area searched-recipes p-sm-4 my-5">
                <h3 class="section-title ps-2 mb-4 text-center text-md-start">Groups</h3>
                <div class="row gx-2 gy-5 justify-content-around justify-content-md-between items mx-0 groups-box">
                    <nav aria-label="Page navigation groups-navigation">
                        <ul class="pagination justify-content-center mt-4">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    &laquo;
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link groups-page" href="#">Page 1 of of {{ round(count($groups) / $itemsPerSection) }}</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    &raquo;
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
