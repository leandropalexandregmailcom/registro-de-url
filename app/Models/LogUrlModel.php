<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogUrlModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'log_url';
    protected $primaryKey  = 'id_log_url';
    protected $foreignKey  = 'id_url';

    protected $fillable = ['id_log_url', 'id_url', 'data', 'date', 'created_at', 'updated_at', 'deleted_at', 'status_code'];

    public function url()
    {
        $this->belongsTo(UrlModel::class, 'id_url');
    }
}
