<x-ladmin-auth-layout>
    <x-slot name="title">Highlighted Events</x-slot>
    @can(['ladmin.highlight.create'])
        <x-slot name="button">
            <a href="{{ route('ladmin.event.highlight.create', ladmin()->back()) }}" class="btn btn-primary">&plus; Add New Event</a>
        </x-slot>
    @endcan
    <x-ladmin-card>
        <x-slot name="body">
            {{ \Modules\Ladmin\Datatables\HighlightEventDatatables::table() }}
        </x-slot>
    </x-ladmin-card>
    
    <div class="modal fade" id="remove-modal" tabindex="-1" role="dialog" aria-labelledby="remove-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <form id="remove-form" action="{{ route('ladmin.event.highlight.remove') }}" method="post">
              @csrf
              <input type="hidden" name="id" value="">
              <div class="modal-header border-0">
                <h5 class="modal-title" id="remove-modal-label">Remove</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                Are you sure to remove this event from highlighted?
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
            $('#remove-modal').on('show.bs.modal' ,function(e) {
                var itemId =  $(e.relatedTarget).data('id');
                $(this).find('[name=id]').val(itemId);
            });

            $(window).ready(function() {
                $('#remove-form').on('submit', function () {
                    $('#submit-btn').prop('disabled', true);
                });
            });
        </script>
    </x-slot>
</x-ladmin-auth-layout>