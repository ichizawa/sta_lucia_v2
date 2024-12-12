<?php

namespace App\Http\Controllers;

use App\Events\SpaceCreated;
use App\Models\Amenities;
use App\Models\AmenitySelected;
use App\Models\LeasableInfoModel;
use App\Models\SpaceBuilding;
use App\Models\SpaceLevel;
use App\Models\SpaceMallCode;
use App\Models\SpaceMallFacility;
use App\Models\SpacePaymentInformation;
use App\Models\SpaceUtility;
use App\Models\UtilitiesModel;
use Illuminate\Http\Request;
use App\Models\Space;
<<<<<<< HEAD
use Psy\Command\WhereamiCommand;
=======
use Illuminate\Support\Facades\Log;
>>>>>>> a9c2f5259a4308a09242058ddbb8b5554aa47f4f

class SpaceController extends Controller
{

    public function adminSpace()
    {
        $all = Space::where('space.status', 0)->join('leasable_space', 'space.id', '=', 'leasable_space.space_id')->orderBy('leasable_space.id', 'desc')->get();
        return view('admin.space.space', compact('all'));
    }

    public function adminAddSpace()
    {
        $utilities = UtilitiesModel::all();
        $amenities = Amenities::all();
        // $mallcode = SpaceMallCode::all();
        $mallcode = SpaceMallCode::where('status', 0)->get();
        $building = SpaceBuilding::all();
        $level = SpaceLevel::all();
        return view("admin.space.create-space", compact('utilities', 'amenities', 'mallcode', 'building', 'level'));
    }

    public function adminViewSpace(Request $request)
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

