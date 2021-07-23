<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createads_webpageRequest;
use App\Http\Requests\Updateads_webpageRequest;
use App\Repositories\ads_webpageRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ads_webpageController extends AppBaseController
{
    /** @var  ads_webpageRepository */
    private $adsWebpageRepository;

    public function __construct(ads_webpageRepository $adsWebpageRepo)
    {
        $this->adsWebpageRepository = $adsWebpageRepo;
    }

    /**
     * Display a listing of the ads_webpage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $adsWebpages = $this->adsWebpageRepository->all();

        return view('ads_webpages.index')
            ->with('adsWebpages', $adsWebpages);
    }

    /**
     * Show the form for creating a new ads_webpage.
     *
     * @return Response
     */
    public function create()
    {
        return view('ads_webpages.create');
    }

    /**
     * Store a newly created ads_webpage in storage.
     *
     * @param Createads_webpageRequest $request
     *
     * @return Response
     */
    public function store(Createads_webpageRequest $request)
    {
        $input = $request->all();

        $adsWebpage = $this->adsWebpageRepository->create($input);

        Flash::success('Ads Webpage saved successfully.');

        return redirect(route('adsWebpages.index'));
    }

    /**
     * Display the specified ads_webpage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $adsWebpage = $this->adsWebpageRepository->find($id);

        if (empty($adsWebpage)) {
            Flash::error('Ads Webpage not found');

            return redirect(route('adsWebpages.index'));
        }

        return view('ads_webpages.show')->with('adsWebpage', $adsWebpage);
    }

    /**
     * Show the form for editing the specified ads_webpage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $adsWebpage = $this->adsWebpageRepository->find($id);

        if (empty($adsWebpage)) {
            Flash::error('Ads Webpage not found');

            return redirect(route('adsWebpages.index'));
        }

        return view('ads_webpages.edit')->with('adsWebpage', $adsWebpage);
    }

    /**
     * Update the specified ads_webpage in storage.
     *
     * @param int $id
     * @param Updateads_webpageRequest $request
     *
     * @return Response
     */
    public function update($id, Updateads_webpageRequest $request)
    {
        $adsWebpage = $this->adsWebpageRepository->find($id);

        if (empty($adsWebpage)) {
            Flash::error('Ads Webpage not found');

            return redirect(route('adsWebpages.index'));
        }

        $adsWebpage = $this->adsWebpageRepository->update($request->all(), $id);

        Flash::success('Ads Webpage updated successfully.');

        return redirect(route('adsWebpages.index'));
    }

    /**
     * Remove the specified ads_webpage from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $adsWebpage = $this->adsWebpageRepository->find($id);

        if (empty($adsWebpage)) {
            Flash::error('Ads Webpage not found');

            return redirect(route('adsWebpages.index'));
        }

        $this->adsWebpageRepository->delete($id);

        Flash::success('Ads Webpage deleted successfully.');

        return redirect(route('adsWebpages.index'));
    }
}
