<?php

namespace App\Admin\Controllers;

use App\Admin\Models\Admin;
use App\Attribute;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Customer;
use App\Models\ShopOrder;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
 
        $breadcrumb['heading_title']='<i class="fa fa-bar-chart"></i> '.'Dashboard';
        $breadcrumb['buttons']='';
        $breadcrumb['breadcrumbs'][] = array(
            'text' => '<i class="fa fa-home"></i> '. trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );
        Session::flash('breadcrumbs' , $breadcrumb);

        $data = [];
        $data['title'] = 'YemenMarket | Dashboard';

        if(!Admin::user()->can('dashboard'))
          {
            return view('admin.default', $data);
          }

       
        $data['users'] = new Customer;
        $data['orders'] = new ShopOrder;
        $data['mapStyleStatus'] = ShopOrder::$mapStyleStatus;
        $data['products'] =  new Product;
        $data['blogs'] =  new Customer;;


        //Country statistics
        $dataCountries = $this->getCountryInYear();
        $arrCountry = Country::getCodeAll();
        $arrCountryMap   = [];
        $ctTotal = 0;
        $ctTop = 0;
        foreach ($dataCountries as $key => $country) {
            $ctTotal +=$country->count;
            if($key <= 3) {
                $ctTop +=$country->count;
                $countryName = $arrCountry[$country->country] ?? $key ;
                if($key == 0) {
                    $arrCountryMap[] =  [
                        'name' => $countryName,
                        'y' => $country->count,
                        'sliced' => true,
                        'selected' => true,
                    ];
                } else {
                    $arrCountryMap[] =  [$countryName, $country->count];
                }
            }
        }
        $arrCountryMap[] = ['Other', ($ctTotal - $ctTop)];
        $data['dataPie'] = json_encode($arrCountryMap);
        //End country statistics


         $rangDays = new \DatePeriod(
            new \DateTime('-1 month'),
            new \DateInterval('P1D'),
            new \DateTime('+1 day')
        );
        $totalsInMonth=$this->getSumOrderTotalInMonth()->keyBy('md')->toArray();

        $orderInMonth  = [];
        $amountInMonth  = [];
        foreach ($rangDays as $i => $day) {
            $date = $day->format('m-d');
            $orderInMonth[$date] = $totalsInMonth[$date]['total_order'] ?? '';
            $amountInMonth[$date] = (int) ($totalsInMonth[$date]['total_amount'] ?? 0);
        }

        $totalsMonth=$this->getSumOrderTotalInYear()->pluck('total_amount', 'ym')->toArray();
        $dataInYear = [];
        for ($i = 12; $i >= 0; $i--) {
            $date = date("Y-m", strtotime(date('Y-m-01') . " -$i months"));
            $dataInYear[$date] =(int)($totalsMonth[$date] ?? 0);
        }
        //  dd(date("Y-m",strtotime(date('Y-m-01'). " -12 months")));
        $data['orderInMonth']=$orderInMonth;
        $data['amountInMonth']=$amountInMonth;
        $data['dataInYear']=$dataInYear;



        return view('admin.home', $data);

    }

 

    public function deny()
    {
          $breadcrumb['heading_title']='<i class="fa fa-bar-chart"></i> '.'Dashboard';
        $breadcrumb['buttons']='';
        $breadcrumb['breadcrumbs'][] = array(
            'text' => '<i class="fa fa-home"></i> '. trans('home.breadcrumb_home'),
            'href' => 'admin.home2'
        );
        Session::flash('breadcrumbs' , $breadcrumb);

        $data = []; 
        $data = [
            'title' =>'Permission Denied',
            'icon' => '',
            'method' => session('method'),
            'url' => session('url'),
        ];
        return view('admin.deny', $data);
    }

 public function getSumOrderTotalInMonth() 
      {
        return (new ShopOrder)->selectRaw('DATE_FORMAT(created_at, "%m-%d") AS md,
        SUM(total/exchange_rate) AS total_amount, count(id) AS total_order')
            ->whereRaw('created_at >=  DATE_FORMAT(DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH), "%Y-%m-%d 00:00")')
            ->groupBy('md')->get();
    }

    public function getSumOrderTotalInYear()
     {
        return(new ShopOrder)->selectRaw('DATE_FORMAT(created_at, "%Y-%m") AS ym,
        SUM(total/exchange_rate) AS total_amount')
            ->whereRaw('created_at >=  DATE_FORMAT(DATE_SUB(CURRENT_DATE(), INTERVAL 12 MONTH), "%Y-%m-00")')
            ->groupBy('ym')->get();
    }

    public function getCountryInYear()
     {
        return (new ShopOrder)->selectRaw('country, count(id) as count')
            ->whereRaw('DATE(created_at) >=  DATE_SUB(DATE(NOW()), INTERVAL 12 MONTH)')
            ->groupBy('country')
            ->orderBy('count', 'desc')
            ->get();
    }
  
}
