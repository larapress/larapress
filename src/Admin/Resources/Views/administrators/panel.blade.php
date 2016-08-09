<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-xs-1">
                <img src="{!! $administrator->profile_image !!}" class="img-responsive">
            </div>
            <div class="col-xs-6">
                <h4>{!! $administrator->user->name !!} | {!! $administrator->user->email !!} </h4>
                <p>Role: {!! $administrator->role !!}</p>
            </div>
            <div class="col-xs-5 text-right">
                <a href="{!!route('larapress.administrators.edit', $administrator->id)!!}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
</div>
