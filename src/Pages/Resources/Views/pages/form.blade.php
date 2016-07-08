<div class="row">
    <div class="col-xs-8">
        @include('larapress::common.errors')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title"
                   name="title"
                   value="{!!old('title', isset($page->title) ? $page->title : null)!!}"
                   class="form-control"/>
        </div>

        @if(!isset($page))
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" id="slug"
                       name="slug"
                       value="{!!old('slug', isset($page->slug) ? $page->slug : null)!!}"
                       class="form-control"/>
            </div>
        @endif

        <div class="form-group">
            <label for="description">Meta Description</label>
            <input type="text" id="description"
                   name="description"
                   value="{!!old('description', isset($page->description) ? $page->description : null)!!}"
                   class="form-control"/>
        </div>

        <div class="form-group">
            <label for="body">Content</label>
            <textarea id="body"
                      name="body"
                      class="form-control HTMLeditor"
                      style="height:40rem">
                {!!old('body', isset($page->body) ? $page->body : null)!!}
            </textarea>
        </div>
    </div>

    <div class="col-xs-4">
        <div class="form-group">
            <label for="status">Page Status</label>
            <select id="status" name="status" class="form-control">
                <option value="published">Published</option>
                <option value="draft">Draft</option>
            </select>
        </div>

        <div class="form-group">
            <input type="submit" value="Save" class="btn btn-primary pull-right">
        </div>
    </div>
</div>
