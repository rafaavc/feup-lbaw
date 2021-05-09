import { makeRequest } from './ajax/methods.js'
import { getRootUrl } from './utils/getRootUrl.js';

const createCommentForm = document.querySelector('form[name=createCommentForm]');
const ratingInput = createCommentForm.querySelector('input[name=rating]');
const stars = document.querySelectorAll('.rating-input-star');
const ratingInputCancel = document.querySelector('#ratingInputCancel');

ratingInputCancel.style.display = 'none';

// TODO IF COMMENT WITH RATING IS DELETED, PUT DISPLAY = 'BLOCK' NO .rating-input

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

const removeCommentErrorMessage = () => {
    const errorElements = document.querySelectorAll('.createCommentFormErrors');
    for (const elem of errorElements) elem.remove();
}

const handleCommentFormSubmit = (event) => {
    event.preventDefault();
    const rating = createCommentForm.querySelector('input[name=rating]').value;
    const textarea = createCommentForm.querySelector('textarea[name=content]');
    const body = {
        'recipeId': createCommentForm.querySelector('input[name=recipeId]').value,
        'content': textarea.value
    };

    let hasRating = false;
    if (rating != '0' && rating != null) {
        body.rating = rating;
        hasRating = true;
    }
    console.log("Sending comment", body);
    makeRequest(getRootUrl() + '/api/comment', 'POST', body)
        .then((result) => {
            if (result.response.status == 200) {
                createCommentForm.insertAdjacentHTML('beforebegin', result.content.comment);
                textarea.value = '';
                if (hasRating) document.querySelector('.rating-input').style.display = 'none';
                removeCommentErrorMessage();
                removeRating();
            } else {
                setErrorMessage(result.content.message);
            }
        });
}

createCommentForm.addEventListener('submit', handleCommentFormSubmit);
