<x-ladmin-auth-layout>
    <x-slot name="title">List of Students</x-slot>
    @can(['ladmin.student_user.create'])
        <x-slot name="button">
            <a href="{{ route('ladmin.student_user.create', ladmin()->back()) }}" class="btn btn-primary">&plus; Add New Student</a>
        </x-slot>
    @endcan
    <x-ladmin-card>
        <x-slot name="body">
            {{ \Modules\Ladmin\Datatables\StudentUserDatatables::table() }}
        </x-slot>
    </x-ladmin-card>
        
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <form id="deactive-form" action="{{ route('ladmin.student_user.destroy') }}" method="post">
              @csrf
              <input type="hidden" name="id" value="">
              <div class="modal-header border-0">
                <h5 class="modal-title" id="delete-modal-label">Deactivate User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                Are you sure to deactivate this user account?
              </div>
              <div class="modal-footer border-0">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">No</button>
                <button id="submit-deactive-btn" type="submit" class="btn btn-sm btn-danger">Yes</button>
              </div>
            </form>
          </div>
        </div>
    </div>

    <div class="modal fade" id="reactivate-modal" tabindex="-1" role="dialog" aria-labelledby="reactivate-modal-label" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <form id="reactive-form" action="{{ route('ladmin.student_user.reactivate') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="">
            <div class="modal-header border-0">
              <h5 class="modal-title" id="reactivate-modal-label">Reactivate User</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Confirm reactivation of this student account?
            </div>
            <div class="modal-footer border-0">
              <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">No</button>
              <button id="submit-reactive-btn" type="submit" class="btn btn-sm btn-success">Yes</button>
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

            $('#reactivate-modal').on('show.bs.modal' ,function(e) {
                var itemId =  $(e.relatedTarget).data('id');
                $(this).find('[name=id]').val(itemId);
            });

            $(window).ready(function() {
                $('#deactive-form').on('submit', function () {
                    $('#submit-deactive-btn').prop('disabled', true);
                });
                $('#reactive-form').on('submit', function () {
                    $('#submit-reactive-btn').prop('disabled', true);
                });
            });
        </script>
    </x-slot>
</x-ladmin-auth-layout>