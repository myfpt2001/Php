const CarouseSlider = document.querySelector('.carousel-slider');
const CarouseImages = document.querySelectorAll('.carousel-slider image');
// Buttons
const prevBtn = document.querySelector('#prevBtn');
const nextBtn = document.querySelector('#nextBtn');
//Counter
let counter = 1;
const size = CarouseImages[0].clientWidth;
CarouseSlider.style.transfrom = 'translateX(' + (-size * counter) + 'px)';

nextBtn.addEventListener('click', () => {
    CarouseSlider.style.marginLeft = "-" + 333 + "px";
    counter++;
    CarouseSlider.style.transfrom = 'translateX(' + (-size * counter) + 'px)';

});