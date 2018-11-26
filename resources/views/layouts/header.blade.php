@section('header')
    <header class="header">
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top font-weight-light border-bottom border-light">
            <span class="navbar-brand"><h1 class="font-weight-light text-light">Smart RTU <small><span class="badge badge-lg bg-white text-dark">ADMIN</span></small></h1></span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-links">
                <span class="navbar-toggler-icon"></span> {{-- ICON --}}
            </button>
            <div class="collapse navbar-collapse" id="navbar-links">
                <ul class="navbar-nav">
                    <li class="nav-item col"><a href="/" class="nav-link text-light"><i class="material-icons d-inline">home</i>Home</a></li>
                    <li class="nav-item col"><a href="/adlist" class="nav-link text-light"><i class="material-icons d-inline">pageview</i>View</a></li>
                    <li class="nav-item col"><a href="/edit" class="nav-link text-light"><i class="material-icons d-inline">mode_edit</i>Edit</a></li>
                    <li class="nav-item col"><a href="/create" class="nav-link text-light"><i class="material-icons d-inline">note_add</i>Create</a></li>
                </ul>
            </div>
        </nav>
    </header>
@show
