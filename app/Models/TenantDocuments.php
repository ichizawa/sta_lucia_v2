<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantDocuments extends Model
{
    use HasFactory;

    protected $table = "tenant_documents";

    protected $fillable = [
        'owner_id',
        'document_id',
        'view',
        'status'
    ];

    public function documents()
    {
        return $this->belongsTo(DocumentsTable::class, 'id');
    }
}
