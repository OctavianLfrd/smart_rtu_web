<div id="{{ $id }}" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-left text-info">{{ $name }}</h4>
            </div>
            <div class="modal-body">
                <p class="text-right text-info"><span class="text-secondary font-weight-light">Sūtītājs:</span> {{ $owner }}</p>
                <hr class="text-info">
                <div class="container text-center">
                    {{ $text }}
                </div>
            </div>
            <div class="modal-footer">
                <div class="row small">
                    <div class="col-md-3 col-sm-6 col-xs-6 text-right">
                        <p class="text-secondary">Noformējuma tips:</p>
                        <p class="text-secondary">Prioritāte:</p>
                        <p class="text-secondary">Aktīvs:</p>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6 text-left">
                        <p class="text-info">{{ $type }}</p>
                        <p class="text-info">{{ $priority }}</p>
                        <p class="text-info">{{ $enabled }}</p>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6 text-right">
                            <p class="text-secondary">Sākuma datums:</p>
                            <p class="text-secondary">Beigu datums:</p>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6 text-left">
                            <p class="text-info">{{ $starts_at }}</p>
                            <p class="text-info">{{ $finishes_at }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
