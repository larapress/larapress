<?php

namespace Larapress\Admin\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    protected $fillable = ['user_id', 'status', 'role'];

    protected $table = 'LP_administrators';

    public function user(){
        return $this->hasOne(User::class);
    }
}
