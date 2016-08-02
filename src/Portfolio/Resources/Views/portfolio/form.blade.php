<div class="row">
    <div class="col-xs-8">
        @include('larapress::common.errors')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title"
                   name="title"
                   value="{!!old('title', isset($project->title) ? $project->title : null)!!}"
                   class="form-control"/>
        </div>

        @if(!isset($project))
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" id="slug"
                   name="slug"
                   value="{!!old('slug', isset($project->slug) ? $project->slug : null)!!}"
                   class="form-control"/>
        </div>
        @endif

        <div class="form-group">
            <label for="description">Meta Description</label>
            <input type="text" id="description"
                   name="description"
                   value="{!!old('description', isset($project->description) ? $project->description : null)!!}"
                   class="form-control"/>
        </div>
        
        <div class="form-group">
            <label for="body">Content</label>
            <textarea id="body"
                      name="body"
                      class="form-control HTMLeditor">
                {!!old('body', isset($project->body) ? $project->body : null)!!}
            </textarea>
        </div>
    </div>

    <div class="col-xs-4">
        <div class="form-group">
            <label for="status">Project Status</label>
            <select id="status" name="status" class="form-control">
                <option value="published">Published</option>
                <option value="draft">Draft</option>
            </select>
        </div>

        <div class="form-group">
            <label for="website">Website URL</label>
            <input type="text" id="website"
                   name="website"
                   value="{!!old('website', isset($project->website) ? $project->website : null)!!}"
                   class="form-control"/>
        </div>

        <div class="form-group">
            <label for="launched_date">Launched Date</label>
            <input type="date" id="launch_date"
                   name="launched_date"
                   value="{!!old('launch_date', isset($project->launched_date) ? $project->launched_date : null)!!}"
                   class="form-control"/>
        </div>

        <feature-image btn-text="Select Cover Image"
                feature-name="cover_image"
                feature-title="Cover Image"
                feature-value="{!!$project->cover_image!!}"
                upload-directory="/media/images/portfolio"
                ></feature-image>

        <div class="form-group">
            <input type="submit" value="Save" class="btn btn-primary pull-right">
        </div>
    </div>
</div>
