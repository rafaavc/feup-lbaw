<div class="{{ $mobile ? "d-block d-xl-none" : "d-none d-xl-block" }}">
    <div class="media my-4 my-md-0">
        <img class="img-fluid main" src="https://dpv87w1mllzh1.cloudfront.net/alitalia_discover/attachments/data/000/002/587/original/la-ricetta-classica-del-tiramisu-con-uova-savoiardi-e-mascarpone-1920x1080.jpg?1567093636">
        <div class="small-img d-flex">
            <img class="col-3" src="https://imagesvc.meredithcorp.io/v3/mm/image?url=https%3A%2F%2Fimages.media-allrecipes.com%2Fuserphotos%2F2270040.jpg&w=596&h=596&c=sc&poi=face&q=85">
            <img class="col-3" src="https://imagesvc.meredithcorp.io/v3/mm/image?url=https%3A%2F%2Fimages.media-allrecipes.com%2Fuserphotos%2F339568.jpg&w=595&h=595&c=sc&poi=face&q=85">
            <img class="col-3" src="https://imagesvc.meredithcorp.io/v3/mm/image?url=https%3A%2F%2Fimages.media-allrecipes.com%2Fuserphotos%2F378412.jpg&w=596&h=596&c=sc&poi=face&q=85">
            <img class="col-3" src="https://imagesvc.meredithcorp.io/v3/mm/image?url=https%3A%2F%2Fimages.media-allrecipes.com%2Fuserphotos%2F11110.jpg&w=596&h=399&c=sc&poi=face&q=85">
        </div>
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
                    <input type="range" class="form-range" min="1" max="10" id="yieldsInput<?= $mobile ? "-mobile" : "" ?>" value="3">
                    <input type="reset" class="btn btn-sm btn-outline-secondary mt-3" onclick="calculateQuantities()" value="Reset servings">
                </form>
            </section>
        </div>
    </div>
</div>
