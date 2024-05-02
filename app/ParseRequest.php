<?php

namespace App;

use Parse\ParseClient;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Parse\HttpClients\ParseCurlHttpClient;

class ParseRequest extends Model
{
    static function InitParseRequest() {

        $parse_url = Config::get('parse.PARSE_URL');
        $app_id = Config::get('parse.PARSE_APP_ID');
        $app_key = Config::get('parse.PARSE_MASTER_KEY');
        $rest_key = Config::get('parse.PARSE_API_REST_KEY');
        
        ParseClient::initialize($app_id, $rest_key, $app_key );
        ParseClient::setServerURL($parse_url, "/");
        ParseClient::setHttpClient(new ParseCurlHttpClient());
        $health = ParseClient::getServerHealth();
        // dd($health);
        if ($health['status'] === 200) {
            return true;
        } else {

            $parse_host = Config::get('parse.PARSE_HOST');
            $parse_route = Config::get('parse.PARSE_ROUTE');

            ParseClient::initialize( $app_id, $rest_key, $app_key);
            ParseClient::setServerURL($parse_host, $parse_route);
            ParseClient::setHttpClient(new ParseCurlHttpClient());
            $health = ParseClient::getServerHealth();

            return ($health['status'] === 200) ?: ($health['status'] ? abort($health['status']) : abort(500));
        }
    }

    static public function checkHealth() {
        return Session::get('parse_health');
    }
}
