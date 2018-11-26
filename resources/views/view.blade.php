@extends("layouts.std_layout")
@section("title", "View advertisements")
@section("links")
    @parent
    <link rel="stylesheet" href="css/view.css">
@endsection

@section("content") {{--  _____________________________________________CONTENT_______________________________________________________  --}}
    <h1 class="display-4"> View advertisements </h1>
    <table class="table table-striped table-bordered table-responsive table-fixed d-block">  {{-- WHY IS TABLE-FIXED AND SOME OTHER CLASSES NOT WORKING --}}
        <thead class="thead-dark text-center text-capitalize">
            <tr>
                @foreach ($thead as $th)
                    <th class="align-middle">
                        {{ $th }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($tbody as $tb)
                <tr>
                    @foreach ($tb as $t)
                        <td> {{ $t }} </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection {{--  __________________________________________________END_OF_CONTENT___________________________________________________  --}}

@section("scripts")
    <script src="js/view.js"></script>
@endsection
