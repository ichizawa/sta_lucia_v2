<?php

namespace App\Http\Controllers\api;

use Log;
use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Models\Sales;
use App\Models\Space;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function tenantProfile($user_id)
    {
        $owner = Owner::with(['companies', 'representatives', 'document'])
            ->where('id', $user_id)
            ->first();

        return !$owner
            ? response()->view('404', [], 404)
            : response()->view('502', [], 502);
    }


    public function tenantSales($user_id)
    {
        $sales = Sales::with(['owner', 'companies'])
            ->where('id', $user_id)
            ->first();

        return !$sales
            ? response()->view('404', [], 404)
            : response()->view('502', [], 502);
    }


    public function tenantSpaces($user_id)
    {
        $spaces = Space::with(['leasableInfoModel', 'spaceUtility', 'amenitySelected'])
            ->where('id', $user_id)
            ->first();

        return !$spaces
            ? response()->view('404', [], 404)
            : response()->view('502', [], 502);
    }
}
