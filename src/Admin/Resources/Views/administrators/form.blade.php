<div class="row">
    <div class="col-xs-8">
        @include('larapress::common.errors')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name"
                   name="name"
                   value="{!!old('name', isset($administrator->user->name) ? $administrator->user->name : null)!!}"
                   class="form-control"/>
        </div>


        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" id="email"
                   name="email"
                   value="{!!old('email', isset($administrator->user->email) ? $administrator->user->email : null)!!}"
                   class="form-control"/>
        </div>

        @if(!isset($administrator))
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password"
                       name="password"
                       value="{!!old('password') !!}"
                       class="form-control"/>
            </div>
        @endif

    </div>

    <div class="col-xs-4">
        <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role" class="form-control">
                @foreach(config('larapress.administrators.roles')as $role)
                    <option value="{!! $role["value"] !!}" @if(isset($administrator) && $role["value"] == $administrator->role)
                            selected="selected"@endif>
                        {!! $role["display"] !!}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-control">
                @foreach(config('larapress.administrators.status') as $status)
                    <option value="{!! $status["value"] !!}" @if(isset($administrator) && $status["value"] == $administrator->status)
                            selected="selected"@endif>
                        {!! $status["display"] !!}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <input type="submit" value="Save" class="btn btn-primary pull-right">
        </div>
    </div>
</div>
