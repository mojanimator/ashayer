'use strict';

var a = 0;
$(window).scroll(function () {

    var oTop = $('#counter').offset().top - window.innerHeight;
    if (a === 0 && $(window).scrollTop() > oTop) {
        $('.counter-value').each(function () {
            var $this = $(this),
                countTo = $this.attr('data-count');
            $({
                countNum: $this.text()
            }).animate({
                countNum: countTo
            }, {

                duration: 2000,
                easing: 'swing',
                step: function step() {
                    $this.text(Math.floor(this.countNum));
                },
                complete: function complete() {
                    $this.text(this.countNum);
                    //alert('finished');
                }

            });
        });
        a = 1;
    }
});
//# sourceMappingURL=home.js.map