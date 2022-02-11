<div class="modal fade" id="manageDeliveryModal" tabindex="-1" role="dialog" aria-labelledby="manageDeliveryModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal" >Manage Delivery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fe fe-x-circle"></i>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('driver.driverFreightMessage') }}"  class="row">@csrf
                    <input type="hidden" name="data">
                    <div class="col-12">
                        <label>Action</label>
                        <select name="action" class="form-control" >
                            <option>...Select Action...</option>
                            <option value="5">Delivered (DEL)</option>
                            <option value="6">Refused (RFS)</option>
                        </select>
                    </div>


                    <div class="col-12 mt-2">
                        <label>Message</label>
                        <textarea name="message" class="form-control" rows="3" placeholder="Enter Message" ></textarea>
                    </div>



                    <div class="col-12 d-flex mt-2 justify-content-end">
                        <button type="button" class="btn btn-outline-secondary me-2"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
