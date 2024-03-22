<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Task extends Model
{

    use HasFactory;

    protected $connection = 'mysql';

    protected $table = 'tasks';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getData()
    {
        $data = DB::table($this->table)->get();

        return $data;
    }
}
