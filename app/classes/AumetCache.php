<?php


class AumetCache
{

    static function check(){
        $cache = \Cache::instance();
        $f3 = \F3::instance();

        if (getenv('ENV') == Constants::ENV_LOC) {
            AumetCache::clear();
        }

        if($f3->get("AUMET_CACHE")) {
            // countries
            if ($cache->exists('arrCountries', $arrCountries)) {
                $f3->set('arrCountries', $arrCountries);
            }
            else{
                $arrCountries = (new Country())->all("Name asc");
                $cache->set('arrCountries', $arrCountries, 0);
                $f3->set('arrCountries', $arrCountries);
            }
        }

    }

    static function clear()
    {
        $cache = \Cache::instance();
        $cache->clear('arrCountries');
    }
}