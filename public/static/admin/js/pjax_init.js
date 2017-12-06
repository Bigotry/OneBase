$.pjax.defaults.timeout = 10000;
$.pjax.defaults.maxCacheLength = 0;

if(pjax_mode == 1)
{
    $(document).pjax('a', '.content');

    $(document).on('submit', 'form', function(event) {

        $.pjax.submit(event, '.content');
    });
}

$(document).on('pjax:send', function() {

    $('.fakeloader').show();
});

$(document).on('pjax:complete', function() {

    $('.fakeloader').hide();
});
    