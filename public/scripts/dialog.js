jQuery(function($) {
    /**
     * Notifier
     */
    (function() {
        $(window).on('notify-init', function(e, trigger) {
            var timeout = parseInt($(trigger).attr('data-timeout') || 3000);

            if(!timeout) {
                return;
            }

            setTimeout(function() {
                $(trigger).fadeOut('fast', function() {
                    $(trigger).remove();
                });

            }, timeout);
        });

        $.extend({
            notify: function(message, type, timeout) {
                if(type === 'danger') {
                    type = 'error';
                }

                var toast = toastr[type](message, type[0].toUpperCase() + type.substr(1), {
                    timeOut: timeout
                });

                return toast;
            }
        });
    })();

    /**
     * Initialize
     */
    (function() {
        var cdn = $('html').attr('data-cdn') || '';
        // configure require
        require.config({
            cdn: {
                root : cdn
            },
            components: {
                root : cdn + '/components'
            }
        });

        //need to load dependencies
        $.require(
            [
                'components/doon/doon.min.js',
                'components/toastr/build/toastr.min.css',
                'components/toastr/build/toastr.min.js'
            ],
            function() {
                //activate all scripts
                $(document.body).doon();
            }
        );
    })();
});
