let addImages = document.querySelector('#add-image');
let imagesContainer = document.querySelector('#ad_images')
addImages.addEventListener('click', () => {
    const index = imagesContainer.getElementsByClassName('form-group').length;
    imagesContainer.innerHTML += (imagesContainer.dataset.prototype).replace(/__name__/g, index);

