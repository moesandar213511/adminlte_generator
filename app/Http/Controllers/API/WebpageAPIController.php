<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateWebpageAPIRequest;
use App\Http\Requests\API\UpdateWebpageAPIRequest;
use App\Models\Webpage;
use App\Repositories\WebpageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class WebpageController
 * @package App\Http\Controllers\API
 */

class WebpageAPIController extends AppBaseController
{
    /** @var  WebpageRepository */
    private $webpageRepository;

    public function __construct(WebpageRepository $webpageRepo)
    {
        $this->webpageRepository = $webpageRepo;
    }

    /**
     * Display a listing of the Webpage.
     * GET|HEAD /webpages
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $webpages = $this->webpageRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($webpages->toArray(), 'Webpages retrieved successfully');
    }

    /**
     * Store a newly created Webpage in storage.
     * POST /webpages
     *
     * @param CreateWebpageAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateWebpageAPIRequest $request)
    {
        $input = $request->all();

        $webpage = $this->webpageRepository->create($input);

        return $this->sendResponse($webpage->toArray(), 'Webpage saved successfully');
    }

    /**
     * Display the specified Webpage.
     * GET|HEAD /webpages/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Webpage $webpage */
        $webpage = $this->webpageRepository->find($id);

        if (empty($webpage)) {
            return $this->sendError('Webpage not found');
        }

        return $this->sendResponse($webpage->toArray(), 'Webpage retrieved successfully');
    }

    /**
     * Update the specified Webpage in storage.
     * PUT/PATCH /webpages/{id}
     *
     * @param int $id
     * @param UpdateWebpageAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWebpageAPIRequest $request)
    {
        $input = $request->all();

        /** @var Webpage $webpage */
        $webpage = $this->webpageRepository->find($id);

        if (empty($webpage)) {
            return $this->sendError('Webpage not found');
        }

        $webpage = $this->webpageRepository->update($input, $id);

        return $this->sendResponse($webpage->toArray(), 'Webpage updated successfully');
    }

    /**
     * Remove the specified Webpage from storage.
     * DELETE /webpages/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Webpage $webpage */
        $webpage = $this->webpageRepository->find($id);

        if (empty($webpage)) {
            return $this->sendError('Webpage not found');
        }

        $webpage->delete();

        return $this->sendSuccess('Webpage deleted successfully');
    }
}
