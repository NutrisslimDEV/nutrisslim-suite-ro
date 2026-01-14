$=jQuery.noConflict();
$(function() {
    $('.greenline .label').click(function(){
        var parentDiv = $(this).parent('.greenline');
        if (parentDiv.hasClass('active')) {
            parentDiv.removeClass('active');
            parentDiv.find('p:not(.label)').slideUp();
        } else {
            $('.greenline.active').removeClass('active').find('p:not(.label)').slideUp();
            parentDiv.addClass('active');
            parentDiv.find('p:not(.label)').slideDown();
        }
    });    
    $('input[type="radio"][name="quantity"]').change(function() {
        var selectedQuantity = $(this).val(); // Get the value of the checked radio
        $('.add-to-cart-icon').attr('data-quantity', selectedQuantity); // Set the data-quantity attribute of the button
    });
    $('.txtimgBlock .elementor-widget-container').each(function() {
        var count = 0;
        $(this).find('.media-content-subsection').each(function() {
            if (!$(this).hasClass('media-content-subsection-single')) {
                count++;
                if (count % 2 !== 0) {
                    $(this).addClass('reverseit');
                }
            }
        });
    });

    if (window.matchMedia("(max-width: 767px)").matches) {

        const swiper = new Swiper('.faqGrid', {
            // Your Swiper options here
            slidesPerView: 1.2,
            spaceBetween: 10,
        });
    }

    const getOfferLinks = document.querySelectorAll('a.moreabout');
    const closeButton = document.querySelector('.closeMod');
    // Add click event to all getOffer links
    getOfferLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link action
            document.body.classList.add('modal-open'); // Add the class to the body
        });
    });

    // Add click event to the close button
    if (closeButton) {
        closeButton.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link action
            document.body.classList.remove('modal-open'); // Remove the class from the body
        });
    }    
    /*
    var faqGrid = new Swiper(".faqGrid", {
        slidesPerView: 3,
        grid: {
          rows: 2,
        },
        spaceBetween: 30
    });
    */
});


// $('.uwcc-open-cart-546612').click();