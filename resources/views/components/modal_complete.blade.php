<div id="{{ $id }}" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-success"><i class="material-icons d-inline">done</i>{{ $title }}</h4>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body table-responsive text-center">
                {{ $slot }}
            </div>
            <div class="modal-footer" data-dismiss="modal">
                <button class="btn btn-outline-success">Ok</button>
            </div>
        </div>
    </div>
</div>
