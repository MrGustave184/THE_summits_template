    $('#pco').hover(function() {
        $('#membership, #registration, #programme, #scanning, #exhibition, #mobile, #digital').removeClass('no-active');
    }, function() {
        $('#membership, #registration, #programme, #scanning, #exhibition, #mobile, #digital').addClass('no-active');
    });


    $('#corporates').hover(function() {
        $('#programme, #scanning, #exhibition, #mobile, #digital').removeClass('no-active');
    }, function() {
        $('#programme, #scanning, #exhibition, #mobile, #digital').addClass('no-active');
    });


    $('#concerts').hover(function() {
        $('#exhibition, #mobile, #digital').removeClass('no-active');
    }, function() {
        $('#exhibition, #mobile, #digital').addClass('no-active');
    });

    $('ul.navbar-nav li:last-child').addClass('bg-white');
    $('ul.navbar-nav li:last-child a').removeClass('text-white').addClass('text-darkorange');