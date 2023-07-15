@php
    use Illuminate\Support\Str;
    $uuid = Str::uuid();
@endphp

<input type="checkbox" id="addSizeModal" class="modal-toggle" />
<div class="modal">
  <div class="modal-box">
    <form id='addSizeForm' method="POST">
        @csrf
        <h3 class="font-bold text-lg mb-2">Add New Size</h3>
        {{-- <p class="py-4">Press ESC key or click the button below to close</p> --}}
        <div>
            <div id="sizeIdFormControl" class="form-control">
                <label class="label">
                  <span class="label-text">Size Id</span>
                </label>
                <input name="size_id" id="size_id" value="{{ $uuid }}" type="text" placeholder="Size Id" class="input input-bordered" />
            </div>
            <div id="sizeNameFormControl" class="form-control">
                <label class="label">
                  <span class="label-text">Size</span>
                </label>
                <input name="size_name" id="size_name" type="text" placeholder="Size" class="input input-bordered" />
            </div>
            <div id="statusFormControl" class="form-control hidden">
                <label class="label">
                  <span class="label-text">Status</span>
                </label>
                <input name="status" id="status" type="text" value="active" placeholder="Status" class="input input-bordered" />
            </div>
        </div>
        <div class="modal-action">
          <!-- if there is a button in form, it will close the modal -->
          <button type="submit" id="addSizeBtn" class="btn btn-neutral w-full">Add Size</button>
        </div>
    </form>
  </div>
</div>
