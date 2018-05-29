<?php

namespace App\Http\Controllers\API\Translate;

use App\Http\Requests\API\CreateTranslateAPIRequest;
use App\Http\Requests\API\UpdateTranslateAPIRequest;
use App\Models\Translate;
use App\Repositories\TranslateRepository;
use App\Repositories\Criteria\DataTableCriteria;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class TranslateController
 * @package App\Http\Controllers
 */
class TranslateAPIController extends AppBaseController
{
    /** @var  TranslateRepository */
    private $translateRepository;

    public function __construct(TranslateRepository $translateRepo)
    {
        $this->translateRepository = $translateRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/translates",
     *      summary="Get a listing of the Translates.",
     *      tags={"Translate"},
     *      description="Get all Translates",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Translate")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        if ($request->has('draw')) {
            $this->translateRepository->pushCriteria(new DataTableCriteria($request));

            return $this->translateRepository->datatable();
        } else {
            $this->translateRepository->pushCriteria(new RequestCriteria($request));
            $this->translateRepository->pushCriteria(new LimitOffsetCriteria($request));
            $translates = $this->translateRepository->all();
        }

        return $this->sendResponse($translates->toArray(), 'Translates retrieved successfully');
    }

    /**
     * @param CreateTranslateAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/translates",
     *      summary="Store a newly created Translate in storage",
     *      tags={"Translate"},
     *      description="Store Translate",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Translate that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Translate")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Translate"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTranslateAPIRequest $request)
    {
        $input = $request->all();

        $translates = $this->translateRepository->create($input);

        return $this->sendResponse($translates->toArray(), 'Translate saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/translates/{id}",
     *      summary="Display the specified Translate",
     *      tags={"Translate"},
     *      description="Get Translate",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Translate",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Translate"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Translate $translate */
        $translate = $this->translateRepository->findWithoutFail($id);

        if (empty($translate)) {
            return $this->sendError('Translate not found');
        }

        return $this->sendResponse($translate->toArray(), 'Translate retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTranslateAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/translates/{id}",
     *      summary="Update the specified Translate in storage",
     *      tags={"Translate"},
     *      description="Update Translate",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Translate",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Translate that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Translate")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Translate"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTranslateAPIRequest $request)
    {
        $input = $request->all();

        /** @var Translate $translate */
        $translate = $this->translateRepository->findWithoutFail($id);

        if (empty($translate)) {
            return $this->sendError('Translate not found');
        }

        $translate = $this->translateRepository->update($input, $id);

        return $this->sendResponse($translate->toArray(), 'Translate updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/translates/{id}",
     *      summary="Remove the specified Translate from storage",
     *      tags={"Translate"},
     *      description="Delete Translate",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Translate",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Translate $translate */
        $translate = $this->translateRepository->findWithoutFail($id);

        if (empty($translate)) {
            return $this->sendError('Translate not found');
        }

        $translate->delete();

        return $this->sendResponse($id, 'Translate deleted successfully');
    }
}
