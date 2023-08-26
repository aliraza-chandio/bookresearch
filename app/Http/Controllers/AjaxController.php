<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master;
use App\Models\ProductNative;
use App\Models\Product;
use App\Models\Type;

class AjaxController extends Controller
{
    public function getTableTypes(Request $request)
    {
        $masters = Master::where("table_type", 1)->where("type_id", $request->type)->get(["name", "id"]);
        return response()->json($masters);
    }
    public function getParents(Request $request)
    {
        $masters = Master::where("table_type", $request->table_type)->where("type_id", $request->type)->get(["name", "id"]);
        return response()->json($masters);
    }
    public function getMasters(Request $request)
    {
        $masters = Master::where("table_type", $request->table_type)->where("type_id", $request->type)->get(["name", "id"]);
        return response()->json($masters);
    }
    public function getTypes(Request $request)
    {
        $types = Type::where('status', 1)->get(["name", "id"]);
        return response()->json($types);
    }

    public function getScholarsAjax(Request $request)
    {
        $bd = $request->bd;
        $day = $request->day;
        $month = $request->month;
        $year = $request->year;
        $type_id = 4;
        $lang = 'ur';

        if (isset($day) || isset($month) || isset($year)) {
            $date = '';
            $year = $request->year;
            $month = $request->month;
            $monthIndex = $month;
            $day = $request->day;
            $bd = $request->bd;
            if ($day == 'Day') {
                $day = false;
            } if ($month == 'Month') {
                $month = false;
            } if ($year == '') {
                $year = false;
            }
            if ($year && $month && $day == false) {
                $date = $year . "-" . $month;
            } elseif ($year && $month == false && $day == false) {
                $date = $year;
            } elseif ($year == false && $month && $day == false) {
                $date = "-" . $month . "-";
            } elseif ($year && $month && $day) {
                $date = $year . "-" . $month . "-" . $day;
            } elseif ($year == false && $month && $day) {
                $date = "-" . $month . "-" . $day;
            } elseif ($year && $month == false && $day) {
                $date = $year . "-00-" . $day;
            } elseif ($year == false && $month == false && $day) {
                $date = "0000-00-" . $day;
            }
        }
        if ($bd == 1) {


            $productSearch = Product::join('product_native', 'product_native.product_id', '=', 'product.id')
            ->whereRaw("product_native.lang ='".$lang."'")
            ->whereRaw("product.date_birthday LIKE '%".$date."%'")
            ->whereRaw('product_native.status =' . 1)
            ->whereRaw('product.type_id =' . $type_id)
            ->orderBy('product.date_birthday','ASC')
            ->orderBy('product.most_view','DESC')
            ->get();

        }
        elseif ($bd == 2)
        {

            $productSearch = Product::join('product_native', 'product_native.product_id', '=', 'product.id')
            ->whereRaw("product_native.lang ='".$lang."'")
            ->whereRaw("product.date_death LIKE '%".$date."%'")
            ->whereRaw('product_native.status =' . 1)
            ->whereRaw('product.type_id =' . $type_id)
            ->orderBy('product.date_death','ASC')
            ->orderBy('product.most_view','DESC')
            ->get('product_native.name');

        }
        return response()->json($productSearch);
    }
}
