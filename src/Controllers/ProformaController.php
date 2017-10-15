<?php

namespace Decoweb\Panelpack\Controllers;

use App\Http\Controllers\Controller;
use Decoweb\Panelpack\Models\Order;
use Decoweb\Panelpack\Models\Ordereditem;
use Decoweb\Panelpack\Models\Invoice;
use Decoweb\Panelpack\Models\Proforma;
class ProformaController extends Controller
{
    private $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice->first();
    }

    public function index($id,$code)
    {
        $proforma = Proforma::where('order_id', (int)$id)->first();
        if( $proforma->code !== $code){
            return 'Proforma gresita!';
        }
        $order = Order::find((int)$id);
        $items = Ordereditem::where('order_id', $order->id)->get()->toArray();

        $itemsNoVAT = 0;
        $itemsVAT = 0;
        foreach( $items as &$item ){
            // PretFaraTVA = PretCuTVA / (1+(CotaTVA/100)
            $item['priceNoVAT'] = round( $item['price'] / (1 + ($this->invoice->tva/100)), 2 );
            $item['VAT'] = ($item['price'] - $item['priceNoVAT']) * $item['quantity'];
            $itemsNoVAT += $item['priceNoVAT'] * $item['quantity'];
            $itemsVAT += $item['VAT'];
            //echo $itemsNoVAT.' - ';

        }
        //dd($items);
        $transportNoVAT = number_format(round( $order->price_transport / (1 + ($this->invoice->tva/100)), 2 ),2);
        $transportVAT = number_format($order->price_transport - $transportNoVAT,2);
        $itemsNoVAT += $transportNoVAT;
        $itemsVAT += $transportVAT;
        return view('admin.shop.invoice.proforma',[
            'invoice'           => $this->invoice,
            'order'             => $order,
            'items'             => $items,
            'itemsNoVAT'        => $itemsNoVAT,
            'itemsVAT'          => $itemsVAT,
            'transportNoVAT'    => $transportNoVAT,
            'transportVAT'      => $transportVAT,
        ]);
    }
}
