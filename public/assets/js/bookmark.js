$('body').on('click', '.addToBookmark', function() {
    user_id = $(this).data('user_id');
    course_id = $(this).data('course_id');

    console.log(user_id);

    if (user_id == 0 || user_id == '') {
        $('#loginModal').modal('show')
    } else {
        $.ajax({
            method: 'POST',
            url: `api.php`,
            data: {
                bookMarkCourse: '',
                user_id: user_id,
                course_id: course_id,
            },
            beforeSend: () => {
                $('this').addClass('bg-primary');
            }
        }).done(function(res) {
            res = JSON.parse(res);
            if (res.success == true) {
                alert(`${res.message}`);
            } else { alert('an error occured'); }
        }).fail(function() {
            alert('an error occured try again');
            window.location.reload();
        })
    }
})