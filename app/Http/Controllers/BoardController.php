<?php

namespace App\Http\Controllers;

use App\Board;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BoardController extends Controller
{
    public function index()
    {
        $request = request();
        $inputs = $request->input();
        $validator = Validator::make($inputs,[
            'sField'=>'nullable|max:10',
            'sWord'=>'nullable|max:20'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        };

        try{
            if(isset($inputs['sField']) && $inputs['sField'] && isset($inputs['sWord'])){
                $sField = $inputs['sField'];
                $sWord = $inputs['sWord'];
                $rows = Board::orderBy('id', 'desc')->where($sField, 'like', '%'.$sWord.'%')->paginate(5);
            }else{
                $rows = Board::orderBy('id', 'desc')->paginate(5);
            }
        }catch(\Throwable $th){
            logger()->error($th);

            return redirect()->back()->witherrors('잘못된 접근입니다.');
        }

        return view('board.index', ['rows'=>$rows]);
    }

    public function create()
    {
        return view('board.create');
    }

    public function store()
    {

        $request = request();
        $inputs = $request->input();
        $validator = Validator::make($inputs,[
            'title'=>'required|max:70',
            'writer'=>'required|max:30',
            'comment'=>'required|max:255',
            'board_date'=>'required'
        ]);


        if($validator->fails()){
            return redirect('board/create')->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            if(isset($inputs['id'])){
                $board = Board::find($inputs['id']);
            }else{
                $board = new Board;
            }

            if(!$board){
                throw new \Exception('오류가 발생했습니다.');
            }

            $board->writer = $request->writer;
            $board->title = $request->title;
            $board->comment = $request->comment;
            $board->board_date = $request->board_date;
            $result = $board->save();

            if(!$result){
                throw new \Exception('오류가 발생했습니다.');
            }

            DB::commit();

            return redirect('/board');
        }  catch(\Throwable $th) {
            logger($th->getMessage());
            logger()->error($th);

            DB::rollBack();
            return redirect()->back()->witherrors('저장되지 않았습니다. 다시 시도해주세요.');
        }
    }

    public function show($row)
    {
        $query = Board::where('id', $row);

        $query->increment('board_view');
        $rows = $query->first();

        if(!$rows){
            return redirect()->back()->witherrors('잘못된 접근입니다.');
        }

        return view('board.show', ['rows'=>$rows]);
    }

    public function edit($row)
    {
        $rows = Board::where('id', $row)->first();

        if(!$rows){
            return redirect()->back()->witherrors( '잘못된 접근입니다.');
        }

        return view('board.edit', ['rows'=>$rows]);
    }

    public function destroy($row)
    {
        $request = request();
        $inputs = $request->input();
        $validator = Validator::make($inputs,[
            'title'=>'required|max:70',
            'writer'=>'required|max:30',
            'comment'=>'required|max:255',
            'board_date'=>'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{
            DB::beginTransaction();

            $result = Board::where('id',$row)->delete();

            if(!$result){
                throw new \Exception('오류가 발생했습니다.');
            }

            DB::commit();

            return redirect('/board');
        }catch(\Throwable $th){
            logger($th->getMessage());
            logger()->error($th);

            DB::rollBack();

            return redirect()->back()->witherrors('삭제되지 않았습니다. 다시 시도해주세요.');
        }
    }
}

