<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SteppingStone extends Model
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
        'short_description',
        'description',
        'video_link',
        'pdf_file',
        'audio_file',
        'main_content',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function modules()
    {
        return $this->belongsToMany(\App\Models\Module::class);
    }

    public function setPdfFileAttribute($value)
    {
        $attribute_name = "pdf_file";
        $disk = "public";
        $destination_path = "steppingStone/pdfFile";

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
    }

    public function setAudioFileAttribute($value)
    {
        $attribute_name = "audio_file";
        $disk = "public";
        $destination_path = "steppingStone/audioFile";

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
    }
}
