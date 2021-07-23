<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdsRequest;
use App\Http\Requests\UpdateAdsRequest;
use App\Repositories\AdsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\Webpage;
use App\Models\Ads;
use App\Models\ads_webpage;
use App\CustomClass\AdsData;

class AdsController extends AppBaseController
{
    /** @var  AdsRepository */
    private $adsRepository;

    public function __construct(AdsRepository $adsRepo)
    {
        $this->adsRepository = $adsRepo;
    }

    /**
     * Display a listing of the Ads.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $ads = $this->adsRepository->all();

        $webpage_arr = [];
        foreach ($ads as $data) {
            $obj = new AdsData($data->id);
            array_push($webpage_arr, $obj->getAdsData());
        }

        return view('ads.index',compact('webpage_arr'))
            ->with('ads', $ads);
    }

    /**
     * Show the form for creating a new Ads.
     *
     * @return Response
     */
    public function create()
    {
        $webpages = Webpage::all();
        return view('ads.create',compact('webpages'));
    }

    /**
     * Store a newly created Ads in storage.
     *
     * @param CreateAdsRequest $request
     *
     * @return Response
     */
    public function store(CreateAdsRequest $request)
    {
        $input = $request->all();

        // $ads = $this->adsRepository->create($input);
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoname = uniqid() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path() . '/upload/ads/', $photoname);
            $webpages = $request->get('webpage');
            $name = $request->get('name');

            $ads_id = Ads::create([
                'photo' => $photoname,
                'name' => $name,
            ])->id;

            foreach ($webpages as $webpage) {
                ads_webpage::create([
                    'ads_id' => $ads_id,
                    'webpage_id' => $webpage
                ]);
            }

           // return $webpages;
        }

        Flash::success('Ads saved successfully.');

        return redirect(route('ads.index'));
    }

    /**
     * Display the specified Ads.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $ads = $this->adsRepository->find($id);

        if (empty($ads)) {
            Flash::error('Ads not found');

            return redirect(route('ads.index'));
        }

        return view('ads.show')->with('ads', $ads);
    }

    /**
     * Show the form for editing the specified Ads.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $ads = $this->adsRepository->find($id);

        $webpages = Webpage::all();

        $ads_obj = new AdsData($id);
        $edit_ads = $ads_obj->getAdsData();
        // return $edit_ads;

        if (empty($ads)) {
            Flash::error('Ads not found');

            return redirect(route('ads.index'));
        }

        return view('ads.edit',compact('webpages','edit_ads'))->with('ads', $ads);
    }

    /**
     * Update the specified Ads in storage.
     *
     * @param int $id
     * @param UpdateAdsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAdsRequest $request)
    {
        $ads = $this->adsRepository->find($id);

        if (empty($ads)) {
            Flash::error('Ads not found');

            return redirect(route('ads.index'));
        }

        $ads = $this->adsRepository->update($request->all(), $id);

        Flash::success('Ads updated successfully.');

        return redirect(route('ads.index'));
    }

    /**
     * Remove the specified Ads from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ads = $this->adsRepository->find($id);

        $ads = Ads::find($id);
        $image_path = public_path() . '/upload/ads/' . $ads->photo;
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $ads->delete();
        $adsweb = ads_webpage::where('ads_id', $id)->get();
        foreach ($adsweb as $data) {
            $data->delete();
        }

        if (empty($ads)) {
            Flash::error('Ads not found');

            return redirect(route('ads.index'));
        }

        // $this->adsRepository->delete($id);

        Flash::success('Ads deleted successfully.');

        return redirect(route('ads.index'));
    }
}
