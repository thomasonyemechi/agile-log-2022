<div class="modal fade" id="assignFreight" tabindex="-1" role="dialog" aria-labelledby="addFreight" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Freight To Driver</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fe fe-x-circle"></i>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('control.assign.freight') }}" class="row">@csrf
                    <div class="mb-2 col-md-6">
                        <label class="form-label">Loader <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="loader"
                            placeholder="Loader name" required>
                            <input type="hidden" name="data">
                    </div>
                    <div class="mb-2 col-md-6">
                        <label class="form-label">Driver <span class="text-danger">*</span></label>
                        <select name="driver_id" class="form-control" id="">
                            <option selected disabled>... Select Driver</option>
                            @foreach (\App\Models\User::where('role', 1)->get(['id', 'name']) as $use)
                                <option value="{{$use->id}}">{{$use->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-2 col-md-12">
                        <i class="text-danger"><b>Note:</b> Freight that has already been processed/assigned to other drivers will be skipped!</i>
                    </div>


                    <div class="col-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-outline-secondary me-2"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Assign</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="updateFreight" tabindex="-1" role="dialog" aria-labelledby="addFreight" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Freight</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fe fe-x-circle"></i>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('control.assign.freight.update') }}" class="row">@csrf
                    <div class="mb-2 col-12">
                        <label>Select Action</label>
                        <select name="action" id="update_freight_status" onchange="showUpdateFileSection()" class="form-control">
                            <option selected disabled>...Select option...</option>
                            <option value="4">Off for delivery</option>
                            <option value="5">Sucessfully delivered</option>
                            <option value="6">Refused/Flagged item</option>
                        </select>
                    </div>

                    <div class="mb-2 col-12 update_freight_file" style="display: none">
                        <label>Upload Receipt</label>
                        <input type="file" name="u_file" class="form-control">
                    </div>


                    <div class="mb-2 col-md-12">
                        <label class="form-label">Message</label>
                        <textarea class="form-control" name="message" rows="3" placeholder="Enter a message"></textarea>
                            <input type="hidden" name="data">
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-outline-secondary me-2"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



<div class="modal fade" id="approve_freight" tabindex="-1" role="dialog" aria-labelledby="addFreight" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered moda" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Approved Selected Freight</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fe fe-x-circle"></i>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/control/approve_freight" enctype="multipart/form-data">
                    @csrf
                    <div class="approve_body">

                    </div>

                    <button class="btn btn-primary float-right submit_approval">Approve Freights</button>
                </form>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="freight_details" tabindex="-1" role="dialog" aria-labelledby="addFreight" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Freight Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fe fe-x-circle"></i>
                </button>
            </div>
            <div class="modal-body">


            </div>

        </div>
    </div>
</div>



<script>
    $(function() {
        $('body').on('click', '.ooooo', function() {
            val = $(this).data('id');
            inp = $(`#${val}`)
            new_val = (inp.val() == 0 ) ? 1 : 0;
            inp.val(new_val);

        })








        $('body').on('click', '.assign', function() {
            trs = $('.single'); data = []; i = 0;
            trs.map(tr => {
                check = trs[tr].children[0].children[1].value;
                if(check == 1) {
                    f_id = trs[tr].children[0].children[0].value;
                    data.push(parseInt(f_id))
                    i++;
                }
            });
            if(i == 0) { alert('Pls select freight to assign'); return; }
            modal = $('#assignFreight');
            modal.modal('show');

            $(modal).find('.modal-title').html(`Assign ${i} Freight To Driver`);
            $(modal).find('input[name="data"]').val(`${JSON.stringify(data)}`);
        })


        $('body').on('click', '.update', function() {
            trs = $('.single'); data = []; i = 0;
            trs.map(tr => {
                check = trs[tr].children[0].children[1].value;
                if(check == 1) {
                    f_id = trs[tr].children[0].children[0].value;
                    data.push(parseInt(f_id))
                    i++;
                }
            });
            if(i == 0) { alert('Pls select freight to update'); return; }
            modal = $('#updateFreight');
            modal.modal('show');

            $(modal).find('.modal-title').html(`Update ${i} Freight Status`);
            $(modal).find('input[name="data"]').val(`${JSON.stringify(data)}`);
            console.log(data);
        })


        function formatTime(secs) {
            var t = new Date(Date.UTC(1970, 0, 1)); // Epoch
            t.setUTCSeconds(secs);
            var d = new Date(t)
                var minute = d.getUTCMinutes();
                var hour = d.getUTCHours();
            return `${hour}:${minute}`
        }


        function formatDate(secs) {
            var t = new Date(Date.UTC(1970, 0, 1)); // Epoch
            t.setUTCSeconds(secs);

            var d = new Date(t),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();
                var minute = d.getUTCMinutes();
                var hour = d.getUTCHours();
            const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
            ];


            return `${day} ${monthNames[month - 1]}, ${year}`;
        }


        $('.approve_freight').on('click', function () {
            trs = $('.single'); data = []; i = 0;
            trs.map(tr => {
                check = trs[tr].children[0].children[1].value;
                if(check == 1) {
                    f_id = trs[tr].children[0].children[0].value;
                    info = JSON.parse(trs[tr].children[0].children[0].getAttribute('daat'))
                    data.push(info)
                    i++;
                }
            });
            // if(i == 0) { alert('Pls select freight to Approve'); return; }
            console.log(data);

            modal = $('#approve_freight');
            modal.modal('show');
            body = $('.approve_body')
            body.html(''); i = 0
            data.map((fr, index) => {
                console.log(fr);
                i++;

                console.log(fr)
                body.append(`
                    <div class="approve_single">
                        <b>${fr.pro} (${fr.company})</b>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="file" name="file_${index}" accept="image/jpeg"  class="form-control approve_files">
                            </div>
                            <div class="col-md-6">
                                <input type="number" placeholder="Pallets In" name="pallet_${index}" class="form-control" value="${fr.pallet}">
                            </div>
                        </div>
                        <input type="hidden" name="id_${index}" class="approve_id" value="${fr.id}">
                        <input type="text" placeholder="Location" name="location_${index}" class="form-control mt-1" value="${fr.location}">
                        <textarea name="message_${index}" class="form-control mt-2 approve_message"  placeholder="Enter Freight Message"></textarea>
                    </div>
                    <hr>
                `)
            })

            body.append(`<input type="hidden" name="total" value="${i}">`)
        })


        // $('.submit_approval').on('click', function(e) {
        //     e.preventDefault();
        //     data = [];
        //     freights = $('.approve_single')
        //     freights.map(freight => {
        //         freight = freights[freight]
        //         files = freight.children[1].value
        //         id = freight.children[2].value
        //         message = freight.children[3].value
        //         info = { id: id, message:message, file: files  }
        //         data.push(info)
        //     });

        //     $.ajax({
        //         method: 'post',
        //         url: '/control/approve_freight',
        //         headers: {
        //             "X-CSRF-TOKEN": `{{csrf_token()}}`
        //         },
        //         data: data,
        //         processData: false,
        //         contentType: false,
        //     }).done(function(res){
        //         console.log(res);
        //     }).fail(function(res) {
        //         console.log(res);
        //     })


        // })

        $('body').on('click', '.view_more', function() {
            data = $(this).data('data');
            console.log(data);
            modal = $('#freight_details');
            modal.modal('show');

            body = modal.find('.modal-body');
            body.html(``);

            modal.find('.modal-title').html(`Freight Details (${data.pro}) ${freightStatus(data.status)}`);

            a = data.approved;
            a_info = JSON.parse(data.approved_info);
            o_info = JSON.parse(data.message);
            o_body = ''
            if(o_info)
            {
                o_info.forEach(me => {
                    console.log(me);
                    message = (me.message) ? me.message : '';
                    time = (me.time) ? me.time : 0;
                    image = (me.image) ? `<img src="/assets/img/freight/${me.image}" class="img-fluid">` : '';
                    o_body += `
                        <div class="m-0">
                            <span><b>${formatDate(time)}- ${formatTime(time)}</b></span><br>
                            ${message}<br>
                            ${image}
                        </div><hr>
                    `
                })
            }
            console.log(o_info);

            console.log(data.org);

            a_body = (a == 1) ? `
                <div class="d-flex justify-content-between">
                    <span>Approved_By: <b>User</b></span>|
                    <span>Pallets In: <b>${data.pallet_in}</b></span>|
                    <span>Date: <b>${formatDate(a_info.time)}</b></span>
                </div>
                <hr>

                <div class="d-flex justify-content-between">
                    <span>Message: <b>${a_info.message}</b></span>
                </div>

                <div class="d-flex justify-content-between">
                    <img src="{{ asset('assets/img/freight/${a_info.image}') }}" class="image-fluid" style="width: 100%" alt="">
                </div>
            ` : `<div class="alert alert-danger">Freight Has not been approved</div>`;


            driver_body = (data.driver_id > 0) ? `
                 <div class="d-flex justify-content-between">
                    <span>Name: <b>${data.driver.name}</b></span>|
                    <span>Email: <b>${data.driver.email}</b></span>|
                    <span>Phone: <b>${data.driver.phone}</b></span>
                </div>
            `: `<div class="alert alert-danger">Freight has not been assigned to a driver </div>`
            body.append(`
                <div class="card mb-2 ">
                    <div class="card-header p-1 bg-primary">
                        <h5 class="card-title mb-0 text-white">Freight Info</h5>
                    </div>
                    <div class="card-body p-1">
                        <div class="d-flex justify-content-between">
                            <span>Pro: <b>${data.pro}</b></span>|
                            <span>Pallet: <b>${data.pallet}</b></span>|
                            <span>Weight: <b>${data.weight} LBS</b></span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span>Split: <b>$ ${data.byd_split}</b></span>|
                            <span>Spec INS: <b>${data.spec_ins}</b></span>|
                            <span>Weight: <b>${data.weight} LBS</b></span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span>Cosignee: <b>${data.consignee}</b></span>|
                            <span>Destination: <b>${data.destination}</b></span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span>Manifest: <b>${data.manifest_number}</b></span>|
                            <span>City: <b>${data.city}</b></span>|
                            <span>Location: <b>${data.location}</b></span>
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-header p-1 bg-info">
                        <h5 class="card-title mb-0">Driver Info</h5>
                    </div>
                    <div class="card-body p-1">
                        ${driver_body}
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-header p-1 bg-info">
                        <h5 class="card-title mb-0">Company Info</h5>
                    </div>
                    <div class="card-body p-1">
                        <div class="d-flex justify-content-between">
                            <span>Name: <b>${data.org.name}</b></span>|
                            <span>Phone: <b>${data.org.phone}</b></span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span>Email: <b>${data.org.email}</b></span>|
                            <span>Address: <b>${data.org.address}</b></span>
                        </div>

                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-header p-1 bg-success">
                        <h5 class="card-title mb-0">Approval Info</h5>
                    </div>
                    <div class="card-body p-1">
                        ${a_body}
                    </div>
                </div>


                <div class="card mb-2">
                    <div class="card-header p-1 bg-secondary">
                        <h5 class="card-title mb-0">Other Mesages</h5>
                    </div>
                    <div class="card-body p-1">
                        ${o_body}
                    </div>
                </div>
            `)
        })


        function freightStatus(status)
        {
            color = '';
            if(status == 3){
            color = 'primary'; title = 'Out For Delivery';
            }else if(status == 4){
                color = 'secondary'; title = 'Out For Delivery';
            }else if(status == 2){
                color = 'secondary'; title = 'Approved';
            }else if(status == 1){
                color = 'secondary'; title = 'Pending';
            }else if(status == 5){
                color = 'success'; title = 'Delivered';
            }else if(status == 6){
                color = 'danger'; title = 'Refused';
            }else{
                color = 'warning'; title = 'Not Assigned';
            }
            string  = `<div class="badge bg-${color}">${title}</div>`;
            return string;
        }



    })
</script>
