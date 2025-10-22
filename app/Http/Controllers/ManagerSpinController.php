<?php

namespace App\Http\Controllers;

use App\Repositories\ManagerSpinRepository;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ManagerSpinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $repository;

    public function __construct(ManagerSpinRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        if (request()->ajax()) {
            $query = $this->repository->getAll();
           return DataTables::of($query)
                ->addColumn('action' , function($row){
                    $html = '<button type="button" data-href="'.route('manager-spins.edit',$row->id).'" class="btn btn-outline-info btn-not-radius modal-btn edit_reward btn-hover"><i class="fa fa-edit"></i></button>&nbsp;
                            <button type="button" data-href="'.route('manager-spins.destroy',$row->id).'" data-name="'.$row->name.'" class="btn btn-outline-danger btn-not-radius delete-btn delete_reward btn-hover" ><i class="fa fa-trash"></i></button>';
                    return $html;
                })
                ->editColumn('reward', '{{number_format($reward)}} ₫')
                ->editColumn('rate', '{{$rate}}%')
                ->editColumn('status', function($row){
                    if ($row->status == 'show') {
                        $html = '<span class="badge badge-success">Hiện</span>';
                    }else{
                        $html = '<span class="badge badge-secondary">Ẩn</span>';
                    }
                    return $html;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('manager_spin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('manager_spin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            return $this->repository->create($request);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => 'Đã xảy ra lỗi!'
            ]);
        }
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
        $spin = $this->repository->getSpin($id);
        return view('manager_spin.edit', compact('spin'));
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
        try {
            $this->repository->update($request, $id);
            return response()->json([
                'success' => true,
                'msg' => 'Cập nhật thành công'
            ]);
        }  catch (Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => 'Đã xảy ra lỗi!'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->destroy($id);
            return response()->json([
                'success' => true,
                'msg' => 'Xóa thành công'
            ]);
        }  catch (Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => 'Đã xảy ra lỗi!'
            ]);
        }
    }
}
