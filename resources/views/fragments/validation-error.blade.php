@if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible fade show mx-3" role="alert">
        <strong>Validation Error</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>
                    {{ $error }}
                </li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif