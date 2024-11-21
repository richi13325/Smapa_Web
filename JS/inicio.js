let currentSection = 0;
const sections = document.querySelectorAll('.galeria_section');

function navigate(direction) {
    // Eliminar la clase 'active' de la sección actual
    sections[currentSection].classList.remove('active');
    
    // Calcular la nueva sección
    currentSection = (currentSection + direction + sections.length) % sections.length;

    // Agregar la clase 'active' a la nueva sección
    sections[currentSection].classList.add('active');
}

// Inicializa la galería mostrando la primera sección
sections[currentSection].classList.add('active');
