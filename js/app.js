$(function() {

    // ajax-loader
    $(document).ajaxStart(function() {
        $('#ajax-load').fadeIn();
    })
    $(document).ajaxComplete(function() {
        $('#ajax-load').fadeOut();
    });

    // mark/unmark
    $(document).on('change', '.task :checkbox', function() {
        var task = $('.task').has(this);
        var id   = task.find('[name=id]:first').val();

        $.post($('#mark-url').val(), {'id': id}, null, 'json')
            .done(function() {
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
    });

    // delete
    $(document).on('click', '.list a.delete', function() {
        var task = $('.task').has(this);
        var id   = task.find(':checkbox').val();

        $.post($('#delete-url').val(), {'id': id}, null, 'json')
            .done(function() {
                task.slideUp('fast', function() {
                    task.remove();
                });
            });

        return false;
    });

    // add
    $('#add').submit(function() {
        var form = $(this);
        var data = form.serialize();

        // disable inputs
        $(this).find('input').attr('disabled', 'disabled');

        $.post(form.attr('action'), data, null, 'json')
            .done(function(response) {
                var task = $('#task-stencil').clone();
                task.find('label').attr('for', 'task-' + response.id);
                task.find(':checkbox').attr('id', 'task-' + response.id);
                task.find(':checkbox').val(response.id);
                task.find('label span:last').text(response.name);
                task.prependTo($('.list:first'));
                task.slideDown('fast');

                form.find('input').removeAttr('disabled');
                $('#add input:text').val('').focus();
            });

        return false;
    });

});