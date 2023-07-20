<input type="checkbox" id="addSupplierModal" class="modal-toggle" />
<div class="modal">
  <div class="modal-box">
    <h3 class="font-bold text-lg">Add Supplier</h3>

    <form id="addSupplierForm" method="POST" action="">
        @csrf
        <div id="supplier_email_td" class="form-control mt-2">
            <label class="label">
              <span class="label-text">Supplier Email</span>
            </label>
            <input type="email" name="supplier_email" id="supplier_email" placeholder="Supplier Email" class="input input-bordered" />
        </div>
        <div id="supplier_phone_td" class="form-control mt-2">
            <label class="label">
              <span class="label-text">Phone Number</span>
            </label>
            <input type="text" name="supplier_phone" id="supplier_phone" placeholder="Phone Number" class="input input-bordered" />
        </div>
        <div class="modal-action">
          <button type="submit" class="btn btn-neutral">Add Supplier</button>
        </div>
    </form>

  </div>
</div>
