<div class="{{ $mobile ? "d-block d-xl-none" : "d-none d-xl-block" }}">
    <div class="media my-4 my-md-0">
        @if(sizeof($images) > 0)
            <img class="img-fluid main" src="{{ $images[0] }}" alt="main image for the recipe">
        @else
            <img class="img-fluid main" src="{{ asset('storage/images/no_image.jpg') }}" alt="default image for recipes">
        @endif

        @if(sizeof($images) > 1)
            <div class="small-img d-flex">
                @foreach($images as $idx => $image)
                    @if($idx != 0)
                        <img class="col-3" src="{{ $image }}" alt="image {{$idx + 1}} of recipe">
                    @endif
                @endforeach
            </div>
        @endif
    </div>
    <div class="row mt-5">
        <div class="col-sm-6">
            <section class="icon-box mb-4 mt-md-0">
                <i class="fas fa-clock"></i>
                @php
                    $duration = $recipe->preparation_time + $recipe->cooking_time + $recipe->additional_time;
                @endphp
                @include('partials.recipe.boxContent', [ "content" => [
                    "Duration" => $duration != null ? $duration." mins" : "-",
                    "Preparation" => ($recipe->preparation_time != null ? $recipe->preparation_time." mins" : "-"),
                    "Cooking" => ($recipe->cooking_time != null ? $recipe->cooking_time." mins" : "-"),
                    "Additional" => ($recipe->additional_time != null ? $recipe->additional_time." mins" : "-")
                ]])
            </section>
        </div>
        <div class="col-sm-6">
            <section class="icon-box mt-md-0 p-2">
                <i class="fas fa-chart-bar"></i>
                <form>
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td>
                                <label for="yieldsInput" class="form-label">Yields</label>
                            </td>
                            <td>
                                <span class="number">{{ $recipe->servings }}</span> servings
                            </td>
                        </tr>
                    </table>
                </form>
            </section>
        </div>
    </div>
</div>
