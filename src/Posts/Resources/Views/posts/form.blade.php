<div class="row">
    <div class="col-xs-8">
        @include('larapress::common.errors')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title"
                   name="title"
                   value="{!!old('title', isset($post->title) ? $post->title : null)!!}"
                   class="form-control"/>
        </div>

        @if(!isset($post))
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" id="slug"
                   name="slug"
                   value="{!!old('slug', isset($post->slug) ? $post->slug : null)!!}"
                   class="form-control"/>
        </div>
        @endif

        <div class="form-group">
            <label for="description">Meta Description</label>
            <input type="text" id="description"
                   name="description"
                   value="{!!old('description', isset($post->description) ? $post->description : null)!!}"
                   class="form-control"/>
        </div>
        
        <div class="form-group">
            <label for="body">Content</label>
            <textarea id="body"
                      name="body"
                      class="form-control HTMLeditor">
                {!!old('body', isset($post->body) ? $post->body : null)!!}
            </textarea>
        </div>

        <image-attachments
                list-title="Post Gallery Images"
                attachments-prefix="post-image"
                attachment-model="\Larapress\Posts\Models\Post"
                attachment-model-id="{!!isset($post->id) ? $post->id : null!!}">
        </image-attachments>
    </div>

    <div class="col-xs-4">
        <div class="form-group">
            <label for="status">Post Status</label>
            <select id="status" name="status" class="form-control">
                <option value="published">Published</option>
                <option value="draft">Draft</option>
                <option value="trashed">Trash</option>
            </select>
        </div>

        <div class="form-group" style="width:100%;float: left;">
            <feature-image></feature-image>
        </div>

        <div class="form-group" style="width:100%;float: left;">
            <input type="submit" value="Save" class="btn btn-primary pull-right">
        </div>
    </div>
</div>
