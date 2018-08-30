<?php

namespace App\Http\Swaggers\Sample;

use App\Http\Requests\API\CreateTranslateAPIRequest;
use App\Http\Requests\API\UpdateTranslateAPIRequest;
use App\Models\Translate;
use App\Repositories\TranslateRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Criteria\RequestCriteria;
use Response;

/**
 * Class TranslateController
 * @package App\Http\Controllers\API
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
     * @OA\Get(
     *      path="/translates",
     *      summary="Get a listing of the Translates.",
     *      operationId="index",
     *      tags={"Translate"},
     *      description="Get all Translates",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/Translate"),
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->translateRepository->pushCriteria(new RequestCriteria($request));
        $translates = $this->translateRepository->paginate();

        return $this->sendPaginateResponse($translates->toArray(), __('common.retrieved', ['name' => __('model.Translate')]));
    }

    /**
     * @param CreateTranslateAPIRequest $request
     * @return Response
     *
     * @OA\Post(
     *      path="/translates",
     *      summary="Store a newly created Translate in storage",
     *      operationId="store",
     *      tags={"Translate"},
     *      description="Store Translate",
     *      @OA\RequestBody(
     *          request="Translate",
     *          description="Translate that should be stored",
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/Translate")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/Translate"
     *              ),
     *              @OA\Property(
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

        return $this->sendResponse($translates->toArray(), __('common.saved', ['name' => __('model.Translate')]));
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/translates/{id}",
     *      summary="Display the specified Translate",
     *      operationId="show",
     *      tags={"Translate"},
     *      description="Get Translate",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="id of Translate",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int32"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/Translate"
     *              ),
     *              @OA\Property(
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
            return $this->sendError(__('error.ERR_NOT_FOUND', ['name' => __('model.Translate')]));
        }

        return $this->sendResponse($translate->toArray(), __('common.retrieved', ['name' => __('model.Translate')]));
    }

    /**
     * @param int $id
     * @param UpdateTranslateAPIRequest $request
     * @return Response
     *
     * @OA\Put(
     *      path="/translates/{id}",
     *      summary="Update the specified Translate in storage",
     *      operationId="update",
     *      tags={"Translate"},
     *      description="Update Translate",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="id of Translate",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int32"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          request="Translate",
     *          description="Translate that should be updated",
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/Translate")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/Translate"
     *              ),
     *              @OA\Property(
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
            return $this->sendError(__('error.ERR_NOT_FOUND', ['name' => __('model.Translate')]));
        }

        $translate = $this->translateRepository->update($input, $id);

        return $this->sendResponse($translate->toArray(), __('common.updated', ['name' => __('model.Translate')]));
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/translates/{id}",
     *      summary="Remove the specified Translate from storage",
     *      operationId="destroy",
     *      tags={"Translate"},
     *      description="Delete Translate",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="id of Translate",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int32"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @OA\Property(
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
            return $this->sendError(__('error.ERR_NOT_FOUND', ['name' => __('model.Translate')]));
        }

        $translate->delete();

        return $this->sendResponse($id, __('common.deleted', ['name' => __('model.Translate')]));
    }
}
