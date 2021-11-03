<?php

namespace App\Service;

class Verification
{

    /**
     * @param $dateCli
     * @return bool
     * @throws \Exception
     */
    public static function isMajor($dateCli): bool
    {
        $dateClient = new \DateTime($dateCli);
        $today = new \DateTime('now');
        $diff = $today->diff($dateClient);
        $age = $diff->y;
        if ($age >= 18) {
            return true;
        }
        return false;
    }

    /**
     * @param $inch
     * @param $cm
     * @return bool
     */
    public static function isValidSize($inch, $cm): bool
    {
        $inches = $cm/2.54;
        $feet = intval($inches/12);
        $inches = $inches%12;
        return sprintf("%d"."' "."%d".'"', $feet, $inches) === $inch;
    }

}
