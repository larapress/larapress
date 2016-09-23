--php

namespace {Vendor}\{Package}\{Models}\Models;

use Illuminate\Database\Eloquent\Model;

class {Model} extends Model
{
    protected $table = '{models}';

    protected $fillable = ['title', 'status', 'slug'];
}
