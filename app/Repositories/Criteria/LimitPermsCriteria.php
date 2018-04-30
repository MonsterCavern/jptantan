<?php

namespace App\Repositories\Criteria;

use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
use Illuminate\Support\Facades\Auth;

use Schema;
use App\Utils\Util;
use App\Models\Vendor;

/**
 * Class LimitPermsCriteria.
 *
 * @package namespace App\Repositories\Criteria;
 */
class LimitPermsCriteria implements CriteriaInterface
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        if ($request->get('_guard')) {
            $this->guard = $request->get('_guard');
        } else {
            $this->guard = 'vendor';
        }
        if ($request->get('_user')) {
            $user = $request->get('_user');
        } else {
            $token = Util::getTokenForRequest($request);
            if ($token) {
                $token = Util::decryptToken($token);
                $user = Auth::guard($token[1])->user();
            }
        }
        $this->user = $user;
    }
  
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $user = $this->user;
        // get Model Columns
        $columns = Schema::getColumnListing($model->getModel()->table);
        
        if (in_array('admin_id', $columns)) {
            if ($this->guard === 'admin' && $user && $user->admin_type !== 9) {
                $admin_ids = $user->getAdminIDsOnSameGroup();
                $model = $model->whereIn('admin_id', $admin_ids);
            }
        }
        
        if (in_array('vendor_id', $columns)) {
            if ($this->guard === 'admin' && $user && $user->admin_type !== 9) {
                if (!isset($admin_ids)) {
                    $admin_ids = $user->getAdminIDsOnSameGroup($user);
                }
                $vendors = Vendor::whereIn('admin_id', $admin_ids)->get()->toArray();
                $vendor_ids = array_pluck($vendors, 'vendor_id');
                $model = $model->whereIn('vendor_id', $vendor_ids);
            }
            
            // Vendor 只能使用自身 ID
            if ($this->guard === 'vendor' && $user) {
                $model = $model->where('vendor_id', $user->vendor_id);
            }
        }

        return $model;
    }
}
