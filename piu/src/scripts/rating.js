
let count;

function starmark(item) {
    count = item.id[0];
    let subid = item.id.substring(1);
    for(let i = 0; i < 5; i++) {
        if(i < count)
            document.getElementById((i+1)+subid).style.color="orange";
        else
            document.getElementById((i+1)+subid).style.color="black";
    }
}

function result() {
    alert("Rating: " + count);
}
