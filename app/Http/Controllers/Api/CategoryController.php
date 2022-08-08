<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Resources\Api\Category as CategoryResource;
use App\Traits\Api\ResponsesTrait;
use App\Http\Requests\Api\CategoryRequest;
use \Exception;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use ResponsesTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::get();
        return $this->success(CategoryResource::collection($data), 'Date Retrieved Successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try{
            if (isset($request->validator) && $request->validator->fails()) {
                return $this->failed($request->validator->errors()->first());
            }

            $data = Category::create([
                'title' => $request->title
            ]);

            return $this->success(new CategoryResource($data), 'Saved done successfully');
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
            $data = Category::find($id);

            //if not date return
            if(!$data){
                return $this->failed('Data not found');
            }

            return $this->success(new CategoryResource($data), 'Date Retrieved Successfully');
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

            $data = Category::find($id);

            //if not date return
            if(!$data){
                return $this->failed('Data not found');
            }

            $data->title = $request->title;
            $data->save();

            return $this->success(new CategoryResource($data) , 'Updated done successfully');
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
            $data = Category::find($id);

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
