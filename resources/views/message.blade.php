@if(session('success'))

                <div class="alert alert-success alert-dismissible" role="alert" >
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    {{ session('success') }}
                </div>


@endif

@if(Session::has('message'))
    <br>
    <div class="alert alert-success alert-dismissible" role="alert" id="form-message">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        {{Session::get('message')}}
    </div>
    <script>

    </script>

@endif