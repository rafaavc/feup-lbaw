<div id="filterBar" class="input-group">
    <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fas fa-filter me-2"></i> Filter by</span>
    <select class="form-select clickable" aria-label="Category">
        <option selected>Category</option>
        <option value="1">Breakfast</option>
        <option value="2">Dessert</option>
        <option value="3">Main Dish</option>
        <option value="4">Beverage</option>
        <option value="5">Snack</option>
    </select>
    <button class="form-select text-left-align" type="button" data-bs-toggle="dropdown" aria-expanded="false">Tags</button>
    <ul class="dropdown-menu">
        <form class="px-3 py-2">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox">
                    Vegetarian
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox">
                    Sandwich
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox">
                    Low-carb
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox">
                    Zero sugar
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox">
                    French Cuisine
                </label>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Filter</button>
        </form>
    </ul>
    <select class="form-select clickable" aria-label="Difficulty">
        <option selected>Difficulty</option>
        <option value="1">Beginner</option>
        <option value="2">Pro</option>
        <option value="3">Trivial</option>
        <option value="4">Intermediate</option>
    </select>
    <button class="form-select text-left-align" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Rating">Rating</button>
    <ul class="dropdown-menu">
        <form class="px-3 py-2">
            <div class="mb-3">
                <label for="filterRatingMinInputDesktop" class="form-label visually-hidden">From</label>
                <div>From <span>0</span></div>
                <input type="range" class="form-range filter-rating-min-input" min="0" max="5" step="0.1" value="0" id="filterRatingMinInputDesktop">  
            </div>
            <div class="mb-3">
                <label for="filterRatingMaxInputDesktop" class="form-label visually-hidden">To</label>
                <div>To <span>5</span></div>
                <input type="range" class="form-range filter-rating-max-input" min="0" max="5" step="0.1" value="5" class="form-control" id="filterRatingMaxInputDesktop">
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    </ul> 
    <button class="form-select text-left-align" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Ingredients">Ingredients</button>
    <ul class="dropdown-menu">
        <form class="px-3 py-2">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox">
                    Tomatoes
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox">
                    Potatoes
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox">
                    Lettuce
                </label>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Filter</button>
        </form>
    </ul> 
    <button class="form-select text-left-align" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Publication date">Date</button>
    <ul class="dropdown-menu">
        <form class="px-3 py-2">
            <div class="mb-3">
                <label class="form-label">
                    From
                    <input type="date" class="form-control filter-date-min-input">
                </label>
            </div>
            <div class="mb-3">
                <label class="form-label">
                    To
                    <input type="date" class="form-control filter-date-max-input">
                </label> 
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    </ul> 
    <button class="form-select text-left-align" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Duration">Duration</button>
    <ul class="dropdown-menu">
        <form class="px-3 py-2">
            <div class="mb-3">
                <label for="filterDurationMinInputDesktop" class="form-label visually-hidden">From</label>
                <div>From <span>5min</span></div>
                <input type="range" class="form-range time-in-mins filter-duration-min-input" min="5" max="300" value="0" step="5" id="filterDurationMinInputDesktop">  
            </div>
            <div class="mb-3">
                <label for="filterDurationMaxInputDesktop" class="form-label visually-hidden">To</label>
                <div>To <span>5h</span></div>
                <input type="range" class="form-range time-in-mins filter-duration-max-input" min="5" max="300" value="600" step="5" class="form-control" id="filterDurationMaxInputDesktop">
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    </ul> 
</div>

<div id="sortBar" class="input-group mt-3">
    <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fas fa-sort me-2"></i>Sort by</span>
    <select class="form-select clickable" aria-label="Type to sort by">
        <option selected value="relevance">Relevance</option>
        <option value="published_date">Date published</option>
        <option value="title">Title</option>
        <option value="cost">Cost</option>
        <option value="duration">Duration</option>
        <option value="rating">Rating</option>
    </select>
    <select class="form-select clickable" aria-label="Order to sort by">
        <option selected value="desc">Descendant</option>
        <option value="asc">Ascendant</option>
    </select>
</div>


<button id="filterBarMobileHeading" class="btn btn-secondary collapsed me-2 mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#filterButtons" aria-expanded="false" aria-controls="filterButtons">
    <i class="fas fa-filter"></i> Filter
</button>

<button id="sortBarMobileHeading" class="btn btn-secondary collapsed mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#sortButtons" aria-expanded="false" aria-controls="sortButtons">
    <i class="fas fa-sort"></i> Sort
</button>

<script>
    const filterButton = document.querySelector('#filterBarMobileHeading');
    const sortButton = document.querySelector('#sortBarMobileHeading');

    filterButton.addEventListener('click', () => {
        if (sortButton.getAttribute('aria-expanded') === "true") sortButton.click()
    });

    sortButton.addEventListener('click', () => {
        if (filterButton.getAttribute('aria-expanded') === "true") filterButton.click()
    });
</script>

