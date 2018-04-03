<?php

namespace App\Http\Controllers;

use App\Data;
use Illuminate\Http\Request;
use Maatwebsite\ExcelLight\Excel;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = Data::where('year', 'like', "%{$request->year}%")
            ->Where('name', 'like', "%{$request->name}%")
            ->Where('house_no', 'like', "%{$request->house_no}%")
            ->Where('community_name', 'like', "%{$request->community_name}%")
            ->paginate(15);

        return view('data.index', compact('data'));
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Data::find($id);

        return view('data.edit', compact($data));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function initForm()
    {
        return view('data.init-form');
    }


    public function init(Request $request, Excel $exceler)
    {
        $this->validate($request, [
            'excel' => 'required|max:40960',
        ]);
        $excel = $request->file('excel');

        if (strtolower($excel->getClientOriginalExtension()) != 'xlsx') {
            return back()->withInput()->withErrors([
                'excel' => '文件格式错误',
            ]);
        }
        $excel = $excel->store('excels');

        $data = $exceler->load(storage_path('app/' . $excel));
        $i = 0;

        foreach ($data->sheets() as $key => $sheet) {
            if ($key == 1) {
                foreach ($sheet->rows() as $k => $row) {
                    if ($k == 1) {
                        if (collect(['入学年份', '业主姓名', '房号', '小区名称', '备注'])->diff($row->toArray())->count()) {
                            return back()->withInput()->withErrors([
                                'excel' => '文件第一行错误',
                            ]);
                        };
                    } else {

                        $find = Data::where([
                            'house_no'       => $row->房号,
                            'community_name' => $row->小区名称,
                        ])->first();

                        if ($find) {
                            return back()->withInput()->withErrors([
                                'excel' => "第{$k}行数据已存在(房号及小区),重复数据为{$find->toJson()}",
                            ]);
                        }
                        Data::create([
                            'year'           => $row->入学年份,
                            'name'           => $row->业主姓名,
                            'house_no'       => $row->房号,
                            'community_name' => $row->小区名称,
                            'remarks'        => $row->备注,
                        ]);
                        $i++;

                    }
                }
            }

        }

        return back()->withInput()->withErrors([
            'excel' => "新加成功,导入{$i}条数据"
        ]);
    }
}