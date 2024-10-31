<?php

class ratings
{
    function displayStars($rating)
    {
        $stars = '';

        //half star if rating is < 15
        //1 star if rating is < 25
        //1.5 stars if rating is < 35
        //2 stars if rating is < 45
        //2.5 stars if rating is < 55
        //3 stars if rating is < 65
        //3.5 stars if rating is < 75
        //4 stars if rating is < 85
        //4.5 stars if rating is < 95
        //5 stars if rating is > 95

        if ($rating < 15) {
            $stars = '<i class="ri-star-half-line"></i>';
        } elseif ($rating < 25) {
            $stars = '<i class="ri-star-fill"></i>';
        } elseif ($rating < 35) {
            $stars = '<i class="ri-star-fill"></i><i class="ri-star-half-line"></i>';
        } elseif ($rating < 45) {
            $stars = '<i class="ri-star-fill"></i><i class="ri-star-fill"></i>';
        } elseif ($rating < 55) {
            $stars = '<i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-half-line"></i>';
        } elseif ($rating < 65) {
            $stars = '<i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i>';
        } elseif ($rating < 75) {
            $stars = '<i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-half-line"></i>';
        } elseif ($rating < 85) {
            $stars = '<i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i>';
        } elseif ($rating < 95) {
            $stars = '<i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-half-line"></i>';
        } else {
            $stars = '<i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i>';
        }

        return $stars;
    }
}
?>