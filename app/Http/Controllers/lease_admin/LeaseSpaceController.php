<?php

namespace App\Http\Controllers\lease_admin;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\AmenitySelected;
use App\Models\LeasableInfoModel;
use App\Models\Space;
use App\Models\SpaceBuilding;
use App\Models\SpaceLevel;
use App\Models\SpaceMallCode;
use App\Models\UtilitiesModel;
use Illuminate\Http\Request;

class LeaseSpaceController extends Controller
{
    public function leaseAdminSpace()
    {
        $all = Space::join('leasable_space', 'space.id', '=', 'leasable_space.space_id')->orderBy('leasable_space.id', 'desc')->get();
        return view('lease-admin.space.space', compact('all'));
    }

    public function leaseDelete(Request $request)
    {
        $space = Space::find($request->id);
        $space->delete();

        return response()->json([
            'message'=> 'Space deleted successfully',
        ]);
    }

    public function leaseAddSpace()
    {
        $utilities = UtilitiesModel::all();
        $amenities = Amenities::all();
        $mallcode = SpaceMallCode::all();
        $building = SpaceBuilding::all();
        $level = SpaceLevel::all();
        return view("lease-admin.space.create-space", compact('utilities', 'amenities', 'mallcode', 'building', 'level'));
    }

    public function leaseViewSpace(Request $request)
    {
        $viewSpace = Space::findOrFail($request->space_id);

        return response()->json([
            'space_name' => $viewSpace->space_name,
            'space_area' => $viewSpace->space_area,
            'mall_code' => $viewSpace->mall_code,
            'bldg_number' => $viewSpace->bldg_number,
            'unit_number' => $viewSpace->unit_number,
            'level_number' => $viewSpace->level_number,
            'store_type' => $viewSpace->store_type,
            'property_code' => $viewSpace->property_code,
        ]);
    }

