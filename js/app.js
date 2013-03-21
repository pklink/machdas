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
    $('.task :checkbox').on('change', function() {
        if ($('.task').has(this).find('del').length) {
            $('.task').has(this).find('label').unwrap();
        }
        else {
            $('.task').has(this).find('label').wrap('<del />');
        }
    });

    // save
    $('#add').submit(function() {
        $.post($(this).attr('action'), $(this).serialize(), null, 'json')
            .done(function(response) {
                var task = $('.list .task:first').clone();
                task.find('label span:last').text(response.name);
                task.hide();
                task.prependTo($('.list:first'));
                task.slideDown(100);

                $('#add input:text').val('').focus();
            });

        return false;
    });

});