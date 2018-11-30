@extends("layouts.std_layout")
@section("title", "View advertisements")
@section("links")
    @parent
    <link rel="stylesheet" href="{{ asset('css/view.css') }}">
@endsection

@section("content") {{--  _____________________________________________CONTENT_______________________________________________________  --}}
    <h1 class="display-4"> View advertisements </h1>
    <div id="table-controls" class="btn-group float-right">
        <button type="button" id="delete" class="btn btn-outline-dark" data-toggle="modal" data-target="#deleteConfirm" disabled>Delete</button>
    </div>

    <div class="table-responsive rounded">
        <table class="table table-striped float-center table-fixed small table-sm d-block border border-dark">  {{-- WHY IS TABLE-FIXED AND SOME OTHER CLASSES NOT WORKING --}}
            <thead class="thead-dark text-center">
                <tr>
                    <th class="align-middle text-left">
                        <div class="form-check">
                            <span class="text-capitalize badge bg-white text-dark" @click="selectAll(); buttonActive()">Select all</span>
                        </div>
                    </th>
                    @foreach ($thead as $key => $th)
                        <th class="align-middle" @click="sortRows">
                            <span class="th-content d-inline text-capitalize">{{ $th->column_name }}</span>
                            {{-- <i id="{{ $key }}" v-if="arrows == {{ $key }}" class="material-icons text-light">swap_vert</i> --}}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr v-for="tr in tbody">
                    <td class="text-center align-middle form-check"><input type="checkbox" class="form-check-input" :value="tr.id" @change="buttonActive"></td>
                    <td v-for="td in tr" :title="td"> ${ cellContent(td) }$ </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div id="deleteConfirm" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-warning"><i class="material-icons d-inline">warning</i>Delete</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete selected advertisements?
                </div>
                <div class="modal-footer" data-dismiss="modal">
                    <button class="btn btn-outline-warning" @click="deleteRows">Yes</button>
                    <button class="btn btn-outline-dark">No</button>
                </div>
            </div>
        </div>
    </div>
    <div id="deleteComplete" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-success"><i class="material-icons d-inline">done</i>Deletion Complete</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body table-responsive text-center">
                    <span>The following elements have been deleted successfully:<span> <br><br>
                    <table class="table table table-striped table-fixed small table-sm d-block border border-dark rounded">
                        <thead class="thead-dark text-center">
                            <th>Id</th><th>Name</th>
                        </thead>
                        <tbody>
                            <tr v-for="del in deleted"><td>${ del.id }$</td><td>${ del.name }$</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer" data-dismiss="modal">
                    <button class="btn btn-outline-success">Ok</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("scripts")
    <script src="{{ asset('js/view.js') }}"></script>
@endsection
