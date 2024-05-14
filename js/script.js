// BARRA NAVBAR

const  scroller=document.querySelector('.navbar');

window.addEventListener('scroll', () => {
 if (window.scrollY > 90) {
 	scroller.classList.add('nav-scrolled');
 }else if (window.scrollY <= 90){
    scroller.classList.remove('nav-scrolled');
 }
});

// ANIMACION SUBRAYADO



// LOGIN//

document.addEventListener('DOMContentLoaded', () => {
    const containerLog = document.querySelector('.container-log');
    const btnPoup = document.querySelector('.btn-login');
    const iClose = document.querySelector('.icon-close');

    btnPoup.addEventListener('click', () => {
        containerLog.classList.add('active-popup');
    });

    iClose.addEventListener('click', () => {
        containerLog.classList.remove('active-popup');
    });


});




$(document).ready(function() {
    // Cuando se hace clic en el botón para mostrar el modal
    $('#btn-modal').click(function() {
        $('.background-log').fadeIn(); // Mostrar el fondo oscuro
        $('.container-log').addClass('active-popup'); // Mostrar el modal
    });

    // Cuando se hace clic en el botón para cerrar el modal
    $('.icon-close').click(function() {
        $('.background-log').fadeOut(); // Ocultar el fondo oscuro
        $('.container-log').removeClass('active-popup'); // Ocultar el modal
    });
});


// REVEAL SECTION
document.addEventListener("DOMContentLoaded", function() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            console.log(entry);
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
            } else {
                entry.target.classList.remove('show');
            }
        });
    });

    const mostrarElementos = document.querySelectorAll('.hidden');
    mostrarElementos.forEach((el) => observer.observe(el));
});
const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting && entry.intersectionRatio >= 0.5) {
            entry.target.classList.add('show');
        } else {
            entry.target.classList.remove('show');
        }
    });
}, { threshold: 0.5 });

    
// Espera a que el contenido HTML de la página se haya cargado completamente
document.addEventListener("DOMContentLoaded", function() {
    // Selecciona los elementos que deseas animar dentro de <div class="container-fluid">
    const elementsToAnimate = document.querySelectorAll('.container-fluid .animate');

    // Función para verificar si un elemento está visible en la ventana del navegador
    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    // Función para activar las animaciones cuando los elementos estén visibles
    function activateAnimations() {
        elementsToAnimate.forEach(function(el) {
            if (isElementInViewport(el)) {
                el.classList.add('show'); // Agrega la clase 'show' para activar la animación
            }
        });
    }

    // Crear un observer para vigilar los elementos animados dentro de <div class="container-fluid">
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
            } else {
                entry.target.classList.remove('show');
            }
        });
    });

    // Observa los elementos animados dentro de <div class="container-fluid">
    elementsToAnimate.forEach((el) => observer.observe(el));

    // Ejecuta la función activateAnimations cuando se desplaza la página
    window.addEventListener('scroll', activateAnimations);

    // Llama a activateAnimations una vez para activar las animaciones si los elementos ya están visibles al cargar la página
    activateAnimations();
});

// PARALLAX-EFECT
