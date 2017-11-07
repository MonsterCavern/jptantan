<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Novel extends Model {
    //
    protected $table = 'novels';
    
    public $lang = 'jp';
    
    public function setIntro($title, $intro) {
        $lang = $this->lang;
        $intros[$lang] = [
            'title' => $title,
            'intro' => $intro
        ];
        $this->intro = Json::Encode($intros);
        // return $this->intro;
    }
    public function setCapters($capters) {
        $this->intro = Json::Encode($capters);
    }
}
