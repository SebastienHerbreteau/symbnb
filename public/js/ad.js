let addImages = document.querySelector('#add-image');
let imagesContainer = document.querySelector('#ad_images')
let inputHidden = document.querySelector('#widgets-counter')

addImages.addEventListener('click', () => {
    const index = inputHidden.value;
    console.log(index)
    imagesContainer.innerHTML += (imagesContainer.dataset.prototype).replace(/__name__/g, index);
    ++inputHidden.value
    deleteButtons();
})


function deleteButtons() {
    let buttons = document.querySelectorAll('[data-action="delete"]');
    buttons.forEach((button) => {
        button.addEventListener("click", () => {
            const target = button.dataset.target;
            const cible = document.querySelector(`#${target}`);
            cible.remove();
        })
    })
}

function updateCounter() {
    const count = +$('#ad_images div.form-group').length;
    $('#widgets-counter').val(count);
}

updateCounter();
deleteButtons();