<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Http\Resources\Api\Tag as TagResource;
use App\Traits\Api\ResponsesTrait;
use App\Http\Requests\Api\TagRequest;
use \Exception;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    use ResponsesTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Tag::get();
        return $this->success(TagResource::collection($data), 'Date Retrieved Successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        try{
            if (isset($request->validator) && $request->validator->fails()) {
                return $this->failed($request->validator->errors()->first());
            }

            $data = Tag::create([
                'title' => $request->title
            ]);

            return $this->success(new TagResource($data), 'Saved done successfully');
        }catch(\Exception $e){
            return $this->failed($e->getMessage());
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
        try{
            $data = Tag::find($id);

            //if not date return
            if(!$data){
                return $this->failed('Data not found');
            }

            return $this->success(new TagResource($data), 'Date Retrieved Successfully');
        }catch(\Exception $e){
            return $this->failed($e->getMessage());
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
        try{
            if (isset($request->validator) && $request->validator->fails()) {
                return $this->failed($request->validator->errors()->first());
            }

            $data = Tag::find($id);

            //if not date return
            if(!$data){
                return $this->failed('Data not found');
            }

            $data->title = $request->title;
            $data->save();

            return $this->success(new TagResource($data) , 'Updated done successfully');
        }catch(\Exception $e){
            return $this->failed($e->getMessage());
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
        try{
            $data = Tag::find($id);

            //if not date return
            if(!$data){
                return $this->failed('Data not found');
            }
            
            $data->delete();

            return $this->success([], 'Deleted done successfully');
        }catch(\Exception $e){
            return $this->failed($e->getMessage());
        }
    }
}
