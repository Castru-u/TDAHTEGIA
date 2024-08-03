document.addEventListener("DOMContentLoaded", function() {
    const carousel = document.getElementById('carousel');
    const images = carousel.querySelectorAll('img');
    let index = 0;

    function showNextImage() {
        index = (index + 1) % images.length;
        const offset = -index * 100;
        carousel.style.transform = `translateX(${offset}%)`;
    }

    setInterval(showNextImage, 2000); // Altere o intervalo conforme necessário
});

document.addEventListener("DOMContentLoaded", function() {
    let currentIndex = 0;
    const testimonials = document.querySelectorAll(".depoimentos_comentarios");

    function showNextTestimonials() {
        // Oculta todos os depoimentos
        testimonials.forEach((testimonial) => {
            testimonial.classList.remove("active");
        });

        // Mostra os próximos três depoimentos
        for (let i = 0; i < 3; i++) {
            const index = (currentIndex + i) % testimonials.length;
            testimonials[index].classList.add("active");
        }

        // Atualiza o índice atual
        currentIndex = (currentIndex + 3) % testimonials.length;
    }

    // Mostra inicialmente os primeiros três depoimentos
    showNextTestimonials();

    // Alterna os depoimentos a cada 2 segundos
    setInterval(showNextTestimonials, 2000);
});