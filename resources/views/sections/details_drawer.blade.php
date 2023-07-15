<div class="drawer drawer-end">
    <input id="detailsDrawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content">
      <!-- Page content here -->
        {{-- @include('layouts.dashboard') --}}
    </div>
    <div class="drawer-side">
      <label for="detailsDrawer" class="drawer-overlay"></label>
      <div class="menu p-4 w-80 h-full bg-base-200 text-base-content">
        <div class="flex justify-between mb-2">
            <label for="addSizeModal" class="btn btn-neutral btn-sm normal-case">Add new Size</label>
            <label for="manageSizeModal" class="btn btn-info btn-sm normal-case">Manage Sizes</label>
        </div>
        <hr class="border text-2xl border-2 border-solid border-gray-500" />
        <div id="detailDrawerContent">

        </div>

      </div>
    </div>
</div>