    public function sumbmitSpace(Request $request)
    {
        $space = Space::firstOrCreate(
            attributes: [
                'unit_number' => $request->unitnumber,
            ],
            values: [
                'mall_code' => $request->mallCode,
                'bldg_number' => $request->bldgnumber,
                'level_number' => $request->levelNumber,
                'unit_number' => $request->unitnumber,
                'space_name' => $request->spacename,
                'space_area' => $request->spacearea,
                'store_type' => $request->storeType,
                'property_code' => $request->mallCode . $request->bldgnumber . $request->levelNumber . $request->unitnumber,
                'space_type' => $request->spaceType,
                'space_img' => $request->spaceIMG ? $request->file('spaceIMG')->getClientOriginalName() : null,
                'location' => $request->input('location'),
                'remarks' => $request->input('remarks'),
                'space_tag' => $request->spaceTag,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ]
        );

        if ($space->wasRecentlyCreated) {
            $space_id = $space->id;
            if ($request->hasFile('spaceIMG')) {
                $request->spaceIMG->store('space');
            } else {
                $space->space_img = null;
            }

            $amenity_id = $request->input('amenity_ids', []);
            $amenityIDs = [];
            if (!empty($amenity_id)) {
                foreach ($amenity_id as $uid) {
                    $amenityIDs[] = [
                        'amenity_id' => $uid,
                        'space_id' => $space_id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            } else {
                $amenityIDs[] = [
                    'amenity_id' => null,
                    'space_id' => $space_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            $mallCode = $request->mallCode;
            $spaceArea = $request->spacearea;
            $spaceTag = $request->spaceTag;
            $mall = SpaceMallCode::where('mallnum', $mallCode)->first();

            if (!$mall) {
                return redirect()->route('lease.space')->with('error', "Mall with code {$mallCode} not found.");
            }

            $newTotalArea = $mall->total_area + $spaceArea;

            if ($spaceTag == 1) {
                $mall->total_available += $spaceArea;
            }

            $mall->total_area = $newTotalArea;
            $mall->save();

            AmenitySelected::insert($amenityIDs);
            LeasableInfoModel::create([
                'space_id' => $space_id,
                'owner_id' => null,
                'proposal_id' => null,
                'status' => 0,
            ]);

            return redirect()->route('lease.space')->with('status', 'Space Added Successfully');
        } else {
            return redirect()->route('lease.space')->with('status', 'Space Already Added, or Unit Number Already Exists');
        }
    }

    public function leaseOptionSpace(Request $request, $option)
    {
        switch ($option) {
            case 'mall':
                return $this->leaseEditMall($request);

            case 'building':
                return $this->leaseEditBuilding($request);

            case 'level':
                return $this->leaseEditLevel($request);

            case 'submitMall':
                return $this->leaseSubmitMall($request);

            case 'submitBuilding':
                return $this->leaseSubmitBuilding($request);

            case 'submitLevel':
                return $this->leaseSubmitLevel($request);

            case 'editMall':
                return $this->leaseGetMall($request);

            case 'editBuilding':
                return $this->leaseGetBuilding($request);

            case 'editLevel':
                return $this->leaseGetLevel($request);

            default:
                break;
        }
    }

    public function leaseEditMall(Request $request)
    {
        $mallCode = SpaceMallCode::orderBy('id', 'asc')->get();
        return view('lease.space.mall', compact('mallCode'));
    }

    public function leaseEditBuilding(Request $request)
    {
        $mallCodes = SpaceMallCode::get();
        $buildingCode = SpaceBuilding::with(['mallcodes'])->orderBy('building_numbers.id', 'asc')->get();
        // dd($buildingCode); die();
        return view('lease.space.building', compact('buildingCode', 'mallCodes'));
    }

    public function leaseEditLevel(Request $request)
    {
        $mallCodes = SpaceMallCode::with(['buildingcodes'])->get();
        $levelCode = SpaceLevel::join('building_numbers', 'level_numbers.bldgnumid', '=', 'building_numbers.id')
            ->join('mall_codes', 'building_numbers.mallid', '=', 'mall_codes.id')
            ->select('mall_codes.mallnum', 'building_numbers.bldgnum', 'level_numbers.lvlnum', 'level_numbers.id as lvlnumid')
            ->get();
        return view('lease.space.level', compact('levelCode', 'mallCodes'));
    }

    public function leaseSubmitMall(Request $request)
    {
        $data = [
            'mallnum' => $request->mall_code,
            'mallname' => $request->mall_name,
            'malladdress' => $request->mall_address,
            'mallimage' => $request->mall_image ? $request->file('mall_image')->getClientOriginalName() : null,
            'mallfacility' => $request->mall_facility,
            'total_area' => $request->total_area,
            'total_available' => $request->total_available,
            'total_leased' => $request->total_leased
        ];
        $condition = ['id' => $request->mall_id];

        if ($request->hasFile('mall_image')) {
            $request->mall_image->storeAs('public/mall_images', $request->file('mall_image')->getClientOriginalName());
        }
        $mallcodes = SpaceMallCode::updateOrCreate($condition, $data);

        return redirect()->route('space.edit.mall', 'mall')->with('success', 'Mall Code Added Successfully');
    }

    public function leaseSubmitBuilding(Request $request)
    {
        $data = [
            'mallid' => $request->mallCode,
            'bldgnum' => $request->bldg_number,
            'bldgimage' => $request->bldg_image ? $request->file('bldg_image')->getClientOriginalName() : null,
        ];
        $condition = [
            'id' => $request->bldgid
        ];
        if ($request->hasFile('bldg_image')) {
            $request->bldg_image->storeAs('public/bldg_image', $request->file('bldg_image')->getClientOriginalName());
        }
        $buildingcodes = SpaceBuilding::updateOrCreate($condition, $data);
        return redirect()->route('space.edit.building', 'building')->with('success', 'Building Number Added Successfully');
    }

    public function leaseSubmitLevel(Request $request)
    {
        $data = [
            'bldgnumid' => $request->buildingNum,
            'lvlnum' => $request->lvlNum,
            'lvlimage' => $request->lvl_image ? $request->file('lvl_image')->getClientOriginalName() : null
        ];
        $conditions = [
            'id' => $request->lvlNumID
        ];
        if ($request->hasFile('lvl_image')) {
            $request->lvl_image->storeAs('public/lvl_image', $request->file('lvl_image')->getClientOriginalName());
        }
        SpaceLevel::updateOrCreate($conditions, $data);
        return redirect()->route('space.edit.level', 'level')->with('success', 'Level Number Added Successfully');
    }

    public function leaseGetMall(Request $request)
    {
        $mallcode = SpaceMallCode::findOrFail($request->mall_id);
        return response()->json($mallcode);
    }

    public function leaseGetBuilding(Request $request)
    {
        $bldgs = SpaceBuilding::with(['mallcodes'])->where('building_numbers.id', $request->buildingID)->get();
        return response()->json($bldgs);
    }

    public function leaseGetLevel(Request $request)
    {
        $levelCode = SpaceLevel::join('building_numbers', 'level_numbers.bldgnumid', '=', 'building_numbers.id')
            ->select('level_numbers.lvlnum', 'level_numbers.id as lvlnumid', 'building_numbers.mallid', 'building_numbers.id as bldgid')
            ->where('level_numbers.id', $request->levelID)
            ->get();
        $bldng_id = SpaceLevel::join('building_numbers', 'level_numbers.bldgnumid', '=', 'building_numbers.id')
            ->where('level_numbers.id', $request->levelID)
            ->pluck('building_numbers.id')
            ->first();
        $bldgs = SpaceBuilding::with(['mallcodes'])->where('building_numbers.id', $bldng_id)->get();
        return response()->json([
            'level' => $levelCode,
            'blding' => $bldgs
        ]);
    }

    public function leaseShowLevel(Request $request)
    {
        $bldgs = SpaceBuilding::where('mallid', $request->id)->get();
        return response()->json($bldgs);
    }

    public function leaseSpaceCodes(Request $request, $option)
    {
        switch ($option) {
            case 'mall':
                $mall = SpaceMallCode::find($request->id);
                if ($mall) {
                    $mall->delete();

                    $buildings = SpaceBuilding::where('mallid', $request->id)->get();
                    foreach ($buildings as $building) {
                        $building->delete();
                        SpaceLevel::where('bldgnumid', $building->id)->delete();
                    }
                }
                return response()->json(['success' => 'Mall and Related Buildings and Levels Deleted Successfully']);

            case 'building':
                $building = SpaceBuilding::find($request->id);
                if ($building) {
                    $building->delete();
                    SpaceLevel::where('bldgnumid', $building->id)->delete();
                }
                return response()->json(['success' => 'Building and Related Levels Deleted Successfully']);

            case 'level':
                SpaceLevel::where('id', $request->id)->delete();
                return response()->json(['success' => 'Level Deleted Successfully']);

            default:
                return response()->json(['error' => 'Invalid Option'], 400);
        }

    }
}
