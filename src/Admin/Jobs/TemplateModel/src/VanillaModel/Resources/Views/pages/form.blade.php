<div class="row">
    <div class="col-xs-8">
        @include('larapress::common.errors')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title"
                   name="title"
                   value="{!!old('title', isset(${model}->title) ? ${model}->title : null)!!}"
                   class="form-control"/>
        </div>

        @if(!isset(${model}))
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" id="slug"
                       name="slug"
                       value="{!!old('slug', isset(${model}->slug) ? ${model}->slug : null)!!}"
                       class="form-control"/>
            </div>
        @endif
    </div>

    <div class="col-xs-4">
        <div class="form-group">
            <label for="status">{Model} Status</label>
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
