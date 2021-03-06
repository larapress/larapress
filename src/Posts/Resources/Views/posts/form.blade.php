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

        <div class="form-group">
            <label for="body">Test</label>
            <textbox-editor textbox-name="body" textbox-id="bodytext" textbox-value="fsdfsdf"></textbox-editor>
        </div>
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

        <post-categories dropdown-import='{!!json_encode(config('larapress.categories'))!!}'
                selected-category="{!! isset($post->category) ? $post->category : null !!}"
                selected-sub-category="{!! isset($post->sub_category) ? $post->sub_category : null !!}">
        </post-categories>

        <div class="form-group" style="width:100%;float: left;">
            <feature-image btn-text="Select Post Cover"
                           feature-name="cover_image"
                           feature-title="Cover Image"
                           feature-value="{!! isset($post->cover_image) ? $post->cover_image : null !!}"
                           upload-directory="/media/images/posts"
                    >
            </feature-image>
        </div>

        <div class="form-group" style="width:100%;float: left;">
            <input type="submit" value="Save" class="btn btn-primary pull-right">
        </div>
    </div>
</div>
