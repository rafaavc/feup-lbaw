
let count;

function starmark(item) {
    count = item.id[0];
    let subid = item.id.substring(1);
    for (let i = 0; i < 5; i++) {
        if (i < count)
            document.getElementById((i + 1) + subid).classList.add("active");
        else
            document.getElementById((i + 1) + subid).classList.remove("active");
    }
}

function result() {
    alert("Rating: " + count);
}
