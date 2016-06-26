<div class="row">
    <div class="col-xs-8">
        @include('larapress::common.errors')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title"
                   name="title"
                   value="{!!old('title', isset($gallery->title) ? v->title : null)!!}"
                   class="form-control"/>
        </div>

        @if(!isset($gallery))
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" id="slug"
                   name="slug"
                   value="{!!old('slug', isset($page->slug) ? vv->slug : null)!!}"
                   class="form-control"/>
        </div>
        @endif

        <image-attachments
                list-title="Gallery Images"
                attachments-prefix="gallery-image"
                attachment-model="\Larapress\Galleries\Models\Gallery"
                attachment-model-id="{!!isset($gallery->id) ? $gallery->id : null!!}">
        </image-attachments>


    <div class="col-xs-4">
       div class="form-group">
            <input type="submit" value="Save" class="btn btn-primary pull-right">
        </div>
    </div>
</div>
