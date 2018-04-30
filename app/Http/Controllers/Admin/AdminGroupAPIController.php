<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\API\CreateAdminGroupAPIRequest;
use App\Http\Requests\API\UpdateAdminGroupAPIRequest;
use App\Models\AdminGroup;
use App\Repositories\AdminGroupRepository;
use App\Repositories\Criteria\DataTableCriteria;
use App\Repositories\Criteria\LimitPermsCriteria;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class AdminGroupController
 * @package App\Http\Controllers
 */

class AdminGroupAPIController extends AppBaseController
{
    /** @var  AdminGroupRepository */
    private $adminGroupRepository;

    public function __construct(AdminGroupRepository $adminGroupRepo)
    {
        $this->adminGroupRepository = $adminGroupRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/adminGroups",
     *      summary="Get a listing of the AdminGroups.",
     *      tags={"AdminGroup"},
     *      description="Get all AdminGroups",
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
     *                  @SWG\Items(ref="#/definitions/AdminGroup")
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
            $this->adminGroupRepository->pushCriteria(new DataTableCriteria($request));
            $this->adminGroupRepository->pushCriteria(new LimitPermsCriteria($request));
            return $this->adminGroupRepository->datatable();
        } else {
            $this->adminGroupRepository->pushCriteria(new RequestCriteria($request));
            $this->adminGroupRepository->pushCriteria(new LimitOffsetCriteria($request));
            $adminGroups = $this->adminGroupRepository->all();
        }

        return $this->sendResponse($adminGroups->toArray(), 'Admin Groups retrieved successfully');
    }

    /**
     * @param CreateAdminGroupAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/adminGroups",
     *      summary="Store a newly created AdminGroup in storage",
     *      tags={"AdminGroup"},
     *      description="Store AdminGroup",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="AdminGroup that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/AdminGroup")
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
     *                  ref="#/definitions/AdminGroup"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAdminGroupAPIRequest $request)
    {
        $input = $request->all();

        $adminGroups = $this->adminGroupRepository->create($input);

        return $this->sendResponse($adminGroups->toArray(), 'Admin Group saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/adminGroups/{id}",
     *      summary="Display the specified AdminGroup",
     *      tags={"AdminGroup"},
     *      description="Get AdminGroup",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of AdminGroup",
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
     *                  ref="#/definitions/AdminGroup"
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
        /** @var AdminGroup $adminGroup */
        $adminGroup = $this->adminGroupRepository->findWithoutFail($id);

        if (empty($adminGroup)) {
            return $this->sendError('Admin Group not found');
        }

        return $this->sendResponse($adminGroup->toArray(), 'Admin Group retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateAdminGroupAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/adminGroups/{id}",
     *      summary="Update the specified AdminGroup in storage",
     *      tags={"AdminGroup"},
     *      description="Update AdminGroup",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of AdminGroup",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="AdminGroup that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/AdminGroup")
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
     *                  ref="#/definitions/AdminGroup"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAdminGroupAPIRequest $request)
    {
        $input = $request->all();

        /** @var AdminGroup $adminGroup */
        $adminGroup = $this->adminGroupRepository->findWithoutFail($id);

        if (empty($adminGroup)) {
            return $this->sendError('Admin Group not found');
        }

        $adminGroup = $this->adminGroupRepository->update($input, $id);

        return $this->sendResponse($adminGroup->toArray(), 'AdminGroup updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/adminGroups/{id}",
     *      summary="Remove the specified AdminGroup from storage",
     *      tags={"AdminGroup"},
     *      description="Delete AdminGroup",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of AdminGroup",
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
        /** @var AdminGroup $adminGroup */
        $adminGroup = $this->adminGroupRepository->findWithoutFail($id);

        if (empty($adminGroup)) {
            return $this->sendError('Admin Group not found');
        }

        $adminGroup->delete();

        return $this->sendResponse($id, 'Admin Group deleted successfully');
    }
}
