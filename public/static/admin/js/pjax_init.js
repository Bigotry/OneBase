$.pjax.defaults.timeout = 10000;
$.pjax.defaults.maxCacheLength = 0;

if(pjax_mode == 1)
{
    $(document).pjax('a', '.content');

    $(document).on('submit', 'form', function(event) {

        $.pjax.submit(event, '.content');
    });
}

var backups_content = '';

$(document).on('pjax:send', function() {

    backups_content = $('.content').clone(true);

    $('.fakeloader').show();
});

$(document).on('pjax:complete', function() {

    $('.fakeloader').hide();
});
    