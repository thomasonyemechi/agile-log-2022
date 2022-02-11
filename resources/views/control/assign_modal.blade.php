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
