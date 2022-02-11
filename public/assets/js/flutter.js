function payWithFlutter() {

    let user = JSON.parse($('.userInfo').val());
    let courseId = 1;
    let ref2 = Math.floor((Math.random() * 1000000000) + 1);

    amount = parseInt($('.amount').val());
    FlutterwaveCheckout({
        public_key: "FLWPUBK_TEST-46a04fa4c25ade2e1e09f8ae0011adc3-X",
        tx_ref: "" + ref2,
        amount: amount,
        currency: "NGN",
        payment_options: " ",
        customer: {
            email: user.email.trim(),
            phone_number: user.phone,
            name: `${user.lastname} ${user.firstname}`,
        },
        callback: function(data) {
            $.ajax({
                url: `api.php`,
                method: 'POST',
                data: {
                    verifyTransaction: 'much vallllade',
                    transaction_id: data.transaction_id,
                    user_id: user.sn,
                    course_id: courseId,
                    reference: ref2,
                    amount: amount,
                }
            }).done((res) => {
                res = JSON.parse(res)
                if (res.data.status === 'successful') {
                    sendVerification(ref2, user.sn, courseId)
                }
            }).fail((err) => {})
        },
        customizations: {
            title: "Lentoria",
            description: "Training/Course Payment",
            logo: "https://lentoria.com/assets/images/brand/logo/logo111.png",
        },
    });
}



function sendVerification(ref, userId, courseId) {
    $.ajax({
        url: `api.php`,
        method: 'POST',
        data: {
            sendPaymentVerification: 'much vallllade',
            user_id: userId,
            course_id: courseId,
            reference: ref,
        }
    }).done((res) => {
        res = JSON.parse(res);
        console.log(res);
        alert(res.message)
        window.location.reload()
    })
}