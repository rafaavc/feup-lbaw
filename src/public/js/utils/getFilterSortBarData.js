export const filterBarForm = document.querySelector('form[name=filterBar]');

export const getFilterSortBarData = () => {
    const tags = [];
    const allTags = [...document.querySelectorAll('.tag-filter-checkbox')];
    for (const tag of allTags) {
        if (tag.checked) tags.push(tag.dataset.id);
    }

    const data = {};
    if (allTags.length != 0) data.tags = tags.join(',');
    const category = filterBarForm.querySelector('select[name=category]')?.value;
    if (category) data.category = category;
    console.log("Filter bar data: ", data, category, tags);
    return data;
}
