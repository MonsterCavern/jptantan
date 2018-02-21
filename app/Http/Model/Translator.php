<?php
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *   type="object",
 *   required={"url","title","type"}
 * )
 */

class Translator extends Model
{
    protected $table = 'translators';

    protected $primaryKey = 'id';


    /**
     * @SWG\Property(format="int64",example="10")
     * @var integer
     */
    protected $id;

    /**
     * @SWG\Property(example="www.google.com")
     * @var string
     */
    protected $url;

    /**
     * @SWG\Property(example="Google")
     * @var string
     */
    protected $title;

    /**
     * @SWG\Property(example="web")
     * @var string
     */
    protected $type;
}
