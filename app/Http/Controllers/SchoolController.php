<?php

namespace App\Http\Controllers;

use App\Doc;
use App\Hooze;
use App\Http\Requests\SchoolRequest;
use App\Koochro;
use App\Madrese;
use App\Saabet;
use App\School;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchoolController extends Controller
{
    public function hoozes()
    {
        return Hooze::all();
    }

    public function dropdown(Request $request)
    {
        $hooze_namayandegi_id = $request->hooze_namayandegi_id;
        $command = $request->command;
        $name = $request->name;

        if (!$name)
            return ['data' => School::get(['id', 'name'])];
        if ($command == 'get')
            if ($hooze_namayandegi_id)
                return ['data' => School::get(['id', 'name'])->whereIn('hooze_namayandegi_id', $hooze_namayandegi_id)];
            else return ['data' => School::get(['id', 'name'])];
        else
            if ($command == 'add')
                if ($hooze_namayandegi_id)
                    if (School:: where('name', $name)->whereIn('hooze_namayandegi_id', $hooze_namayandegi_id)->exists()) {
                        return ['data' => School::get(['id', 'name'])->whereIn('hooze_namayandegi_id', $hooze_namayandegi_id),
                            'message' => 'نام مدرسه تکراری است', 'type' => 'error'];
                    } else {
                        $school = new School();
                        $school->name = $name;
                        $school->save();
                        return ['data' => School::get(['id', 'name'])->whereIn('hooze_namayandegi_id', $hooze_namayandegi_id),
                            'message' => 'مدرسه با موفقیت اضافه شد!', 'type' => 'success'
                        ];
                    }
                else {
                    if (School:: where('name', $name)->exists()) {
                        return ['data' => School::get(['id', 'name']),
                            'message' => 'نام مدرسه تکراری است', 'type' => 'error'];
                    } else {
                        $school = new School();
                        $school->name = $name;
                        $school->save();
                        return ['data' => School::get(['id', 'name']),
                            'message' => 'مدرسه با موفقیت اضافه شد!', 'type' => 'success'
                        ];
                    }
                }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function all(Request $request)
    {
        $paginate = $request->paginate;
        $page = $request->page;
        if (!$paginate) {
            $paginate = 24;
        }
        if (!$page) {
            $page = 1;
        }
        return School::with('hooze')->with('schoolable')->paginate($paginate, ['*'], 'page', $page);
    }

    public function search(Request $request)
    {

        $ids = $request->ids;
        $paginate = $request->paginate;
        $page = $request->page;
        $sortBy = $request->sortBy;
        $direction = $request->direction;
        if (count($ids) != 0) {
            if ($sortBy && $direction)
                return School::whereIn('id', $ids)->with('docs')->with('hooze')->with('schoolable')->orderBy($sortBy, $direction)->paginate($paginate, ['*'], 'page', $page);
            return School::whereIn('id', $ids)->with('docs')->with('hooze')->with('schoolable')->paginate($paginate, ['*'], 'page', $page);

        }
        $name = $request->name;

        $schoolable = $request->schoolable; //sabet koochro
        $is_roozane = $request->is_roozane;
        $jensiat = $request->jensiat;
        $doore = $request->doore;
        $vaziat = $request->vaziat;
        $noe_fazaye_amoozeshi = $request->noe_fazaye_amoozeshi;
        $hooze_namayandegi_id = $request->hooze_namayandegi_id;

        $sale_tasis = $request->sale_tasis;
        $tedad_daneshamooz = $request->tedad_daneshamooz;

//        return $request;
        if (!$paginate) {
            $paginate = 24;
        }
        if (!$page) {
            $page = 1;
        }

        $query = School::query();

        if ($name != '')
            $query = $query->where('name', 'like', '%' . $name . '%');
        if ($schoolable != '')
            $query = $query->where('schoolable_type', $schoolable);
        if ($is_roozane != '')
            $query = $query->where('is_roozane', $is_roozane);
        if ($jensiat != '')
            $query = $query->where('jensiat', $jensiat);
        if ($doore != '')
            $query = $query->where('doore', 'like', $doore);

        if (count($noe_fazaye_amoozeshi) != 0)
            $query = $query->whereIn('noe_fazaye_amoozeshi', $noe_fazaye_amoozeshi);
        if (count($hooze_namayandegi_id) != 0)
            $query = $query->whereIn('hooze_namayandegi_id', $hooze_namayandegi_id);
        if (($sale_tasis['min'] != 1300 || $sale_tasis['max'] != 1500) && $sale_tasis['min'] <= $sale_tasis['max'])
            $query = $query->whereBetween('sale_tasis', [$sale_tasis['min'], $sale_tasis['max']]);

        if (($tedad_daneshamooz['min'] != 0 || $tedad_daneshamooz['max'] != 1000) && $tedad_daneshamooz['min'] <= $tedad_daneshamooz['max'])
            $query = $query->whereBetween('tedad_daneshamooz', [$tedad_daneshamooz['min'], $tedad_daneshamooz['max']]);

        if (count($vaziat) != 0)
            $query = $query->where(function ($query) use ($vaziat) {
                $query = $query->where('vaziat', 'like', $vaziat[0] . '%');
                for ($i = 1; $i < count($vaziat); $i++)
                    $query = $query->orWhere('vaziat', 'like', $vaziat[$i] . '%');

            });

        if ($sortBy && $direction)
            $query = $query->orderBy($sortBy, $direction);

        return $query->with('docs')->with('hooze')->with('schoolable')->paginate($paginate, ['*'], 'page', $page);

    }

    public function view()
    {
        return view('school.schools');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(SchoolRequest $request)
    {


        DB::transaction(function () use ($request) {
            $date = Carbon::now();
            $schoolable_type = "";
            $schoolable = ['id' => 0];
            if ($request->schoolable_type == "App\\Saabet") {
                $schoolable = Saabet::create([
                    'address' => $request->loc1['address'],
                    'loc' => $request->loc1['pos'],
                    'fasele_az_shahrestan' => $request->loc1['fasele_az_shahrestan'],
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
                $schoolable_type = "App\\Saabet";

            } elseif ($request->schoolable_type == "App\\Koochro") {
                $schoolable = Koochro::create([
                    'address_yeylagh' => $request->loc1['address'],
                    'loc_yeylagh' => $request->loc1['pos'],
                    'fasele_az_shahrestan_yeylagh' => $request->loc1['fasele_az_shahrestan'],
                    'address_gheshlagh' => $request->loc2['address'],
                    'loc_gheshlagh' => $request->loc2['pos'],
                    'fasele_az_shahrestan_gheshlagh' => $request->loc2['fasele_az_shahrestan'],
                    'type' => $request->loc2['koochro_type'],
                    'masire_kooch' => $request->loc2['masire_kooch'],
                    'masafate_kooch' => $request->loc2['masafate_kooch'],
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
                $schoolable_type = "App\\Koochro";
            }


            $school = School::create([
//            'from_id' => auth()->user()->id,
                'schoolable_id' => $schoolable->id,
                'schoolable_type' => $schoolable_type,
                'is_roozane' => $request->is_roozane,
                'name' => $request->sName,
                'code_madrese' => $request->code_madrese,
                'code_faza' => $request->code_faza,
                'sale_tasis' => $request->sale_tasis,
                'doore' => $request->doore,
                'tedad_daneshamooz' => $request->tedad_daneshamooz,
                'vaziat' => $request->vaziat,
                'jensiat' => $request->jensiat,
                'tedad_paye_tahsili' => $request->tedad_paye_tahsili,
                'tedad_hamkaran' => $request->tedad_hamkaran,
                'noe_fazaye_amoozeshi' => $request->noe_fazaye_amoozeshi,
                'hooze_namayandegi_id' => $request->hooze_namayandegi_id,
                'created_at' => $date,
                'updated_at' => $date,

            ]);
            // add school docs
            foreach ($request->input('docs') as $d) {
                $doc = Doc::getFile($d, $school->id, School::class, 'school');
                //save doc to   folder and database
                $doc->upload();
                $doc->saveToDocsDB();

            }

        });


        return "200";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Madrese $madrese
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Madrese $madrese
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Madrese $madrese
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Madrese $madrese
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        //
    }
}
