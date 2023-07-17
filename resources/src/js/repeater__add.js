document.addEventListener('DOMContentLoaded', function () {
    const repeater__add__list = document.querySelectorAll(".repeater__add");

    for (let i = 0; i < repeater__add__list.length; i++) {
        repeater__add__list[i].addEventListener("click", function(this) {
            AddRepeaterBox(this);
        });
    }
}, false);
function AddRepeaterBox(element){
    console.log(element);
}
