$(function() {

    $('.list .task').each(function(element) {
        $(this).find('.description').hide();

        var name = $(this).find('.item .name').text();

        var newName = $('<a></a>');
        newName.text(name);
        $(this).find('.item .name').empty();
        $(this).find('.item .name').append(newName);
    });

    // mark/unmark
    $(document).on('change', '.task :checkbox', function() {
        var task = $('.task').has(this);

        if (task.find('del').length) {
            task.removeClass('marked');
            task.find('label').unwrap();
            task.find('.foundicon-checkmark').fadeOut('fast');
        }
        else {
            task.addClass('marked');
            task.find('label').wrap('<del />');
            task.find('.foundicon-checkmark').fadeIn('fast');
        }
    });

    // save
    $('#add').submit(function() {
        $.post($(this).attr('action'), $(this).serialize(), null, 'json')
            .done(function(response) {
                var task = $('.list .task').not('.marked').first().clone();
                task.find('label span:last').text(response.name);
                task.hide();
                task.prependTo($('.list:first'));
                task.slideDown(100);

                $('#add input:text').val('').focus();
            });

        return false;
    });

});