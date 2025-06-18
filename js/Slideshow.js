let currentSlide = 0; 
const slides = document.querySelectorAll('.Block .Slide');
const showSlide = (index) => {
    slides.forEach((slide, i)=> {
        slide.classList.toggle('active', i === index);
    });
}
showSlide(currentSlide);

setInterval(() =>{
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
}, 3000);