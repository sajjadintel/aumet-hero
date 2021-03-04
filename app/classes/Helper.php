<?php 

class Helper {

    public static function idListFromArray($array){

        $ids = '';
        foreach ($array as $key => $value){
            if ($ids != ''){
                $ids .= ', ';
            }
            $ids .= $key;
        }
        return $ids;
    }

    /**
     * Convert date from one timezone to another one
     */
    function convertToOtherTimezone($datetime,$fromTimezone,$toTimezone){
        $convertedDate = new DateTime($datetime, new DateTimeZone($fromTimezone));
        $convertedDate->setTimezone(new DateTimeZone($toTimezone));
        $date = $convertedDate->format("Y-m-d H:i:s A");
        return [
            'object'=>$convertedDate,
            'date'  =>$date,
        ];
    }

}