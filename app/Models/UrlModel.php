<?php

namespace App\Models;

use App\Models\LogUrlModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UrlModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'url';
    protected $primaryKey  = 'id_url';

    protected $fillable = ['id_url', 'url', 'descricao', 'created_at', 'updated_at', 'deleted_at', 'status'];

    public function urls()
    {
        return $this->hasMany(LogUrlModel::class, "id_url", "id_url");
    }

    public function lastUrl()
    {
        return $this->hasOne(LogUrlModel::class, "id_url", "id_url")->latest('id_log_url', 'max');
    }

    public function dlastUrl()
    {
        return $this->hasOne(LogUrlModel::class, "id_url", "id_url");
    }

}
