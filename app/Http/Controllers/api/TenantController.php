<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Owner;
use App\Models\Representative;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    // public function tenantProfile()
    // {
    //     try {
    //         $tenant_id = auth()->user()->id;
    //         $profile = Owner::join('users', 'users.id', 'owner.user_id')
    //             ->where('users.id', $tenant_id)->get();
    //         return response(['result' => $profile], 200);
    //     } catch (ModelNotFoundException $e) {
    //         return response(['msg' => 'tenants not found', 'error' => $e->getMessage()], 404);
    //     } catch (\Exception $e) {
    //         return response(['error' => 'An error occurred', 'msg' => $e->getMessage()], 500);
    //     }
    // }

    public function tenantProfile($user_id)
    {
        $owner = Owner::with(['companies', 'representatives'])
            ->where('id', $user_id)
            ->first();

        if (!$owner) {
            return response()->json([
                'message' => 'Tenant not found'
            ], 404);
        }

        return response()->json([
            'owner' => $owner,
        ]);
    }

}
