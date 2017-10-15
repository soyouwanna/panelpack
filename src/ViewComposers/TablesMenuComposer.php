<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\SysCoreSetup as Tables;

class TablesMenuComposer
{
    protected $tabele;
    protected $tablesMenu;

    public function __construct(Tables $tables)
    {
        $this->tabele = $tables->orderBy('order')->get();
        $this->toMenu();
    }

    private function toMenu()
    {
        $this->tablesMenu = "<div class=\"menu_section\"><h3>Pagini</h3><ul class=\"nav side-menu\">";
        foreach($this->tabele as $tabela){
            $this->tablesMenu .= "<li><a href=\"".url('admin/core/'.$tabela->table_name)."\"><i class=\"fa fa-angle-double-right\"></i> ".$tabela->name."</a></li>";
       }
        $this->tablesMenu .= "</ul></div>";
    }

    public function compose(View $view)
    {
        $view->with('tabele', $this->tablesMenu);
    }


}