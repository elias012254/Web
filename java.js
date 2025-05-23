 document.addEventListener('DOMContentLoaded', () => {
            const prevBtn = document.querySelector('.carousel-btn.prev');
            const nextBtn = document.querySelector('.carousel-btn.next');
            const indicators = document.querySelectorAll('.indicator');
            const carouselImages = document.querySelector('.carousel-images');
            const totalItems = document.querySelectorAll('.carousel-item').length;
            let currentIndex = 0;

            function updateCarousel(index) {
                const offset = -index * 100; // Cambia la transformación para mostrar la imagen correcta
                carouselImages.style.transform = `translateX(${offset}%)`;
                indicators.forEach(indicator => indicator.classList.remove('active'));
                indicators[index].classList.add('active');
                currentIndex = index;
            }

            function showNext() {
                const nextIndex = (currentIndex + 1) % totalItems;
                updateCarousel(nextIndex);
            }

            function showPrev() {
                const prevIndex = (currentIndex - 1 + totalItems) % totalItems;
                updateCarousel(prevIndex);
            }

            nextBtn.addEventListener('click', showNext);
            prevBtn.addEventListener('click', showPrev);

            indicators.forEach(indicator => {
                indicator.addEventListener('click', () => {
                    const index = parseInt(indicator.getAttribute('data-index'));
                    updateCarousel(index);
                });
            });

            // Inicializa el carrusel automáticamente
            function startAutoSlide() {
                setInterval(() => {
                    showNext();
                }, 9000); // Cambia la imagen cada 0.5 segundos
            }

            startAutoSlide();
            updateCarousel(0); // Inicializa el carrusel
        });

  document.addEventListener('DOMContentLoaded', () => {
            const prevBtn = document.querySelector('.image-gallery .prev');
            const nextBtn = document.querySelector('.image-gallery .next');
            const galleryImages = document.querySelector('.image-gallery .gallery-images');
            const totalItems = document.querySelectorAll('.image-gallery .gallery-item').length;
            const visibleItems = 4; // Número de imágenes visibles a la vez
            let currentIndex = 0;

            function updateGallery(index) {
                const offset = -index * (100 / visibleItems);
                galleryImages.style.transform = `translateX(${offset}%)`;
                currentIndex = index;
            }

            function showNext() {
                const nextIndex = (currentIndex + 1) % (totalItems - visibleItems + 1);
                updateGallery(nextIndex);
            }

            function showPrev() {
                const prevIndex = (currentIndex - 1 + (totalItems - visibleItems + 1)) % (totalItems - visibleItems + 1);
                updateGallery(prevIndex);
            }

            nextBtn.addEventListener('click', showNext);
            prevBtn.addEventListener('click', showPrev);

            updateGallery(0); // Inicializa el carrusel
        });