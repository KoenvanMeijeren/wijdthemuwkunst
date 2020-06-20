/*
	Introspect by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
*/

jQuery.event.special.touchstart = {
    setup: function (_, ns, handle) {
        if (ns.includes("noPreventDefault")) {
            this.addEventListener("touchstart", handle, {passive: false});
        } else {
            this.addEventListener("touchstart", handle, {passive: true});
        }
    }
};

function onSubmit(token) {
    document.getElementById("form").submit();
}

(function ($) {

    d_skel.breakpoints({
        xlarge: '(max-width: 1680px)',
        large: '(max-width: 1280px)',
        medium: '(max-width: 980px)',
        small: '(max-width: 736px)',
        xsmall: '(max-width: 480px)'
    });

    $(function () {

        var $window = $(window),
            $body = $('body');

        // Disable animations/transitions until the page has loaded.
        $body.addClass('is-loading');

        $window.on('load', function () {
            window.setTimeout(function () {
                $body.removeClass('is-loading');
            }, 100);
        });

        // Fix: Placeholder polyfill.
        $('form').placeholder();

        // Prioritize "important" elements on medium.
        d_skel.on('+medium -medium', function () {
            $.prioritize(
                '.important\\28 medium\\29',
                d_skel.breakpoint('medium').active
            );
        });

        // Off-Canvas Navigation.

        // Navigation Panel Toggle.
        // 	$('<a href="#navPanel" class="navPanelToggle"></a>')
        // 		.appendTo($body);

        // Navigation Panel.
        $(
            '<div id="navPanel">' +
            $('#nav').html() +
            '<a href="#navPanel" class="close"><i class="fas fa-times"></i></a>' +
            '</div>'
        )
            .appendTo($body)
            .panel({
                delay: 500,
                hideOnClick: true,
                hideOnSwipe: true,
                resetScroll: true,
                resetForms: true,
                side: 'left'
            });

        // Fix: Remove transitions on WP<10 (poor/buggy performance).
        if (d_skel.vars.os === 'wp' && d_skel.vars.osVersion < 10)
            $('#navPanel')
                .css('transition', 'none');

    });

})(jQuery);
