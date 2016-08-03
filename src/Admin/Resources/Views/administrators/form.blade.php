<div class="row">
    <div class="col-xs-8">
        @include('larapress::common.errors')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name"
                   name="name"
                   value="{!!old('name', isset($administrator->name) ? $administrator->name : null)!!}"
                   class="form-control"/>
        </div>

  
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" id="email"
                   name="email"
                   value="{!!old('email', isset($administrator->email) ? $administrator->email : null)!!}"
                   class="form-control"/>
        </div>


        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" id="password"
                   name="password"
                   value="{!!old('password', isset($administrator->password) ? $administrator->password : null)!!}"
                   class="form-control"/>
        </div>
    </div>

    <div class="col-xs-4">


        <div class="form-group" style="width:100%;float: left;">
            <input type="submit" value="Save" class="btn btn-primary pull-right">
        </div>
    </div>
</div>
