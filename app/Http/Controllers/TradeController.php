<?php

namespace App\Http\Controllers;

use App\Models\Trade;
use Illuminate\Http\Request;

class TradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $trade = new Trade();
        $trade->quantity = $request->quantity;
        $trade->price = $request->price;
        $trade->stock_id = $request->stock_id;
        $trade->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function show(Trade $trade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function edit(Trade $trade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trade $trade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trade $trade)
    {
        //
    }
    public  function populateTrades(Request $request){
        $trade = new Trade();
            for ($i=0; $i <rand(1000,2000) ; $i++) {    
                $trade = new Trade();        
            $trade->quantity = rand (1*1000, 100*1000) / 1000;
            $trade->price = rand (1*10000000, 1000*10000000) / 10000000;
            $trade->stock_id = $request->stocks;
            $trade->created_at = TradeController::rndDate();
            $trade->updated_at = TradeController::rndDate();
            $trade->save();
        }
        return redirect()->route('stock.index')->with('success_message','Akcija '.$trade->stock->name  .' sekmingai prekiaujama');
  
    }
    public static function populate($stocks){
        foreach ($stocks as $key => $stock) {
            for ($i=0; $i <rand(1000,20000) ; $i++) { 
       
            $trade = new Trade();
            $trade->quantity = rand (1*1000, 100*1000) / 1000;
            $trade->price = rand (1*10000000, 1000*10000000) / 10000000;
            $trade->stock_id = $stock->id;
            $trade->created_at = TradeController::rndDate();
            $trade->updated_at = TradeController::rndDate();
            $trade->save();
        }
        }
    }
    public static function rndDate(){
        $y=rand(2019,2020);
        $m=rand(1,12);
        $d=rand(1,28);
        $h=rand(0,23);
        $i=rand(0,59);
        $s=rand(0,59);

        return $y.'-'.$m.'-'.$d.' '.$h.':'.$i.':'.$s;
    }
}
