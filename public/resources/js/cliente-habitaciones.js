document.addEventListener('DOMContentLoaded', () => {
    const roomCards = document.querySelectorAll('.rc-room-card');

    // Efecto de aparición al cargar la página
    roomCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 200);
    });

    // Efecto hover suave para los botones
    const bookButtons = document.querySelectorAll('.rc-book-btn');
    bookButtons.forEach(btn => {
        btn.addEventListener('mouseover', () => {
            btn.style.transform = 'translateY(-3px)';
            btn.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.2)';
        });
        btn.addEventListener('mouseout', () => {
            btn.style.transform = 'translateY(0)';
            btn.style.boxShadow = 'none';
        });
    });

    // Animación de las características al hacer hover
    roomCards.forEach(card => {
        const features = card.querySelector('.rc-room-features');
        card.addEventListener('mouseenter', () => {
            features.style.transform = 'translateY(-5px)';
            features.style.opacity = '0.8';
        });
        card.addEventListener('mouseleave', () => {
            features.style.transform = 'translateY(0)';
            features.style.opacity = '1';
        });
    });

    // Efecto parallax suave en las imágenes
    roomCards.forEach(card => {
        const image = card.querySelector('.rc-room-image');
        card.addEventListener('mousemove', (e) => {
            const { left, top, width, height } = card.getBoundingClientRect();
            const x = (e.clientX - left) / width;
            const y = (e.clientY - top) / height;
            image.style.transform = `scale(1.1) translate(${x * 10}px, ${y * 10}px)`;
        });
        card.addEventListener('mouseleave', () => {
            image.style.transform = 'scale(1) translate(0, 0)';
        });
    });
});