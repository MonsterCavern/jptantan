<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBoketeAPIRequest;
use App\Http\Requests\API\UpdateBoketeAPIRequest;
use App\Models\Bokete;
use App\Repositories\BoketeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Criteria\RequestCriteria;
use Response;

/**
 * Class BoketeController
 * @package App\Http\Controllers\API
 */

class BoketeAPIController extends AppBaseController
{
    /** @var  BoketeRepository */
    private $boketeRepository;

    public function __construct(BoketeRepository $boketeRepo)
    {
        $this->boketeRepository = $boketeRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/boketes",
     *      summary="Get a listing of the Boketes.",
     *      operationId="index",
     *      tags={"Bokete"},
     *      description="Get all Boketes",
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
     *                  @OA\Items(ref="#/components/schemas/Bokete"),
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
        $this->boketeRepository->pushCriteria(new RequestCriteria($request));
        $boketes = $this->boketeRepository->paginate();

        return $this->sendPaginateResponse($boketes->toArray(), __('common.retrieved', ['attribute' => __('model.Bokete')]));
    }

    /**
     * @param CreateBoketeAPIRequest $request
     * @return Response
     *
     * @OA\Post(
     *      path="/boketes",
     *      summary="Store a newly created Bokete in storage",
     *      operationId="store",
     *      tags={"Bokete"},
     *      description="Store Bokete",
     *      @OA\RequestBody(
     *          request="Bokete",
     *          description="Bokete that should be stored",
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/Bokete")
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
     *                  ref="#/components/schemas/Bokete"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */

    public function store(CreateBoketeAPIRequest $request)
    {
        $input = $request->all();

        $boketes = $this->boketeRepository->create($input);

        return $this->sendResponse($boketes->toArray(), __('common.saved', ['attribute' => __('model.Bokete')]));
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/boketes/{id}",
     *      summary="Display the specified Bokete",
     *      operationId="show",
     *      tags={"Bokete"},
     *      description="Get Bokete",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="id of Bokete",
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
     *                  ref="#/components/schemas/Bokete"
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
        /** @var Bokete $bokete */
        $bokete = $this->boketeRepository->findWithoutFail($id);

        if (empty($bokete)) {
            return $this->sendError(__('error.ERR_NOT_FOUND', ['attribute' => __('model.Bokete')]));
        }

        return $this->sendResponse($bokete->toArray(), __('common.retrieved', ['attribute' => __('model.Bokete')]));
    }

    /**
     * @param int $id
     * @param UpdateBoketeAPIRequest $request
     * @return Response
     *
     * @OA\Put(
     *      path="/boketes/{id}",
     *      summary="Update the specified Bokete in storage",
     *      operationId="update",
     *      tags={"Bokete"},
     *      description="Update Bokete",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="id of Bokete",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int32"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          request="Bokete",
     *          description="Bokete that should be updated",
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/Bokete")
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
     *                  ref="#/components/schemas/Bokete"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */

    public function update($id, UpdateBoketeAPIRequest $request)
    {
        $input = $request->all();

        /** @var Bokete $bokete */
        $bokete = $this->boketeRepository->findWithoutFail($id);

        if (empty($bokete)) {
            return $this->sendError(__('error.ERR_NOT_FOUND', ['attribute' => __('model.Bokete')]));
        }

        $bokete = $this->boketeRepository->update($input, $id);

        return $this->sendResponse($bokete->toArray(), __('common.updated', ['attribute' => __('model.Bokete')]));
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/boketes/{id}",
     *      summary="Remove the specified Bokete from storage",
     *      operationId="destroy",
     *      tags={"Bokete"},
     *      description="Delete Bokete",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="id of Bokete",
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
        /** @var Bokete $bokete */
        $bokete = $this->boketeRepository->findWithoutFail($id);

        if (empty($bokete)) {
            return $this->sendError(__('error.ERR_NOT_FOUND', ['attribute' => __('model.Bokete')]));
        }

        $bokete->delete();

        return $this->sendResponse($id, __('common.deleted', ['attribute' => __('model.Bokete')]));
    }
}
