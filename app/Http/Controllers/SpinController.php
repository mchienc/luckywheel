<?php

namespace App\Http\Controllers;

use App\Repositories\SpinRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SpinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $repository;

    public function __construct(SpinRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $date =  date('Y-m-d');
        $first_day = date('Y-m-01', strtotime($date));
        $last_day = date('Y-m-t', strtotime($date));
        if (request()->ajax()) {
            $query = $this->repository->getAll();
            if (!empty($request->start_date) && !empty($request->end_date)) {
                $start = $request->start_date;
                $end =  $request->end_date;
                $query->whereDate('spins.created_at', '>=', $start)
                        ->whereDate('spins.created_at', '<=', $end);
            }
            return DataTables::of($query)
                ->editColumn('created_at', function($row){
                    return $this->repository->timeAgo($row->created_at);
                })
                ->rawColumns(['reward'])
                ->make(true);
        }
        $spin_name = [];
        $spins = $this->repository->getSpin();
        foreach ($spins as $spin) {
            $spin_name[] = $spin->name;
        }
        return view('spin', compact('spin_name', 'first_day', 'last_day'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function postSpin(Request $request)
    {
        $spins = $this->repository->getSpin();
        if (count($spins) == 0) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Không tồn tại giải thưởng'
            ]);
        }

        $label = [];
        $rate = [];
        $reward = [];
        foreach ($spins as $spin) {
            $label[] = 'Xin chúc mừng, bạn đã nhận được giải thưởng' .' ('.$spin->name.')';
            $rate[] = $spin->rate;
            $reward[] = $spin->reward;
        }

        $out = $this->repository->getRandomWeightedElement($rate);
        $this->repository->store($label[$out]);

        return response()->json([
            'status' => 'success',
            'location' => $out + 1,
            'msg' => $label[$out]
        ]);
    }
}
