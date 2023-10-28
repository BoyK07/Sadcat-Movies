import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

$(document).ready(function(){
    $(".owl-carousel").owlCarousel({
        items: 3,
        loop: true,
        margin: 10,
        navSpeed: 250,
        nav: true,
        navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
        navClass: ['custom-prev', 'custom-next'],
        responsive: {
            600: {
                items: 5
            }
        }
    });
});

