jQuery(document).ready(function($) {
    
var slides = $('.testimonial-slide');
var currentIndex = 0;

function showSlide(index) {
    slides.removeClass('active');
    slides.eq(index).addClass('active');
}

$('.testimonial-slider .next').click(function() {
    currentIndex = (currentIndex + 1) % slides.length;
    showSlide(currentIndex);
});

$('.testimonial-slider .prev').click(function() {
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    showSlide(currentIndex);
});

showSlide(currentIndex); 
});


