let currentSlide = 0; 
const slides = document.querySelectorAll('.Block .Slide');
const showSlide = (index) => { //arrow keys// 
    slides.forEach((slide, i)=> { //array voor elke slide 
        slide.classList.toggle('active', i === index);  //gaat hij bewegen tussen slides//
    });
}
showSlide(currentSlide);

setInterval(() =>{
    currentSlide = (currentSlide + 1) % slides.length; //terug naar begin slide 
    showSlide(currentSlide);
}, 3000);