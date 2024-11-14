<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AwardNoticeFiles extends Model
{
    use HasFactory;

    protected $table = 'award_notice_files';
    protected $fillable = ['award_notice_id', 'owner_id', 'file_name', 'file_path', 'status'];
}