<div id="filterBarMobile">
    <div id="filterButtons" class="collapse" aria-labelledby="filterBarMobileHeading" data-bs-parent="#filterBarMobile">
        <!-- Start of filter buttons accordion -->    
        <div id="filterBarMobileOptions" class="accordion">
            <div class="accordion-item accordion-header">
                <select class="accordion-button form-select collapsed" aria-label="Category">
                    <option selected>Category</option>
                    <option value="1">Breakfast</option>
                    <option value="2">Dessert</option>
                    <option value="3">Main Dish</option>
                    <option value="4">Beverage</option>
                    <option value="5">Snack</option>
                </select>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="tagsHeading">
                    <button class="accordion-button form-select collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tagsBody" aria-expanded="false" aria-controls="tagsBody">
                        Tags
                    </button>
                </h2>
                <div id="tagsBody" class="accordion-collapse collapse" aria-labelledby="tagsHeading" data-bs-parent="#filterBarMobileOptions">
                    <div class="accordion-body">
                        <form class="px-3 py-2">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox">
                                    Vegetarian
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox">
                                    Sandwich
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox">
                                    Low-carb
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox">
                                    Zero sugar
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox">
                                    French Cuisine
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="accordion-item accordion-header">
                <select class="accordion-button form-select collapsed" aria-label="Difficulty">
                    <option selected>Difficulty</option>
                    <option value="1">Beginner</option>
                    <option value="2">Pro</option>
                    <option value="3">Trivial</option>
                    <option value="4">Intermediate</option>
                </select>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="ratingHeading">
                    <button class="accordion-button form-select collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ratingBody" aria-expanded="false" aria-controls="ratingBody">
                        Rating
                    </button>
                </h2>
                <div id="ratingBody" class="accordion-collapse collapse" aria-labelledby="ratingHeading" data-bs-parent="#filterBarMobileOptions">
                    <div class="accordion-body">
                        <form class="px-3 py-2">
                            <div class="mb-3">
                                <label for="filterRatingMinInputMobile" class="form-label visually-hidden">From</label>
                                <div>From <span>0</span></div>
                                <input type="range" class="form-range filter-rating-min-input" min="0" max="5" step="0.1" value="0" id="filterRatingMinInputMobile">  
                            </div>
                            <div class="mb-3">
                                <label for="filterRatingMaxInputMobile" class="form-label visually-hidden">To</label>
                                <div>To <span>5</span></div>
                                <input type="range" class="form-range filter-rating-max-input" min="0" max="5" step="0.1" value="5" class="form-control" id="filterRatingMaxInputMobile">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="ingredientsHeading">
                    <button class="accordion-button form-select collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ingredientsBody" aria-expanded="false" aria-controls="ingredientsBody">
                        Ingredients
                    </button>
                </h2>
                <div id="ingredientsBody" class="accordion-collapse collapse" aria-labelledby="ingredientsHeading" data-bs-parent="#filterBarMobileOptions">
                    <div class="accordion-body">
                        <form class="px-3 py-2">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox">
                                    Tomatoes
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox">
                                    Potatoes
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox">
                                    Lettuce
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="dateHeading">
                    <button class="accordion-button form-select collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#dateBody" aria-expanded="false" aria-controls="dateBody">
                        Date
                    </button>
                </h2>
                <div id="dateBody" class="accordion-collapse collapse" aria-labelledby="dateHeading" data-bs-parent="#filterBarMobileOptions">
                    <div class="accordion-body">
                        <form class="px-3 py-2">
                            <div class="mb-3">
                                <label class="form-label">
                                    From
                                    <input type="date" class="form-control filter-date-min-input">
                                </label>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    To
                                    <input type="date" class="form-control filter-date-max-input">
                                </label> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="durationHeading">
                    <button class="accordion-button form-select collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#durationBody" aria-expanded="false" aria-controls="durationBody">
                        Duration
                    </button>
                </h2>
                <div id="durationBody" class="accordion-collapse collapse" aria-labelledby="durationHeading" data-bs-parent="#filterBarMobileOptions">
                    <div class="accordion-body">
                        <form class="px-3 py-2">
                            <div class="mb-3">
                                <label for="filterDurationMinInputMobile" class="form-label visually-hidden">From</label>
                                <div>From <span>5min</span></div>
                                <input type="range" class="form-range time-in-mins filter-duration-min-input" min="5" max="300" value="0" step="5" id="filterDurationMinInputMobile">  
                            </div>
                            <div class="mb-3">
                                <label for="filterDurationMaxInputMobile" class="form-label visually-hidden">To</label>
                                <div>To <span>5h</span></div>
                                <input type="range" class="form-range time-in-mins filter-duration-max-input" min="5" max="300" value="600" step="5" class="form-control" id="filterDurationMaxInputMobile">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of filter buttons accordion -->
    </div>
</div>

<div id="sortBarMobile">
    <div id="sortButtons" class="collapse" aria-labelledby="sortBarMobileHeading" data-bs-parent="#sortBarMobile">
        <!-- Start of sort buttons accordion -->    
        <div id="sortBarMobileOptions" class="accordion">
            <div class="accordion-item accordion-header">
                <select class="accordion-button form-select collapsed" aria-label="Type to sort by">
                    <option selected value="relevance">Relevance</option>
                    <option value="published_date">Date published</option>
                    <option value="title">Title</option>
                    <option value="cost">Cost</option>
                    <option value="duration">Duration</option>
                    <option value="rating">Rating</option>
                </select>
            </div>
            <div class="accordion-item accordion-header">
                <select class="accordion-button form-select collapsed" aria-label="Order to sort by">
                    <option selected value="desc">Descendant</option>
                    <option value="asc">Ascendant</option>
                </select>
            </div>
        </div>
        <!-- End of filter buttons accordion -->
    </div>
</div>