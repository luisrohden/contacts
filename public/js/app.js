document.addEventListener('DOMContentLoaded', function () {
    const repeater__add__list = document.querySelectorAll(".repeater__add");

    for (let i = 0; i < repeater__add__list.length; i++) {
        repeater__add__list[i].addEventListener("click", function(element) {
            AddRepeaterBox(element.target);
        });
    }
}, false);
function AddRepeaterBox(element){
    var repeater = element.closest('.repeater');
    var content = repeater.querySelector('.repeater__content:first-child').innerHTML;


    var newNode = document.createElement('div');
    newNode.classList.add('creating');
    newNode.classList.add('repeater__content');
    newNode.innerHTML = content;
    repeater.insertBefore(newNode,repeater.querySelector('.repeater_actions'));
    //
    var creatingElements = repeater.querySelectorAll('.creating input,.creating textarea,.creating select');
    for($i = 0; $i < creatingElements.length; $i++){
        creatingElements[$i].value='';
    }
    var creatingList = repeater.querySelectorAll('.creating');
    for($i = 0; $i < creatingList.length; $i++){
        creatingList[$i].classList.remove('creating');
    }
}
