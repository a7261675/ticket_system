<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BugList extends Model
{
    use HasFactory;

    protected $table = 'bug_list';
    const UPDATED_AT = 'update_at';
}
