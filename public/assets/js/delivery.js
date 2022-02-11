$(function() {
    $('body').on('click', '.ooooo', function() {
        val = $(this).data('id');
        inp = $(`#${val}`)
        new_val = (inp.val() == 0) ? 1 : 0;
        inp.val(new_val);

    })


    $('body').on('click', '.update', function() {
        trs = $('.single');
        data = [];
        i = 0;
        trs.map(tr => {
            check = trs[tr].children[0].children[1].value;
            if (check == 1) {
                f_id = trs[tr].children[0].children[0].value;
                data.push(parseInt(f_id))
                i++;
            }
        });
        if (i == 0) { alert('Pls select freight to update'); return; }
        modal = $('#manageDeliveryModal');
        modal.modal('show');

        $(modal).find('.modal-title').html(`Update ${i} Freights`);
        $(modal).find('input[name="data"]').val(`${JSON.stringify(data)}`);
    })



})