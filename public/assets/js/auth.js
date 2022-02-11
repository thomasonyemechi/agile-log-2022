button = $('#submitLogin');
aalert = $('#loginAlert');

function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

const performAuth = (email, phone, id, fname, lname, img) => {
    $.ajax({
        method: 'POST',
        url: 'api.php',
        data: {
            loginUser: '',
            email: email,
            firstname: fname,
            lastname: lname,
            phone: phone,
            id: id,
            img: img,
        }
    }).done(function(res) {
        return res;
    });

}


button.on('click', function() {
    event.preventDefault();
    email = $('#loginEmail').val();
    password = $('#loginPassword').val();
    if (email == '' || password == '') {
        aalert.fadeIn(500);
        aalert.html('All Fields are required!');
        aalert.attr('class', 'alert alert-danger');
        setTimeout(function() {
            aalert.fadeOut(2000);
        }, 2000)
    } else {
        aalert.fadeIn(500);
        $.ajax({
            method: 'POST',
            url: `http://localhost/livepetal/testapi/api/onlinecourse/api`,
            data: {
                LoginUserApi: 'LoginUserApi',
                email: email,
                password: password,
            },
            beforeSend: () => {
                button.html(`<i>Processing...</i>`);
            }
        }).done(function(res) {
            res = JSON.parse(res);
            data = res.data
            if (res.success) {
                aalert.attr('class', 'alert alert-success');
                aalert.html(`Authenticating...`);
                performAuth(data.email, data.phone, data.sn, data.firstname, data.lastname, data.photo);
                aalert.html(`Login Sucessfull Redirecting...`);
                setTimeout(function() {
                    window.location.href = 'user/courses.php';
                }, 100);
            } else {
                button.html(`Sign In`);
                aalert.html(`${res.message}`);
                aalert.attr('class', 'alert alert-danger');
                setTimeout(function() {
                    aalert.fadeOut(2000);
                }, 2000);
            }
        }).fail(function() {
            alert('An error occured pls try again');
            window.location.reload();
        })
    }
})