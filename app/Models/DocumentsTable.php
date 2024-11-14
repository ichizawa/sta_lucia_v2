<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentsTable extends Model
{
    use HasFactory;

    protected $table = "documents";

    protected $fillable = [
        'dti_reg',
        'valid_id1',
        'valid_id2',
        'sec_reg',
        'valid_idSig1',
        'valid_idSig2',
        'bir_cor',
        'comp_prof',
        'menu_list',
        'store_persp',
        'franch_letter',
        'car_letter',
        'service_letter',
        'realty_letter',
        'hlurb',
        'status'
    ];

    public function tenant_documents()
    {
        return $this->hasMany(TenantDocuments::class, 'document_id');
    }
}
