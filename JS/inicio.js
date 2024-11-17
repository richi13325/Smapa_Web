const galeriaSection = document.querySelector('.galeria_section');
let scrollAmount = 0;
const scrollStep = 200; // Ajusta el desplazamiento según sea necesario

function scrollGallery(direction) {
    scrollAmount += direction * scrollStep;
    galeriaSection.style.transform = `translateX(${scrollAmount}px)`;
}
