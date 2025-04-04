document.addEventListener("DOMContentLoaded", function () {
    let slides = document.querySelectorAll(".slide");
    let currentIndex = 0;

    function showNextSlide() {
        slides[currentIndex].classList.remove("active");
        currentIndex = (currentIndex + 1) % slides.length;
        slides[currentIndex].classList.add("active");
    }

    setInterval(showNextSlide, 2000);
});



document.querySelectorAll(".image-slider").forEach((slider) => {
    let images = slider.querySelectorAll("img");
    let index = 0;

    slider.querySelector(".next").addEventListener("click", () => {
        images[index].classList.remove("active");
        index = (index + 1) % images.length;
        images[index].classList.add("active");
    });

    slider.querySelector(".prev").addEventListener("click", () => {
        images[index].classList.remove("active");
        index = (index - 1 + images.length) % images.length;
        images[index].classList.add("active");
    });
});


