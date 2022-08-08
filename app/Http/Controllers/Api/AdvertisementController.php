<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Http\Resources\Api\Advertisement as AdvertisementResource;
use App\Traits\Api\ResponsesTrait;
use \Exception;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AdvertisementController extends Controller
{
    use ResponsesTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Advertisement::with(['categories', 'advertisers'])
                            ->where('start_date','<=',date('Y-m-d'))
                            ->get();

        return $this->success(AdvertisementResource::collection($data), 'Date Retrieved Successfully');
    }

    public function filter(Request $request)
    {
        $category_id = $request->category_id;
        $tag_id = $request->tag_id;

        $data = Advertisement::with(['categories', 'advertisers'])
                            ->where('start_date','<=',date('Y-m-d'))
                            ->when(request('category_id'), function ($query) use($category_id){
                                $query->where('category_id', $category_id);
                            })
                            ->when(request('tag_id'), function ($query) use($tag_id){
                                $query->whereJsonContains('tags', $tag_id);
                            })
                            ->get();

        return $this->success(AdvertisementResource::collection($data), 'Date Retrieved Successfully');
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
            $data = Advertisement::find($id);

            //if not date return 
            if(!$data){
                return $this->failed('Data not found');
            }

            return $this->success(new AdvertisementResource($data), 'Date Retrieved Successfully');
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
