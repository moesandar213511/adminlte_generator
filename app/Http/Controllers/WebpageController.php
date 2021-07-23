<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWebpageRequest;
use App\Http\Requests\UpdateWebpageRequest;
use App\Repositories\WebpageRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class WebpageController extends AppBaseController
{
    /** @var  WebpageRepository */
    private $webpageRepository;

    public function __construct(WebpageRepository $webpageRepo)
    {
        $this->webpageRepository = $webpageRepo;
    }

    /**
     * Display a listing of the Webpage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $webpages = $this->webpageRepository->all();

        return view('webpages.index')
            ->with('webpages', $webpages);
    }

    /**
     * Show the form for creating a new Webpage.
     *
     * @return Response
     */
    public function create()
    {
        return view('webpages.create');
    }

    /**
     * Store a newly created Webpage in storage.
     *
     * @param CreateWebpageRequest $request
     *
     * @return Response
     */
    public function store(CreateWebpageRequest $request)
    {
        $input = $request->all();

        $webpage = $this->webpageRepository->create($input);

        Flash::success('Webpage saved successfully.');

        return redirect(route('webpages.index'));
    }

    /**
     * Display the specified Webpage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $webpage = $this->webpageRepository->find($id);

        if (empty($webpage)) {
            Flash::error('Webpage not found');

            return redirect(route('webpages.index'));
        }

        return view('webpages.show')->with('webpage', $webpage);
    }

    /**
     * Show the form for editing the specified Webpage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $webpage = $this->webpageRepository->find($id);

        if (empty($webpage)) {
            Flash::error('Webpage not found');

            return redirect(route('webpages.index'));
        }

        return view('webpages.edit')->with('webpage', $webpage);
    }

    /**
     * Update the specified Webpage in storage.
     *
     * @param int $id
     * @param UpdateWebpageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWebpageRequest $request)
    {
        $webpage = $this->webpageRepository->find($id);

        if (empty($webpage)) {
            Flash::error('Webpage not found');

            return redirect(route('webpages.index'));
        }

        $webpage = $this->webpageRepository->update($request->all(), $id);

        Flash::success('Webpage updated successfully.');

        return redirect(route('webpages.index'));
    }

    /**
     * Remove the specified Webpage from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $webpage = $this->webpageRepository->find($id);

        if (empty($webpage)) {
            Flash::error('Webpage not found');

            return redirect(route('webpages.index'));
        }

        $this->webpageRepository->delete($id);

        Flash::success('Webpage deleted successfully.');

        return redirect(route('webpages.index'));
    }
}
