$(function() {

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

    // delete
    $(document).on('click', '.list a.delete', function() {
        var task = $('.task').has(this);
        var id   = task.find('[name=id]:first').val();

        $.post($('#delete-url').val(), {'id': id}, null, 'json')
            .done(function() {
                task.slideUp('fast');
            });

        return false;
    });

    // save
    $('#add').submit(function() {
        $.post($(this).attr('action'), $(this).serialize(), null, 'json')
            .done(function(response) {
                var task = $('.list .task').not('.marked').first().clone();
                task.find('label span:last').text(response.name);
                task.hide();
                task.prependTo($('.list:first'));
                task.slideDown('fast');

                $('#add input:text').val('').focus();
            });

        return false;
    });

});