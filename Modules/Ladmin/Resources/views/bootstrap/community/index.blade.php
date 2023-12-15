<x-ladmin-auth-layout>
    <x-slot name="title">List of Communities</x-slot>
    @can(['ladmin.community.create'])
        <x-slot name="button">
            <a href="{{ route('ladmin.community.create', ladmin()->back()) }}" class="btn btn-primary">&plus; Add New Community</a>
        </x-slot>
    @endcan
    <x-ladmin-card>
        <x-slot name="body">
            {{ \Modules\Ladmin\Datatables\CommunityDatatables::table() }}
        </x-slot>
    </x-ladmin-card>
        
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <form id="delete-form" action="{{ route('ladmin.community.destroy') }}" method="post">
              @csrf
              <input type="hidden" name="id" value="">
              <div class="modal-header border-0">
                <h5 class="modal-title" id="delete-modal-label">Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                Are you sure to delete this?
                <p class="text-danger mt-2">Note: Make sure there's no active admin associated with this community</p>
              </div>
              <div class="modal-footer border-0">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">No</button>
                <button id="submit-btn" type="submit" class="btn btn-sm btn-danger">Yes</button>
              </div>
            </form>
          </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            $('#delete-modal').on('show.bs.modal' ,function(e) {
                var itemId =  $(e.relatedTarget).data('id');
                $(this).find('[name=id]').val(itemId);
            });

            $(window).ready(function() {
                $('#delete-form').on('submit', function () {
                    $('#submit-btn').prop('disabled', true);
                });
            });
        </script>
    </x-slot>
</x-ladmin-auth-layout>