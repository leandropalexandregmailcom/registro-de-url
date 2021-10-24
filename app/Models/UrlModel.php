<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UrlModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'url';

    protected $fillable = ['id_url', 'url', 'descricao', 'created_at', 'updated_at', 'deleted_at', 'status'];

    public function logUrl()
    {
        $this->hasMany(LogUrlModel::class);
    }

}
