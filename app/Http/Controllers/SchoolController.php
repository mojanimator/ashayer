<?php

namespace App\Http\Controllers;

use App\Hooze;
use App\Madrese;
use App\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function hoozes()
    {
        return Hooze::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        if ($sale_tasis['min'] <= $sale_tasis['max'])
            $query = $query->whereBetween('sale_tasis', [$sale_tasis['min'], $sale_tasis['max']]);

        if ($tedad_daneshamooz['min'] <= $tedad_daneshamooz['max'])
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
        return view('schools');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
