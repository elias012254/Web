document.addEventListener('DOMContentLoaded', function() {
    const galleryImages = [
        { src: 'Imagenes/image1.1.jpg', link: 'image1.html' },
        { src: 'Imagenes/image2.jpg', link: 'image2.html' },
        { src: 'Imagenes/image3.jpg', link: 'image3.html' },
        { src: 'Imagenes/image4.jpg', link: 'image4.html' },
        { src: 'Imagenes/image5.jpg', link: 'image5.html' },
        { src: 'Imagenes/image6.jpg', link: 'image6.html' },
        { src: 'Imagenes/image7.jpg', link: 'image7.html' },
        { src: 'Imagenes/image8.jpg', link: 'image8.html' },
        { src: 'Imagenes/image9.jpg', link: 'image9.html' },
        { src: 'Imagenes/image10.jpg', link: 'image10.html' },
        { src: 'Imagenes/image11.jpg', link: 'image11.html' },
        { src: 'Imagenes/image12.jpg', link: 'image12.html' },
        { src: 'Imagenes/image13.jpg', link: 'image13.html' },
        { src: 'Imagenes/image14.jpg', link: 'image14.html' },
        { src: 'Imagenes/image15.jpg', link: 'image15.html' }
    ];

    const galleryContainer = document.querySelector('.gallery-images');

    // Limpia el contenido existente
    galleryContainer.innerHTML = '';

    // Agrega las imágenes a la galería
    galleryImages.forEach(item => {
        const galleryItem = document.createElement('div');
        galleryItem.classList.add('gallery-item');
        galleryItem.innerHTML = `
            <a href="${item.link}"><img src="${item.src}" alt="Imagen"></a>
            <div class="circle">
                <a href="${item.link}"><img src="Imagenes/circle1.jpg" alt="Circle"></a>
            </div>
        `;
        galleryContainer.appendChild(galleryItem);
    });

    // Configuración de navegación
    const nextButton = document.querySelector('.nav-btn.next');
    const prevButton = document.querySelector('.nav-btn.prev');
    let currentIndex = 0;
    const itemsPerPage = 8;

    function updateGallery() {
        const items = galleryContainer.children;
        for (let i = 0; i < items.length; i++) {
            items[i].style.display = (i >= currentIndex && i < currentIndex + itemsPerPage) ? 'block' : 'none';
        }
    }

    nextButton.addEventListener('click', function() {
        currentIndex = (currentIndex + itemsPerPage) % galleryImages.length;
        updateGallery();
    });

    prevButton.addEventListener('click', function() {
        currentIndex = (currentIndex - itemsPerPage + galleryImages.length) % galleryImages.length;
        updateGallery();
    });

    // Inicializa la galería
    updateGallery();
});