    public function updateSpace(Request $request)
    {
        $validated = $request->validate([
            'store_type' => 'required|string',
            'property_code' => 'required|string',
            'space_area' => 'required|numeric',
            'mall_code' => 'required|string',
            'bldg_number' => 'required|string',
            'unit_number' => 'required|string',
            'level_number' => 'required|string',
        ]);

        $space = Space::findOrFail($request->space_id);
        $space->update($validated);

        return response()->json(['message' => 'Space updated successfully']);
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
                return redirect()->route('admin.space')->with('error', "Mall with code {$mallCode} not found.");
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

            Log::info('Broadcasting space event', ['space' => $space]);

            event(new SpaceCreated($space));

            return redirect()->route('admin.space')->with('status', 'Space Added Successfully');
        } else {
            return redirect()->route('admin.space')->with('status', 'Space Already Added, or Unit Number Already Exists');
        }
    }

    // public function sumbmitSpace(Request $request)
    // {
    //     $existingSpace = Space::where('space_name', $request->spacename)
    //         ->where('unit_number', $request->unitnumber)
    //         ->where('status', 0) 
    //         ->first();

    //     if ($existingSpace) {
    //         return redirect()->route('admin.space')->with('status', 'Space with the same name and unit number already exists.');
    //     }

    //     $space = Space::create([
    //         'mall_code' => $request->mallCode,
    //         'bldg_number' => $request->bldgnumber,
    //         'level_number' => $request->levelNumber,
    //         'unit_number' => $request->unitnumber,
    //         'space_name' => $request->spacename,
    //         'space_area' => $request->spacearea,
    //         'store_type' => $request->storeType,
    //         'property_code' => $request->mallCode . $request->bldgnumber . $request->levelNumber . $request->unitnumber,
    //         'space_type' => $request->spaceType,
    //         'space_img' => $request->spaceIMG ? $request->file('spaceIMG')->getClientOriginalName() : null,
    //         'location' => $request->input('location'),
    //         'remarks' => $request->input('remarks'),
    //         'space_tag' => $request->spaceTag,
    //         'status' => 0, 
    //         'created_at' => NOW(),
    //         'updated_at' => NOW()
    //     ]);

    //     if ($space->wasRecentlyCreated) {
    //         if ($request->hasFile('spaceIMG')) {
    //             $request->spaceIMG->store('space');
    //         } else {
    //             $space->space_img = null;
    //         }

    //         $amenity_id = $request->input('amenity_ids', []);
    //         $amenityIDs = [];
    //         if (!empty($amenity_id)) {
    //             foreach ($amenity_id as $uid) {
    //                 $amenityIDs[] = [
    //                     'amenity_id' => $uid,
    //                     'space_id' => $space->id,
    //                     'created_at' => now(),
    //                     'updated_at' => now(),
    //                 ];
    //             }
    //         }

    //         $mallCode = $request->mallCode;
    //         $spaceArea = $request->spacearea;
    //         $spaceTag = $request->spaceTag;
    //         $mall = SpaceMallCode::where('mallnum', $mallCode)->first();

    //         if (!$mall) {
    //             return redirect()->route('admin.space')->with('error', "Mall with code {$mallCode} not found.");
    //         }

    //         $newTotalArea = $mall->total_area + $spaceArea;

    //         if ($spaceTag == 1) {
    //             $mall->total_available += $spaceArea;
    //         }

    //         $mall->total_area = $newTotalArea;
    //         $mall->save();

    //         AmenitySelected::insert($amenityIDs);
    //         LeasableInfoModel::create([
    //             'space_id' => $space->id,
    //             'owner_id' => null,
    //             'proposal_id' => null,
    //             'status' => 0,
    //         ]);

    //         return redirect()->route('admin.space')->with('status', 'Space Added Successfully');
    //     }

    //     return redirect()->route('admin.space')->with('status', 'An error occurred while adding the space.');
    // }

    public function adminOptionSpace(Request $request, $option)
    {
        switch ($option) {
            case 'mall':
                return $this->adminEditMall($request);

            case 'building':
                return $this->adminEditBuilding($request);

            case 'level':
                return $this->adminEditLevel($request);

            case 'submitMall':
                return $this->adminSubmitMall($request);

            case 'submitBuilding':
                return $this->adminSubmitBuilding($request);

            case 'submitLevel':
                return $this->adminSubmitLevel($request);

            case 'editMall':
                return $this->adminGetMall($request);

            case 'editBuilding':
                return $this->adminGetBuilding($request);

            case 'editLevel':
                return $this->adminGetLevel($request);

            default:
                break;
        }
    }

    public function adminEditMall(Request $request)
    {
        // $mallCode = SpaceMallCode::get();
        $mallCode = SpaceMallCode::where('status', 0)->get();

        return view('admin.space.mall', compact('mallCode'));
    }

    public function adminEditBuilding(Request $request)
    {
        $mallCodes = SpaceMallCode::where('status', 0)->get();
        $buildingCode = SpaceBuilding::with(['mallcodes'])->where('status', 0)->get();
        // dd($buildingCode); die();
        return view('admin.space.building', compact('buildingCode', 'mallCodes'));
    }

    public function adminEditLevel(Request $request)
    {
        $mallCodes = SpaceMallCode::with(['buildingcodes'])->get();

        $levelCode = SpaceLevel::join('building_numbers', 'level_numbers.bldgnumid', '=', 'building_numbers.id')
            ->join('mall_codes', 'building_numbers.mallid', '=', 'mall_codes.id')
            ->select('mall_codes.mallnum', 'building_numbers.bldgnum', 'level_numbers.lvlnum', 'level_numbers.id as lvlnumid')
            ->where('level_numbers.status', 0)
            ->get();
        return view('admin.space.level', compact('levelCode', 'mallCodes'));
    }

    public function adminSubmitMall(Request $request)
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

    public function adminSubmitBuilding(Request $request)
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

    public function adminSubmitLevel(Request $request)
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

    public function adminGetMall(Request $request)
    {
        // $mallcode = SpaceMallCode::findOrFail($request->mall_id);
        $mallcode = SpaceMallCode::where('id', $request->mall_id)->where('status', 0)->firstOrFail();
        return response()->json($mallcode);
    }

    public function adminGetBuilding(Request $request)
    {
        $bldgs = SpaceBuilding::with(['mallcodes'])->where('building_numbers.id', $request->buildingID)->where('status', 0)->get();
        return response()->json($bldgs);
    }

    public function adminGetLevel(Request $request)
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

    public function adminShowLevel(Request $request)
    {
        $bldgs = SpaceBuilding::where('mallid', $request->id)
            ->where('status', 0)
            ->get();
        return response()->json($bldgs);
    }

    public function adminSpaceCodes(Request $request, $option)
    {
        switch ($option) {
            case 'mall':
                // SpaceMallCode::where('id', $request->id)->delete();
                $mall = SpaceMallCode::find($request->id);

                if ($mall) {
                    $mall->status = 1;
                    $mall->save();

                    return response()->json(['message' => 'Mall successfully deleted']);
                } else {
                    return response()->json(['message' => 'Mall not found'], 404);
                }
                // return back()->with('success', 'Mall Code Deleted Successfully');
            case 'building':
                // SpaceBuilding::where('id', $request->id)->delete();
                $bldg = SpaceBuilding::find($request->id);

                if ($bldg) {
                    $bldg->status = 1;
                    $bldg->save();

                    return response()->json(['message' => 'Building successfully deleted']);
                } else {
                    return response()->json(['message' => 'Building not found'], 404);
                }
                // return back()->with('success', 'Building Code Deleted Successfully');
            case 'level':
                // SpaceLevel::where('id', $request->id)->delete();
                $lvl = SpaceLevel::find($request->id);

                if ($lvl) {
                    $lvl->status = 1;
                    $lvl->save();

                    return response()->json(['message' => 'Level successfully deleted']);
                } else {
                    return response()->json(['message' => 'Level not found'], 404);
                }
                // return back()->with('success', 'Level Code Deleted Successfully');
            case 'space':
                // SpaceLevel::where('id', $request->id)->delete();
                $spc = Space::find($request->id);

                if ($spc) {
                    $spc->status = 2;
                    $spc->save();

                    return response()->json(['message' => 'Space successfully deleted']);
                } else {
                    return response()->json(['message' => 'Space not found'], 404);
                }
                // return back()->with('success', 'Level Code Deleted Successfully');
            default:
        }
    }
}