<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Advertiser;
use App\Models\Advertisement;
use App\Http\Resources\Api\Advertiser as AdvertiserResource;
use App\Traits\Api\ResponsesTrait;
use \Exception;

class AdvertiserController extends Controller
{
    use ResponsesTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Advertiser::with(['advertisements.categories'])->get();
        return $this->success(AdvertiserResource::collection($data), 'Date Retrieved Successfully');
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
        try{
            $data = Advertiser::find($id);

            //if not date return
            if(!$data){
                return $this->failed('Data not found');
            }

            return $this->success(new AdvertiserResource($data), 'Date Retrieved Successfully');
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
}
