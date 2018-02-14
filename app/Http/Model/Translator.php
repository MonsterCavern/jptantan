<?php
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *   type="object",
 *   required={"url","title","type"}
 * )
 */

class Translator extends Model {
    protected $table = 'translators';

    protected $primaryKey = 'id';



    /**
     * @SWG\Property(format="int64",example="10")
     * @var integer
     */
    public $id;

    /**
     * @SWG\Property(example="www.google.com")
     * @var string
     */
    public $url;

    /**
     * @SWG\Property(example="Google")
     * @var string
     */
    public $title;

    /**
     * @SWG\Property(example="web")
     * @var string
     */
    public $type;
}
