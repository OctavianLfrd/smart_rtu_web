@extends("layouts.std_layout")
@section("title", "View advertisements")
@section("links")
    @parent
    <link rel="stylesheet" href="{{ asset('css/view_ads.css') }}">
@endsection

@section("content") {{--  _____________________________________________CONTENT_______________________________________________________  --}}
    <h1 class="display-4 text-info"> View advertisements </h1>
    <div id="table-controls" class="btn-group float-right">
        <button type="button" id="delete" class="btn btn-outline-info" data-toggle="modal" data-target="#delete-confirm" disabled>Delete</button>
    </div>


    {{--  ADVERT TABLE  --}}

    <div class="table-responsive">
        <table class="table table-striped float-center table-fixed table-sm small d-block border border-info rounded" id="ad-table">
            <thead class="text-info text-center">
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
                    <th class="align-middle text-left">
                        <span class="th-content d-inline" data-order="asc"  data-value="name"        @click="sortRows($event)">Nosaukums</span>
                    </th>
                    <th class="align-middle text-left">
                        <span class="th-content d-inline" data-order="asc"  data-value="owner"       @click="sortRows($event)">Sūtītājs</span>
                    </th>
                    <th class="align-middle text-left">
                        <span class="th-content d-inline" data-order="asc"  data-value="type"        @click="sortRows($event)">Tips</span>
                    </th>
                    <th class="align-middle text-left">
                        <span class="th-content d-inline" data-order="asc"  data-value="starts_at"   @click="sortRows($event)">Sākuma datums</span>
                    </th>
                    <th class="align-middle text-left">
                        <span class="th-content d-inline" data-order="asc"  data-value="finishes_at" @click="sortRows($event)">Beigu datums</span>
                    </th>
                    <th class="align-middle text-left">
                        <span class="th-content d-inline" data-order="asc"  data-value="priority"    @click="sortRows($event)">Prioritāte</span>
                    </th>
                    <th class="align-middle text-left">
                        <span class="th-content d-inline" data-order="desc" data-value="enabled"     @click="sortRows($event)">Aktīvs</span>
                    </th>
                    <td></td><td></td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(tr, index) in ads">
                    <td class="bg-white">
                        <div class="text-center pretty p-default p-curve">
                            <input type="checkbox" class="select" :value="tr.id" v-model="checkedRows" @change="buttonActive">
                            <div class="state p-primary">
                                <label>&nbsp;</label>
                            </div>
                        </div>
                    </td>
                    <td :title="tr.name        " data-type="name"><span class="data-type-name" @click="editName($event)">${ tr.name | shorten }$</span>
                        <div class="form-group" style="display: none">
                            <input type="text" class="form-control form-control-sm col-8 float-left">
                            <button class="btn btn-outline-info btn-sm col-4 float-right" @click="updateName(index, $event)">Mainīt</button>
                        </div>
                    </td>
                    <td :title="tr.owner       " data-type="owner">       ${ tr.owner       }$  </td>
                    <td :title="tr.type        " data-type="type">        ${ tr.type        }$  </td>
                    <td :title="tr.starts_at   " data-type="starts_at">   ${ tr.starts_at   }$  </td>
                    <td :title="tr.finishes_at " data-type="finishes_at"> ${ tr.finishes_at }$  </td>
                    <td :title="tr.priority    " data-type="priority">
                        <button class="dropdown-toggle btn btn-sm btn-link text-dark" data-toggle="dropdown"> ${ tr.priority }$ </button>
                        <ul class="dropdown-menu collapse text-dark">
                            <li class="dropdown-item"><button class="btn btn-sm btn-link text-dark" @click="updatePriority(index, 'low'        )"> low         </button></li>
                            <li class="dropdown-item"><button class="btn btn-sm btn-link text-dark" @click="updatePriority(index, 'medium'     )"> medium      </button></li>
                            <li class="dropdown-item"><button class="btn btn-sm btn-link text-dark" @click="updatePriority(index, 'high'       )"> high        </button></li>
                            <li class="dropdown-item"><button class="btn btn-sm btn-link text-dark" @click="updatePriority(index, 'EXCEPTIONAL')"> EXCEPTIONAL </button></li>
                        </ul>
                    </td>
                    <td data-type="enabled">
                        <input class="enabled switchbox" type="checkbox" v-model="tr.enabled" @click="updateEnabled(index)">
                    </td>
                    <td class="text-center align-middle">
                        <div>
                            <button class="text-danger close dropdown-toggle" data-toggle="dropdown">&times;</button>
                            <ul class="dropdown-menu collapse">
                                <h6 class="dropdown-header text-info">Delete this ad?</h6>
                                <li class="dropdown-item"><button class="btn btn-link text-success" @click="deleteAds(index)">Yes</button></li>
                                <li class="dropdown-item"><button class="btn btn-link text-danger">No</button></li>
                            </ul>
                        </div>
                    </td>
                    <td class="align-middle">
                        <i class="material-icons view-icon text-info" @click="viewAd(index)">visibility</i>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{--  MODAL: DELETION CONFIRMATION  --}}

    @component("components.modal_confirm")
        @slot("id")              delete-confirm @endslot
        @slot("title")           Delete         @endslot
        @slot('delete_function') deleteAds     @endslot
        {{--  MAIN SLOT  --}}
        Are you sure you want to delete selected advertisements?
    @endcomponent


    {{--  MODAL: DELETION CONFIRMATION  --}}

    @component("components.modal_complete")
        @slot("id")    delete-complete   @endslot
        @slot("title") Deletion complete @endslot
        {{--  MAIN SLOT  --}}
        <span>The following elements have been deleted successfully:<span> <br><br>
        <table class="table table-fixed small table-sm d-block border border-success rounded">
            <thead class="text-success text-center">
                <th>Nosaukums</th>
            </thead>
            <tbody>
                <tr v-for="del in deleted">
                    <td> ${ del.id   }$ </td>
                    <td> ${ del.name }$ </td>
                </tr>
            </tbody>
        </table>
    @endcomponent

    {{--  MODAL: VIEW ADS  --}}
    @component("components.modal_view_ad")
        @slot("id")             view-ads              @endslot
        @slot("name")        ${ advert.name        }$ @endslot
        @slot("owner")       ${ advert.owner       }$ @endslot
        @slot("text")    <p v-html="advert.text"></p> @endslot
        @slot("starts_at")   ${ advert.starts_at   }$ @endslot
        @slot("finishes_at") ${ advert.finishes_at }$ @endslot
        @slot("priority")    ${        priority    }$ @endslot
        @slot("type")        ${        type        }$ @endslot
        @slot("enabled")     ${        enabled     }$ @endslot
    @endcomponent

    @endsection

    {{--  SCRIPTS  --}}

@section("scripts")
    <script src="{{ asset('js/view_ads.js') }}"></script>
@endsection
