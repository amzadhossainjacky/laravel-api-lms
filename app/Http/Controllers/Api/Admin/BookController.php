<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::table('books')->get();
        return response()->json($data, 200);
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
        $data = array();
        $data['bk_adminId'] = 1;
        $data['bk_category'] = $request->category;
        $data['bk_title'] = $request->title;
        $data['bk_author'] = $request->author;
        $data['bk_edition'] = $request->edition;
        $data['bk_publisher'] = $request->publisher;
        $data['bk_copies'] = $request->copies;
        $data['bk_cost'] = $request->cost;
        $data['bk_vendor'] = $request->vendor;

        //$data['bk_image'] = $request->category;

        $rules = [
            'category' => 'required|max:255',
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'edition' => 'required|numeric',
            'publisher' => 'required|max:255',
            'copies' => 'required|numeric',
            'cost' => 'required|numeric',
            'vendor' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        
        $date= date('Y.m.d');
        $image =str_replace('.','',$date) .time().'.'.$request->image->extension();
        $data['bk_image'] ='public/uploads/'.$image;
        $request->image->move(public_path('uploads'), $image);

        $save = DB::table('books')->insert($data);

        if(!is_null($save)) {
            return response()->json(['message'=>'Data saved.']);
        }
        else {
            return response()->json(['message_error'=>'Data not saved.']);
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
        $data = DB::table('books')->where('id', $id)->first();

        if($data){
            return response()->json($data, 200);
        }else{
            return response()->json(['message'=>'Data not found.']);
        }
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
        $data = DB::table('books')->where('id', $id)->first();
        
        if($data){
            return response()->json($data, 200);
        }else{
            return response()->json(['message'=>'Data not found.']);
        }
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
        $find = DB::table('books')->where('id', $id)->first();
        
        $data = array();
        $data['bk_adminId'] = 1;
        $data['bk_category'] = $request->category;
        $data['bk_title'] = $request->title;
        $data['bk_author'] = $request->author;
        $data['bk_edition'] = $request->edition;
        $data['bk_publisher'] = $request->publisher;
        $data['bk_copies'] = $request->copies;
        $data['bk_cost'] = $request->cost;
        $data['bk_vendor'] = $request->vendor;

        //$data['bk_image'] = $request->category;

        $rules = [
            'category' => 'required|max:255',
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'edition' => 'required|numeric',
            'publisher' => 'required|max:255',
            'copies' => 'required|numeric',
            'cost' => 'required|numeric',
            'vendor' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        if($find){
            if($request->has('image')){
                $old_image = $find->bk_image;
                unlink($old_image);
                $date= date('Y.m.d');
                $image =str_replace('.','',$date) .time().'.'.$request->image->extension();
                $data['bk_image'] ='public/uploads/'.$image;
                $request->image->move(public_path('uploads'), $image);

                $save = DB::table('books')->where('id', $id)->update($data);
                return response()->json(['message'=>'Data update.']);

            }else{
                $save = DB::table('books')->where('id', $id)->update($data);
                return response()->json(['message'=>'Data update.']);
            }
        }else{
            return response()->json(['message'=>'Data not found.']);
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
        //
        $data= DB::table('books')->where('id', $id)->first();

        if($data){
            unlink($data->bk_image);
            $delete = DB::table('books')->where('id', $id)->delete();
            return response()->json(['message'=>'Data delete successfully']);
        }else{
            return response()->json(['message'=>'Data not found.']);
        }
    }
}
