let addToFavouritesButtons = document.getElementsByClassName("add-to-favourites-button")

function fixFavouritesButtonText(button) {
    let text = button.getElementsByClassName("button-caption")[0]
    text.innerHTML = button.firstElementChild.classList.contains("added") ? "Remove from favourites" : "Add to favourites"
}

for (const button of addToFavouritesButtons) {
    fixFavouritesButtonText(button)

    button.addEventListener("click", () => {
        button.firstElementChild.classList.toggle("added")
        fixFavouritesButtonText(button)
    })
}