document.addEventListener('DOMContentLoaded', function () {

    /* =========================
       NAVBAR SCROLL
    ========================= */

    const navbar = document.querySelector('.public-navbar');

    if (navbar) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });
    }
});


/* =========================
   SLIDER
========================= */

document.addEventListener('DOMContentLoaded', function () {
    const track = document.querySelector('.slider-track');
    const slides = document.querySelectorAll('.slider-item');
    const dots = document.querySelectorAll('.slider-dot');
    const nextButton = document.querySelector('.slider-next');
    const prevButton = document.querySelector('.slider-prev');
    if (!track || slides.length === 0) {
        return;
    }

    let currentSlide = 0;

    function showSlide(index) {
        currentSlide = index;

        // Menggeser slider
        track.style.transform =
            `translateX(-${currentSlide * 100}%)`;

        // Update dots
        dots.forEach(function (dot) {
            dot.classList.remove('active');
        });

        if (dots[currentSlide]) {
            dots[currentSlide].classList.add('active');
        }
    }


    function nextSlide() {
        currentSlide++;
        if (currentSlide >= slides.length) {
            currentSlide = 0;
        }

        showSlide(currentSlide);
    }


    function prevSlide() {
        currentSlide--;
        if (currentSlide < 0) {
            currentSlide = slides.length - 1;
        }

        showSlide(currentSlide);
    }

    // Tombol kanan
    if (nextButton) {
        nextButton.addEventListener('click', nextSlide);
    }


    // Tombol kiri
    if (prevButton) {
        prevButton.addEventListener('click', prevSlide);
    }


    // Klik dots
    dots.forEach(function (dot) {
        dot.addEventListener('click', function () {
            const index = Number(dot.dataset.slide);
            showSlide(index);
        });
    });


    // Auto slide setiap 6 detik
    setInterval(function () {
        nextSlide();
    }, 6000);
});
