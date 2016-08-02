<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-xs-1">
                <img src="{!! $post->cover_image !!}" class="img-responsive">
            </div>
            <div class="col-xs-6">
                <h4>{!!$post->title!!}</h4>
                <p>Category: <i>{!! $post->category !!}</i> Sub-Category: <i>{!! $post->sub_category !!}</i></p>
            </div>
            <div class="col-xs-5 text-right">
                <a href="{!!route('larapress.posts.edit', $post->id)!!}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
</div>
