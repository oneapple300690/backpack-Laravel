<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'subscription_price',
        'oneOff_price',
        'numOfSubscriber',
        'date',
        'status',
        'video_link',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'subscription_price' => 'float',
        'oneOff_price' => 'float',
        'date' => 'date',
    ];


    public function modules()
    {
        return $this->belongsToMany(\App\Models\Module::class);
    }
}
