<x-ladmin-auth-layout>
    <x-slot name="title">Registered Participants</x-slot>
    <x-slot name="button_end">
        <a href="{{ route('ladmin.event.participant.download', [$event->id]) }}" class="btn btn-primary">Download Participant Data</a>
    </x-slot>
    <x-ladmin-card>
        <x-slot name="body">
            {{ \Modules\Ladmin\Datatables\ParticipantDatatables::table() }}
        </x-slot>
    </x-ladmin-card>
        
    <div class="modal fade" id="reject-modal" tabindex="-1" role="dialog" aria-labelledby="reject-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <form action="{{ route('ladmin.event.participant.reject', [$event->id]) }}" method="post">
              @csrf
              <input type="hidden" name="id" value="">
              <div class="modal-header border-0">
                <h5 class="modal-title" id="reject-modal-label">Reject Participant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="mb-4">
                    <label for="reason" class="form-label">Rejection Reason</label>
                    <input type="text" class="form-control" name="reason" id="reason" required>
                </div>
                Are you sure to reject this?
              </div>
              <div class="modal-footer border-0">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">No</button>
                <button type="submit" class="btn btn-sm btn-danger">Yes</button>
              </div>
            </form>
          </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            $('#reject-modal').on('show.bs.modal' ,function(e) {
                var itemId =  $(e.relatedTarget).data('id');
                $(this).find('[name=id]').val(itemId);
            });
        </script>
    </x-slot>
</x-ladmin-auth-layout>