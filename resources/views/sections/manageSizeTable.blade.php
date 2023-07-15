<div class="overflow-x-auto">
    <table class="table">
      <!-- head -->
      <thead>
        <tr>
          <th>#</th>
          <th>Size Id</th>
          <th>Size Name</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <!-- row 1 -->

        @foreach ($allSizes as $key=>$size)
            <tr>
                <th>{{ $key+1 }}</th>
                <td>{{ $size->size_id }}</td>
                <td>{{ $size->size_name }}</td>
                <td>
                    @if($size->status === 'active')
                        <button id="deActiveBtn" data-size_id="{{ $size->size_id }}" class="btn btn-xs btn-success">
                            {{ $size->status }}
                        </button>
                        @else
                        <button id="activeBtn" data-size_id="{{ $size->size_id }}" class="btn btn-xs btn-error">
                            {{ $size->status }}
                        </button>
                    @endif
                </td>
            </tr>
        @endforeach

      </tbody>
    </table>
</div>
