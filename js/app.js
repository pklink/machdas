$(function() {

    $('.list .task').each(function(element) {
        $(this).find('.description').hide();

        var name = $(this).find('.item .name').text();

        var newName = $('<a></a>');
        newName.text(name);
        $(this).find('.item .name').empty();
        $(this).find('.item .name').append(newName);
    });

    $('.task .name a').on('click', function() {
        $('.task').has(this).find('.description').slideToggle(100);
    });

    $('form').submit(function() {
        $.post($(this).attr('action'), $(this).serialize(), null, 'json')
            .done(function(response) {
                var task = $('.list .task:first').clone();
                task.find('.id').text('#' + response.id);
                task.find('.name a').text(response.name);
                task.find('.description').text(response.description);
                task.hide();
                task.prependTo($('.list:first'));
                task.slideDown(100);
            });

        return false;
    });

});