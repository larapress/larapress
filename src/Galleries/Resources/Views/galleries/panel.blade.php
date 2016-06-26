<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-xs-7">
                {!!$gallery->title!!}
            </div>
            <div class="col-xs-5 text-right">
                <a href="{!!route('larapress.galleries.edit', $gallery->id)!!}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
</div>
