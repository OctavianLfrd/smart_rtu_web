@extends("layouts.std_layout")
@section("title", "View advertisements")
@section("links")
    @parent
    <link rel="stylesheet" href="{{ asset('css/view_ads.css') }}">
@endsection

@section("content") {{--  _____________________________________________CONTENT_______________________________________________________  --}}
    <h1 class="display-4 text-info"> View advertisements </h1>
    <div id="table-controls" class="btn-group float-right">
        <button type="button" id="delete" class="btn btn-outline-dark" data-toggle="modal" data-target="#deleteConfirm" disabled>Delete</button>
    </div>


    {{--  ADVERT TABLE  --}}

    <div class="table-responsive">
        <table class="table table-striped float-center table-fixed small table-sm d-block border border-info rounded" id="adTable">
            <thead class="text-info text-center bg-light">
                <tr>
                    <td class="align-middle text-left">
                        <div class="pretty p-icon p-round p-jelly">
                            <input type="checkbox" id="select-all" @change="selectAll(); buttonActive()">
                            <div class="state p-primary">
                                <i class="icon mdi mdi-check"></i>
                                <label id="select-all-label">Select All</label>
                            </div>
                        </div>
                    </td>
                    <th class="align-middle text-left" @click="sortRows($event)"><span class="th-content d-inline text-capitalize" data-order="true" value="name" @click="sortRows">Vārds</span></th>
                    <th class="align-middle text-left" @click="sortRows($event)"><span class="th-content d-inline text-capitalize" data-order="true" value="owner">Īpašnieks</span></th>
                    <th class="align-middle text-left" @click="sortRows($event)"><span class="th-content d-inline text-capitalize" data-order="true" value="type">Tips</span></th>
                    <th class="align-middle text-left" @click="sortRows($event)"><span class="th-content d-inline text-capitalize" data-order="true" value="starts_at">Sākuma datums</span></th>
                    <th class="align-middle text-left" @click="sortRows($event)"><span class="th-content d-inline text-capitalize" data-order="true" value="finishes_at">Beigu datums</span></th>
                    <th class="align-middle text-left" @click="sortRows($event)"><span class="th-content d-inline text-capitalize" data-order="true" value="priority">Prioritāte</span></th>
                    <th class="align-middle text-left" @click="sortRows($event)"><span class="th-content d-inline text-capitalize" data-order="true" value="enabled">Aktīvs</span></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(tr, index) in tbody">
                    <td class="bg-white">
                        <div class="text-center pretty p-default p-curve">
                            <input type="checkbox" class="select" :value="tr.id" v-model="checkedRows" @change="buttonActive">
                            <div class="state p-primary">
                                <label>&nbsp;</label>
                            </div>
                        </div>
                    </td>
                    <td :title="tr.name        " data-type="name"><span @click="editName($event)">${ tr.name        }$</span>
                        <div class="form-group" style="display: none">
                            <input type="text" class="form-control form-control-sm col-10 float-left">
                            <button class="btn btn-outline-info btn-sm col-2 float-right" @click="updateName($event, tr.id)">Mainīt</button>
                        </div>
                    </td>
                    <td :title="tr.owner       " data-type="owner">       ${ tr.owner       }$</td>
                    <td :title="tr.type        " data-type="type">        ${ tr.type        }$</td>
                    <td :title="tr.starts_at   " data-type="starts_at">   ${ tr.starts_at   }$</td>
                    <td :title="tr.finishes_at " data-type="finishes_at"> ${ tr.finishes_at }$</td>
                    <td :title="tr.priority    " data-type="priority">
                        <button class="dropdown-toggle btn btn-sm btn-link text-dark" data-toggle="dropdown"> ${ tr.priority }$ </button>
                        <ul class="dropdown-menu collapse text-dark">
                            <li class="dropdown-item"><button class="btn btn-sm btn-link text-dark" @click="updatePriority($event, tr.id)">low        </button></li>
                            <li class="dropdown-item"><button class="btn btn-sm btn-link text-dark" @click="updatePriority($event, tr.id)">medium     </button></li>
                            <li class="dropdown-item"><button class="btn btn-sm btn-link text-dark" @click="updatePriority($event, tr.id)">high       </button></li>
                            <li class="dropdown-item"><button class="btn btn-sm btn-link text-dark" @click="updatePriority($event, tr.id)">EXCEPTIONAL</button></li>
                        </ul>
                    </td>
                    <td data-type="enabled">
                        <input class="enabled switchbox" type="checkbox" :value="tr.enabled" v-model="tr.enabled" @change="updateEnabled($event, tr.id)">
                    </td>
                    <td class="text-center align-middle">
                        <div>
                            <button class="text-danger close dropdown-toggle" data-toggle="dropdown">&times;</button>
                            <ul class="dropdown-menu collapse">
                                <h6 class="dropdown-header text-info">Delete this ad?</h6>
                                <li class="dropdown-item"><button class="btn btn-link text-success" @click="deleteOne(tr.id)">Yes</button></li>
                                <li class="dropdown-item"><button class="btn btn-link text-danger">No</button></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{--  MODAL: DELETION CONFIRMATION  --}}

    @component("components.modal_confirm")
        @slot("id")
            deleteConfirm
        @endslot
        @slot("title")
            Delete
        @endslot
        {{--  MAIN SLOT  --}}
        Are you sure you want to delete selected advertisements?
    @endcomponent


    {{--  MODAL: DELETION CONFIRMATION  --}}

    @component("components.modal_complete")
        @slot("id")
            deleteComplete
        @endslot
        @slot("title")
            Deletion complete
        @endslot
        {{--  MAIN SLOT  --}}
        <span>The following elements have been deleted successfully:<span> <br><br>
        <table class="table table table-striped table-fixed small table-sm d-block border border-info rounded">
            <thead class="thead-dark text-center">
                <th>Name</th>
            </thead>
            <tbody>
                <tr v-for="del in deleted"><td>${ del.id }$</td><td>${ del.name }$</td></tr>
            </tbody>
        </table>
    @endcomponent
    @endsection

    {{--  SCRIPTS  --}}

@section("scripts")
    <script src="{{ asset('js/view_ads.js') }}"></script>
@endsection
