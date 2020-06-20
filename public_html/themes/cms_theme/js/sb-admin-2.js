(function ($) {
    "use strict"; // Start of use strict

    // Toggle the side navigation
    $("#sidebarToggle, #sidebarToggleTop").on('click', function (e) {
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
        if ($(".sidebar").hasClass("toggled")) {
            $('.sidebar .collapse').collapse('hide');
        }
        ;
    });

    // Close any open menu accordions when window is resized below 768px
    $(window).resize(function () {
        if ($(window).width() < 768) {
            $('.sidebar .collapse').collapse('hide');
        }
        ;
    });

    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function (e) {
        if ($(window).width() > 768) {
            var e0 = e.originalEvent,
                delta = e0.wheelDelta || -e0.detail;
            this.scrollTop += (delta < 0 ? 1 : -1) * 30;
            e.preventDefault();
        }
    });

    // Scroll to top button appear
    $(document).on('scroll', function () {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
            $('.scroll-to-top').fadeIn();
        } else {
            $('.scroll-to-top').fadeOut();
        }
    });

    // Smooth scrolling using jQuery easing
    $(document).on('click', 'a.scroll-to-top', function (e) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top)
        }, 1000, 'easeInOutExpo');
        e.preventDefault();
    });

    var $passwordFeedback = $('#password-feedback');
    var $newPassword = $('#newPassword');
    var $confirmationPassword = $('#confirmationPassword');

    $newPassword.on('keyup', function () {
        if ($newPassword.val() === '' || $confirmationPassword.val() === '') {
            $passwordFeedback.html('Wachtwoorden zijn niet hetzelfde').css('color', 'red');
        } else if ($newPassword.val() !== $confirmationPassword.val()) {
            $passwordFeedback.html('Wachtwoorden zijn niet hetzelfde').css('color', 'red');
        } else {
            $passwordFeedback.html('Wachtwoorden zijn hetzelfde').css('color', 'green');
        }
    });

    $confirmationPassword.on('keyup', function () {
        if ($newPassword.val() === '' || $confirmationPassword.val() === '') {
            $passwordFeedback.html('Wachtwoorden zijn niet hetzelfde').css('color', 'red');
        } else if ($newPassword.val() !== $confirmationPassword.val()) {
            $passwordFeedback.html('Wachtwoorden zijn niet hetzelfde').css('color', 'red');
        } else {
            $passwordFeedback.html('Wachtwoorden zijn hetzelfde').css('color', 'green');
        }
    });

    $("#searchLog").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".list-group a").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $(document).ready(function () {
        //  Activate the tooltips
        $('[rel="tooltip"]').tooltip();

        $('#newPassword').password({
            enterPass: '',
            shortPass: 'Wachtwoord is te kort',
            containsField: 'Dit wachtwoord bevat je gebruikersnaam',
            steps: {
                // Easily change the steps' expected score here
                13: 'Echt onveilig wachtwoord',
                33: 'Zwak; probeer letters en cijfers te combineren',
                67: 'Medium; probeer speciale tekens te gebruiken',
                94: 'Sterk wachtwoord',
            },
            showPercent: true,
            showText: true, // shows the text tips
            animate: true, // whether or not to animate the progress bar on input blur/focus
            animateSpeed: 'fast', // the above animation speed
            field: false, // select the match field (selector or jQuery instance) for better password checks
            fieldPartialMatch: true, // whether to check for partials in field
            minimumLength: 4, // minimum password length (below this threshold, the score is 0)
            useColorBarImage: true, // use the (old) colorbar image
            customColorBarRGB: {
                red: [0, 240],
                green: [0, 240],
                blue: 10,
            } // set custom rgb color ranges for colorbar.
        });

        var datepickerElement = document.getElementById('datepicker');
        if (datepickerElement !== null) {
            datepicker('#datepicker', {
                // Customizations.
                formatter: function (input, date, instance) {
                    // This will display the date as `1/1/2019`.
                    var localDate = date.toLocaleDateString()
                    localDate = localDate.replace('/', '-')
                    localDate = localDate.replace('/', '-')

                    input.value = localDate
                },
                position: 'bl', // Possible values: 'tr', 'tl', 'br', 'bl', 'c'
                startDay: 0, // Calendar week starts on a Sunday.
                customDays: ['Zo', 'Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za'],
                customMonths: [
                    'Januari', 'Febrauri', 'Maart', 'April', 'Mei', 'Juni', 'Juli',
                    'Augustus', 'September', 'Oktober', 'November', 'December'
                ],
                overlayButton: 'Selecteren',
                overlayPlaceholder: 'Voer een jaartal in',

                // Settings.
                alwaysShow: false, // Never hide the calendar.
                minDate: new Date(), // Current date.
                startDate: new Date(), // This month.
                showAllDates: true, // Numbers for leading & trailing days outside the current month will show.

                // Disabling things.
                noWeekends: false, // Saturday's and Sunday's will be unselectable.
                respectDisabledReadOnly: true,

                // ID - be sure to provide a 2nd picker with the same id to create a daterange pair.
                id: 1
            })
        } // End datepicker

        var unlimitedDatepickerElement = document.getElementById('unlimited-datepicker');
        if (unlimitedDatepickerElement !== null) {
            datepicker('#unlimited-datepicker', {
                // Customizations.
                formatter: function (input, date, instance) {
                    // This will display the date as `1/1/2019`.
                    var localDate = date.toLocaleDateString()
                    localDate = localDate.replace('/', '-')
                    localDate = localDate.replace('/', '-')

                    input.value = localDate
                },
                position: 'bl', // Possible values: 'tr', 'tl', 'br', 'bl', 'c'
                startDay: 0, // Calendar week starts on a Sunday.
                customDays: ['Zo', 'Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za'],
                customMonths: [
                    'Januari', 'Febrauri', 'Maart', 'April', 'Mei', 'Juni', 'Juli',
                    'Augustus', 'September', 'Oktober', 'November', 'December'
                ],
                overlayButton: 'Selecteren',
                overlayPlaceholder: 'Voer een jaartal in',

                // Settings.
                alwaysShow: false, // Never hide the calendar.
                dateSelected: new Date(), // Today is selected.
                minDate: new Date(2019, 1, 1),
                startDate: new Date(), // This month.
                showAllDates: true, // Numbers for leading & trailing days outside the current month will show.

                // Disabling things.
                noWeekends: false, // Saturday's and Sunday's will be unselectable.
                respectDisabledReadOnly: true,

                // ID - be sure to provide a 2nd picker with the same id to create a daterange pair.
                id: 1
            })
        } // End datepicker

        var clockpickerElement = document.getElementById('timepicker');
        if (clockpickerElement !== null) {
            $('#timepicker').clockpicker({
                placement: 'bottom',
                align: 'left',
                autoclose: true,
                'default': 'now'
            });
        } // End clockpikcer
    });

})(jQuery); // End of use strict

function makeRandomString(length) {
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}
