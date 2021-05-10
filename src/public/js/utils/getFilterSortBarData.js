export const filterBarForm = document.querySelector('form[name=filterBar]');

export const getFilterSortBarData = () => {
    const tags = [];
    const allTags = [...document.querySelectorAll('.tag-filter-checkbox')];
    for (const tag of allTags) {
        if (tag.checked) tags.push(tag.dataset.id);
    }

    const ingredients = [];
    const allIngredients = [...document.querySelectorAll('.ingredient-filter-checkbox')];
    for (const ingredient of allIngredients) {
        if (ingredient.checked) ingredients.push(ingredient.dataset.id);
    }

    const data = {};
    if (tags.length != 0) data.tags = tags.join(',');
    if (ingredients.length != 0) data.ingredients = ingredients.join(',');
    const category = filterBarForm.querySelector('select[name=category]')?.value;
    if (category) data.category = category;
    const difficulty = filterBarForm.querySelector('select[name=difficulty]')?.value;
    if (difficulty) data.difficulty = difficulty;

    return data;
}
