let ingredientsSection = document.getElementById("ingredients")
let ingredientsNumbers = document.getElementsByClassName("number")

let yieldsInput = document.getElementById("yieldsInput")
let yieldsInputMobile = document.getElementById("yieldsInput-mobile")
let defaultYield = yieldsInput.value

let defaultQuantities = []
for (const cell of ingredientsNumbers) {
    defaultQuantities.push(parseFloat(cell.innerHTML))
}

function calculateQuantities(factor = 1) {
    for (let i = 0; i < ingredientsNumbers.length; i++) {
        ingredientsNumbers[i].innerHTML = Math.round((defaultQuantities[i] * factor + Number.EPSILON) * 100) / 100
    }
}

yieldsInput.addEventListener("input", () => {
    calculateQuantities(parseInt(yieldsInput.value) / defaultYield)
})

yieldsInputMobile.addEventListener("input", () => {
    calculateQuantities(parseInt(yieldsInput.value) / defaultYield)
})
