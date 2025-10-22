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
        if ($count >= 15) {
            return response()->json([
                'success' => false,
                'msg' => 'Đã đạt giới hạn 15 phần thưởng'
            ]);
        }

        // Kiểm tra tổng tỷ lệ không vượt quá 100%
        $currentTotal = ManagerSpin::sum('rate');
        if ($currentTotal + $request->rate > 100) {
            return response()->json([
                'success' => false,
                'msg' => 'Tổng tỷ lệ trúng không được vượt quá 100%'
            ]);
        }

        $spin = new ManagerSpin();
        $spin->name = $request->name;
        $spin->reward = str_replace(',','', $request->reward);
        $spin->rate = $request->rate;
        $spin->status = $request->status;
        $spin->save();

        return response()->json([
            'success' => true,
            'msg' => 'Thêm phần thưởng thành công'
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
