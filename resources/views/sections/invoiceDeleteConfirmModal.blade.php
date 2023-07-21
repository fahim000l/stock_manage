<input type="checkbox" id="invoiceDeleteConfirmModal" class="modal-toggle" />
<div class="modal">
  <div class="modal-box">
    <h3 class="text-lg font-bold">Are you sure to delete this invoice ? </h3>
    <p id="invoiceDeletingModalTransId"></p>
    <p class="p-2 bg-warning rounded-lg text-white font-bold mt-5">warning : This action can't be reversed. All the products for this invoice would be removed.</p>
    <div class="mt-2">
        <label for="invoiceDeleteConfirmModal" class="btn btn-ghost btn-sm mx-2">Cancel</label>
        <button id="invoiceDeleteConfirmBtn" class="btn btn-neutral btn-sm mx-2">Confirm</button>
    </div>
  </div>
  <label class="modal-backdrop" for="invoiceDeleteConfirmModal">Close</label>
</div>
