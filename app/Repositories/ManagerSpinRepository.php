<?php

namespace App\Repositories;

use App\Models\ManagerSpin;

class ManagerSpinRepository
{
    /**
     * Get member collection paginate.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */

    public function getAll()
    {
        return ManagerSpin::orderBy('created_at', 'desc');
    }

    public function getSpin($id)
    {
        return ManagerSpin::find($id);
    }

    public function create($request)
    {
        $count = ManagerSpin::count();
        if ($count < 15) {
            $spin = new ManagerSpin();
            $spin->name = $request->name;
            $spin->reward = str_replace(',','', $request->reward);
            $spin->rate = $request->rate;
            $spin->status = $request->status;
            $spin->save();

            return response()->json([
                'success' => true,
                'msg' => __('Add successfully')
            ]);
        }

        return response()->json([
            'success' => false,
            'msg' => __('Maximun data')
        ]);
    }

    public function update($request, $id)
    {
        $spin = ManagerSpin::find($id);
        $spin->name = $request->name;
        $spin->reward = str_replace(',','', $request->reward);
        $spin->rate = $request->rate;
        $spin->status = $request->status;
        $spin->save();
    }

    public function destroy($id)
    {
        return ManagerSpin::find($id)->delete();
    }
}
