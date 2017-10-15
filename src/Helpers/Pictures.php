<?php
namespace Decoweb\Panelpack\Helpers;

use Decoweb\Panelpack\Helpers\Contracts\PicturesContract;
use Decoweb\Panelpack\Models\Image;
use Decoweb\Panelpack\Models\SysCoreSetup;
class Pictures implements PicturesContract
{
    private $table_id;
    public function getPics($howMany = 0)
    {
        $howMany = (int)$howMany;
        //dd($this->table_id);
        if ($howMany > 0){
            $items = Image::where('table_id',$this->table_id)->orderBy('ordine')->take($howMany)->get();
        }else{
            $items = Image::where('table_id',$this->table_id)->orderBy('ordine')->get();
        }

        $pics = [];
        foreach ($items as $pic){
            $pics[$pic->record_id][] = $pic->name;
        }
        return $pics;
    }

    public function setModel($model)
    {
        $table = SysCoreSetup::select('id')->where('model',$model)->first();
        $this->table_id = (int)$table->id;
        return $this;
    }

    public function recordPics($recordId)
    {
        $recordId = (int)$recordId;
        $items = Image::where('table_id',$this->table_id)->where('record_id',$recordId)->orderBy('ordine')->get();
        $pics = [];
        foreach ($items as $pic){
            $pics[] = $pic->name;
        }
        return $pics;
    }
}