<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


//i dont know redis related some thing
use App\Http\Controllers\Client as Client;


//using the debagbar
// use \App\Http\Controllers\Debugbar;
use Barryvdh\Debugbar\Facade as Debugbar;
//using the cache facade
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

//using i am redis i am so strong
use Illuminate\Support\Facades\Redis;
use phpDocumentor\Reflection\PseudoTypes\True_;

class CacheController extends Controller
{
    public function normalquery() 
    {
        
        // Cache::flush();

        Debugbar::startMeasure('fetching','getting the datas form database');
        
        $infos = cache()->remember('first-cache',60*60,function()
        { return User::all();});

        Debugbar::stopMeasure('fetching');
        
        $not_json_data = json_decode($infos);
        return  view('cache',compact('not_json_data'));
       
            
    }

    public function redis_cache()
    {
        $random = random_int(20,40);

        Debugbar::startMeasure('REDDIS DATA GET','getting the datas form REDIS');

        $checkRedis = Redis::get('redis_cache_' . $random);

        Debugbar::stopMeasure('REDDIS DATA GET ');


        if(isset($checkRedis)) {
            $all_data = json_decode($checkRedis, true);

            $not_json_data = $all_data ;
            return view('redis', compact('not_json_data'));
        
        }else 
        {

            $all_data = User::all()->take(40);

            Debugbar::startMeasure('inserting datas redis','inserting the datas to redis');

            $data = Redis::set('redis_cache_'.$random, $all_data );

            Debugbar::stopMeasure('inserting datas redis');

            $not_json_data = json_decode($all_data,true);
            
            return view('redis', compact('not_json_data'));
        
        };

        
      
    }

    public function phpredis ()
    {

        Debugbar::startMeasure('inserting datas redis','inserting the datas to redis');

        $redis = Cache::rememberForever('users', function () {
            
            return  User::all();
        });

        Debugbar::stopMeasure('inserting datas redis');

        
        $not_json_data = json_decode($redis,true);
            
        return view('redis' ,compact('not_json_data'));
        
    }
    //delete
    public function delete() 
    {   $random = random_int(20,40);

        User::findOrFail($random)->delete();
        Redis::del('redis_cache_    '.$random);
      
        return response()->json([
            'status_code' => 201,
            'message' => 'Blog deleted'
        ]);
    }


}
