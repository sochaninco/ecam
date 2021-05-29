$(document).ready(function() {
    $('body a, body button').attr('tabindex', -1);

    $(document).on('click', function(e) {
        if (
            !$(e.target).is('.open-brands, .cat-child') &&
            !$(e.target)
                .parents('#brands-slider')
                .size() &&
            $('#brands-slider').is(':visible')
        ) {
            $('#brands-slider').toggle('slide', { direction: 'right' }, 700);
        }
        if (
            !$(e.target).is('.open-category, .cat-child') &&
            !$(e.target)
                .parents('#category-slider')
                .size() &&
            $('#category-slider').is(':visible')
        ) {
            $('#category-slider').toggle('slide', { direction: 'right' }, 700);
        }
        if (
            !$(e.target).is('.open-subcategory, .cat-child') &&
            !$(e.target)
                .parents('#subcategory-slider')
                .size() &&
            $('#subcategory-slider').is(':visible')
        ) {
            $('#subcategory-slider').toggle('slide', { direction: 'right' }, 700);
        }
    });

});

