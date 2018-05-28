<?php

namespace App\Http\Controllers\API\Translate;

use App\Http\Requests\API\CreateBoketeAPIRequest;
use App\Http\Requests\API\UpdateBoketeAPIRequest;
use App\Models\Bokete;
use App\Repositories\BoketeRepository;
use App\Repositories\Criteria\DataTableCriteria;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class BoketeController
 * @package App\Http\Controllers
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
     * @SWG\Get(
     *      path="/boketes",
     *      summary="Get a listing of the Boketes.",
     *      tags={"Bokete"},
     *      description="Get all Boketes",
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
     *                  @SWG\Items(ref="#/definitions/Bokete")
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
            $this->boketeRepository->pushCriteria(new DataTableCriteria($request));

            return $this->boketeRepository->datatable();
        } else {
            $this->boketeRepository->pushCriteria(new RequestCriteria($request));
            $this->boketeRepository->pushCriteria(new LimitOffsetCriteria($request));
            $boketes = $this->boketeRepository->all();
        }

        return $this->sendResponse($boketes->toArray(), 'Boketes retrieved successfully');
    }

    /**
     * @param CreateBoketeAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/boketes",
     *      summary="Store a newly created Bokete in storage",
     *      tags={"Bokete"},
     *      description="Store Bokete",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Bokete that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Bokete")
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
     *                  ref="#/definitions/Bokete"
     *              ),
     *              @SWG\Property(
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

        return $this->sendResponse($boketes->toArray(), 'Bokete saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/boketes/{id}",
     *      summary="Display the specified Bokete",
     *      tags={"Bokete"},
     *      description="Get Bokete",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Bokete",
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
     *                  ref="#/definitions/Bokete"
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
        /** @var Bokete $bokete */
        $bokete = $this->boketeRepository->findWithoutFail($id);

        if (empty($bokete)) {
            return $this->sendError('Bokete not found');
        }

        return $this->sendResponse($bokete->toArray(), 'Bokete retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBoketeAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/boketes/{id}",
     *      summary="Update the specified Bokete in storage",
     *      tags={"Bokete"},
     *      description="Update Bokete",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Bokete",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Bokete that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Bokete")
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
     *                  ref="#/definitions/Bokete"
     *              ),
     *              @SWG\Property(
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
            return $this->sendError('Bokete not found');
        }

        $bokete = $this->boketeRepository->update($input, $id);

        return $this->sendResponse($bokete->toArray(), 'Bokete updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/boketes/{id}",
     *      summary="Remove the specified Bokete from storage",
     *      tags={"Bokete"},
     *      description="Delete Bokete",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Bokete",
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
        /** @var Bokete $bokete */
        $bokete = $this->boketeRepository->findWithoutFail($id);

        if (empty($bokete)) {
            return $this->sendError('Bokete not found');
        }

        $bokete->delete();

        return $this->sendResponse($id, 'Bokete deleted successfully');
    }
}
