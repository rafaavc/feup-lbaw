import { makeRequest } from './ajax/methods.js'
import { getRootUrl } from './utils/getRootUrl.js';

const createCommentForm = document.querySelector('form[name=createCommentForm]');
const ratingInput = createCommentForm.querySelector('input[name=rating]');
const stars = document.querySelectorAll('.rating-input-star');
const ratingInputCancel = document.querySelector('#ratingInputCancel');

ratingInputCancel.style.display = 'none';

const starmark = (event) => {
    const count = event.target.id[0];
    if (event.type == 'click') {
        ratingInput.value = count;
        ratingInputCancel.style.display = 'inline';
    }

    const subid = event.target.id.substring(1);
    for (let i = 0; i < 5; i++) {
        const star = document.getElementById((i + 1) + subid);
        if (event.type == 'mouseout') {
            star.classList.remove("hover");
            continue;
        }
        if (i < count) {
            if (event.type == 'click') star.classList.add("active");
            else star.classList.add("hover");
        }
        else {
            if (event.type == 'click') star.classList.remove("active");
            else star.classList.remove("hover");
        }
    }
}

const removeRating = () => {
    ratingInput.value = 0;
    const subid = ratingInputCancel.nextElementSibling.id.substring(1);
    for (let i = 0; i < 5; i++) {
        const star = document.getElementById((i + 1) + subid);
        star.classList.remove("active");
    }
    ratingInputCancel.style.display = 'none';
}

for (const star of stars) {
    star.addEventListener('click', starmark);
    star.addEventListener('mouseover', starmark);
    star.addEventListener('mouseout', starmark);
}
ratingInputCancel.addEventListener('click', removeRating);

const setErrorMessage = (message) => {
    const errorElements = document.querySelectorAll('.createCommentFormErrors');
    if (errorElements.length == 0) {
        createCommentForm.insertAdjacentHTML('beforebegin', `<div class="alert alert-danger createCommentFormErrors">
            ${message}
        </div>`);
    } else {
        for (const elem of errorElements) elem.innerText = message;
    }
}

const handleCommentFormSubmit = (event) => {
    event.preventDefault();
    const rating = createCommentForm.querySelector('input[name=rating]').value;
    const textarea = createCommentForm.querySelector('textarea[name=content]');
    const body = {
        'recipeId': createCommentForm.querySelector('input[name=recipeId]').value,
        'content': textarea.value
    };
    if (rating != '0') body.rating = rating;
    console.log("Sending comment:", body);
    makeRequest(getRootUrl() + '/api/comment', 'POST', body)
        .then((result) => {
            if (result.response.status == 200) {
                createCommentForm.insertAdjacentHTML('beforebegin', result.content.comment);
                textarea.value = '';
                removeRating();
            } else {
                // TODO add error message and not let user give rating when it already has given one.
                setErrorMessage(result.content.message);
            }
        });
}

createCommentForm.addEventListener('submit', handleCommentFormSubmit);
