

<!-- Modal -->
<div class="modal fade" id="brandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-light" id="exampleModalLabel">Add new Brand</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="brand_form" onsubmit="return false" autocomplete="off">
                    <div class="form-group">
                        <label for="#brandname">Brand Name : </label>
                        <input type="text" class="form-control" id="brandname" placeholder="Enter Brand Name" name="brandname">
                        <small id="brand_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-block ">Submit</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>