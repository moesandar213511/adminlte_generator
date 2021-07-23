<?php


namespace App\CustomClass;

use App\Models\Ads;
use App\Models\ads_webpage;
use App\Models\Webpage;

class AdsData
{

    private $id;
    private $ads_data;

    function __construct($ads_id)
    {
        $ads = Ads::where('id', $ads_id)->first();
        $this->id = $ads->id;
        $this->setAdsData($ads);
    }

    /**
     * @return mixed
     */
    public function getAdsData()
    {
        $this->ads_data['photo_url'] = Path::$domain_url . 'upload/ads/' . $this->ads_data['photo'];

        $ads_id = $this->ads_data['id'];
        $ads = ads_webpage::where('ads_id', $ads_id)->get();
        $webpage_arr = [];
        foreach ($ads as $data) {
            $webpage_id = $data->webpage_id;
            $webpages = Webpage::where('id', $webpage_id)->get();
            array_push($webpage_arr, $webpages['0']->name);
        }
        $this->ads_data['webpages'] = $webpage_arr;

        return $this->ads_data;
    }

    /**
     * @param mixed $blog_data
     */
    private function setAdsData($ads_data)
    {
        $this->ads_data = $ads_data;
    }





}
