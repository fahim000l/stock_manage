<input type="checkbox" id="selectSupplierModal" class="modal-toggle" />
<div class="modal">
  <div class="modal-box">
    <form id='selectedSupplierForm' method="POST">
        <h3 class="font-bold text-lg mb-2">Selected Supplier</h3>
        {{-- <p class="py-4">Press ESC key or click the button below to close</p> --}}
        <div>
            <div class="form-control">
                <label class="label">
                  <span class="label-text">Supplier Email</span>
                </label>
                <input name="supplier_email_modal" id="supplier_email_modal" type="text" placeholder="Supplier Email" class="input input-bordered" />
            </div>
            <div class="form-control">
                <label class="label">
                  <span class="label-text">Date</span>
                </label>
                <input name="date_modal" id="date_modal" type="text" placeholder="Date" class="input input-bordered" />
            </div>
            <div class="form-control">
                <label class="label">
                  <span class="label-text">Trans Id</span>
                </label>
                <input name="trans_id" id="trans_id" type="text" placeholder="Trans Id" class="input input-bordered" />
            </div>
            <div class="form-control hidden">
                <label class="label">
                  <span class="label-text">Status</span>
                </label>
                <input value="pending" name="status" id="status" type="text" placeholder="Status" class="input input-bordered" />
            </div>
        </div>
        <div class="modal-action">
          <!-- if there is a button in form, it will close the modal -->
          <button type="submit" class="btn btn-neutral w-full">Confirm</button>
        </div>
      </form>
  </div>
</div>


{{-- <dialog id="selectSupplierModal" class="modal">

</dialog> --}}
