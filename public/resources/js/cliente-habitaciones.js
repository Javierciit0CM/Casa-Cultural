document.addEventListener("DOMContentLoaded", () => {
    const menuToggle = document.querySelector(".lhe-menu-toggle");
    const nav = document.querySelector(".lhe-nav");
    const languageButton = document.querySelector(".lhe-language-button");
    const languageDropdown = document.querySelector(".lhe-language-dropdown");
    const roomCards = document.querySelectorAll(".lh-room-card");
    const moreRoomsLink = document.querySelector(".lh-more-rooms-link");
    const modal = document.getElementById("lh-room-modal");
    const closeModal = document.querySelector(".lh-close-modal");
    const modalTitle = document.getElementById("lh-modal-title");
    const modalCarouselContainer = document.querySelector(".lh-modal-carousel-container");
    const modalDescription = document.getElementById("lh-modal-description");
    const modalFeatures = document.getElementById("lh-modal-features");
    const modalBook = document.getElementById("lh-modal-book");
    const prevButton = document.querySelector(".lh-modal-carousel-control.lh-prev");
    const nextButton = document.querySelector(".lh-modal-carousel-control.lh-next");

    document.addEventListener("click", (e) => {
        if (!nav.contains(e.target) && !menuToggle.contains(e.target)) {
            nav.classList.remove("active");
            menuToggle.setAttribute("aria-expanded", "false");
        }
    });
    // Animación de aparición para tarjetas de habitaciones
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("lh-fade-in");
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    roomCards.forEach((card) => observer.observe(card));
    observer.observe(moreRoomsLink);

    // Efecto hover en tarjetas
    roomCards.forEach((card) => {
        card.addEventListener("mouseenter", () => {
            card.style.transform = "translateY(-15px)";
            card.style.boxShadow = "0 20px 40px rgba(0, 0, 0, 0.2)";
        });
        card.addEventListener("mouseleave", () => {
            card.style.transform = "translateY(0)";
            card.style.boxShadow = "0 10px 30px rgba(0, 0, 0, 0.1)";
        });
    });

    // Efecto brillo en enlace "Más habitaciones"
    moreRoomsLink.addEventListener("mousemove", (e) => {
        const rect = moreRoomsLink.getBoundingClientRect();
        moreRoomsLink.style.setProperty("--mouse-x", `${e.clientX - rect.left}px`);
        moreRoomsLink.style.setProperty("--mouse-y", `${e.clientY - rect.top}px`);
    });

    // Funcionalidad del modal
    let currentSlide = 0;

    function showSlide(index) {
        const slides = modalCarouselContainer.querySelectorAll(".lh-modal-carousel-slide");
        slides.forEach((slide, i) => {
            slide.style.transform = `translateX(${100 * (i - index)}%)`;
        });
    }
    function nextSlide() {
        const slides = modalCarouselContainer.querySelectorAll(".lh-modal-carousel-slide");
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }
    function prevSlide() {
        const slides = modalCarouselContainer.querySelectorAll(".lh-modal-carousel-slide");
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }

    roomCards.forEach((card) => {
        card.addEventListener("click", () => {
            const roomType = card.getAttribute("data-room-type");
            const details = roomDetails[roomType];

            modalTitle.textContent = details.title;
            modalDescription.textContent = details.description;
            modalFeatures.innerHTML = details.features.map(f => `<li>${f}</li>`).join("");
            modalCarouselContainer.innerHTML = details.images.map((src, i) => `
                <div class="lh-modal-carousel-slide">
                    <img src="${src}" alt="${details.title} - Imagen ${i + 1}">
                </div>
            `).join("");

            currentSlide = 0;
            showSlide(currentSlide);
            modal.style.display = "block";
        });
    });

    closeModal.addEventListener("click", () => modal.style.display = "none");
    window.addEventListener("click", (e) => {
        if (e.target === modal) modal.style.display = "none";
    });

    modalBook.addEventListener("click", () => {
        alert("Funcionalidad de reserva en desarrollo. ¡Gracias por su interés!");
        modal.style.display = "none";
    });

    prevButton.addEventListener("click", prevSlide);
    nextButton.addEventListener("click", nextSlide);
});
