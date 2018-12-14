<div id="{{ $id }}" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-warning"><i class="material-icons d-inline">warning</i>{{ $title }}</h4>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer" data-dismiss="modal">
                <button class="btn btn-outline-warning" @click="{{ $delete_function }}">Yes</button>
                <button class="btn btn-outline-dark">No</button>
            </div>
        </div>
    </div>
</div>
