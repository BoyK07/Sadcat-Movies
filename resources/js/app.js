import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener("DOMContentLoaded", function() {
    const images = document.querySelectorAll('img');
    
    images.forEach(img => {
        // Create a wrapper for the image
        const wrapper = document.createElement('div');
        wrapper.className = 'aspect-3-2';

        // Replace the image with the wrapper in the DOM
        img.parentNode.insertBefore(wrapper, img);
        wrapper.appendChild(img);
        
        img.addEventListener('error', function() {
            this.src = '/storage/images/defaultimage.png';
        });
    });
});



document.addEventListener('DOMContentLoaded', function() {
    setupOwlCarousel();
    setupEpisodesCarousel();
    setupSectionToggles();
    setupSeasonsToggle();
});

function setupOwlCarousel() {
    $(".owl-carousel").owlCarousel({
        items: 3,
        loop: true,
        margin: 10,
        navSpeed: 250,
        nav: true,
        navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
        navClass: ['custom-prev', 'custom-next'],
        responsive: {
            1440: { items: 9 },
            1024: { items: 6 },
            768:  { items: 4 },
            576:  { items: 3 },
            0:    { items: 3 }
        }
    });
}

function setupEpisodesCarousel() {
    const episodesCarousel = $(".episodes-carousel").owlCarousel({
        items: 3,
        loop: true,
        margin: 10,
        nav: true
    });

    episodesCarousel.trigger('replace.owl.carousel', $('.episodes:first').html());

    $(".season-name").click(function() {
        const seasonIndex = $(this).index() + 1;
        const seasonEpisodes = $(`.episodes.season-${seasonIndex}`).html();

        episodesCarousel
            .trigger('replace.owl.carousel', seasonEpisodes)
            .trigger('refresh.owl.carousel');
    });
}

function setupSectionToggles() {
    $('#episode-header').on('click', function() {
        toggleSectionContent('#episode-content', '#episode-header', '#suggestion-content', '#suggestion-header');
    });

    $('#suggestion-header').on('click', function() {
        toggleSectionContent('#suggestion-content', '#suggestion-header', '#episode-content', '#episode-header');
    });
}

function toggleSectionContent(showContent, activeHeader, hideContent, inactiveHeader) {
    $(showContent).show();
    $(hideContent).hide();
    $(activeHeader).addClass('active-section');
    $(inactiveHeader).removeClass('active-section');
}

function setupSeasonsToggle() {
    // Initialize the first season as active and its episodes as visible
    $(".season-name:first").addClass("active-section");
    $(".episodes:first").removeClass("hidden");
    $(".episodes:not(:first)").addClass("hidden");

    $(".season-name").click(function() {
        let seasonNumber = $(this).data("season"); // Retrieve the data-season attribute

        $(".season-name").removeClass("active-section");
        $(".episodes").addClass("hidden");

        // Add 'active-section' class to the clicked season
        $(this).addClass("active-section");

        // Show the episodes container for the selected season using the data-season attribute
        $('.episodes[data-episodes-for="' + seasonNumber + '"]').removeClass("hidden");
    });
}
