@if(count($errors)>0)
    <div class="panel panel-danger">
        <div class="panel-heading">
            ERORI
        </div>
        <div class="panel-body">
            @foreach($errors->all() as $error)
                <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> {{ $error }}</p>
            @endforeach
        </div>
        <div class="panel-footer">
            Va rugam sa remediati erorile existente.
        </div>
    </div>
@endif