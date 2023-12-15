<x-ladmin-auth-layout>
    <x-slot name="title">Approve Events</x-slot>
    <x-ladmin-card>
        <x-slot name="body">
            {{ \Modules\Ladmin\Datatables\ApprovalDatatables::table() }}
        </x-slot>
    </x-ladmin-card>

    <div class="modal fade" id="approve-modal" tabindex="-1" role="dialog" aria-labelledby="approve-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <form id="approve-form" action="{{ route('ladmin.event.approval.post') }}" method="post">
              @csrf
              <input type="hidden" name="id" value="">
              <div class="modal-header border-0">
                <h5 class="modal-title" id="approve-modal-label">Approve Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                Confirm approval for this event?
              </div>
              <div class="modal-footer border-0">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">No</button>
                <button id="submit-btn" type="submit" class="btn btn-sm btn-success">Yes</button>
              </div>
            </form>
          </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            $('#approve-modal').on('show.bs.modal' ,function(e) {
                var itemId =  $(e.relatedTarget).data('id');
                $(this).find('[name=id]').val(itemId);
            });
            $(window).ready(function() {
                $('#approve-form').on('submit', function () {
                    $('#submit-btn').prop('disabled', true);
                });
            });
        </script>
    </x-slot>
</x-ladmin-auth-layout>