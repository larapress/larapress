<?php

namespace Larapress\Admin\Models;

trait AdministratorUser{
    public function administrator(){
        return $this->hasOne(Administrator::class);
    }
}