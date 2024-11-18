<?php

class ratings
{
    function displayStars($rating) {
        $stars = '';
        // Empty stars
        if ($rating <= 10) {
            $stars = str_repeat('<i class="far fa-star"></i>', 5);
        }
        // 1 half-filled star, the rest are empty
        elseif ($rating >= 11 && $rating <= 25) {
            $stars = '<i class="fas fa-star-half-alt"></i>' . str_repeat('<i class="far fa-star"></i>', 4);
        }
        // 2 stars, the rest are empty
        elseif ($rating >= 26 && $rating <= 35) {
            $stars = str_repeat('<i class="fas fa-star"></i>', 2) . str_repeat('<i class="far fa-star"></i>', 3);
        }
        // 3 stars, the rest are empty
        elseif ($rating >= 36 && $rating <= 55) {
            $stars = str_repeat('<i class="fas fa-star"></i>', 3) . str_repeat('<i class="far fa-star"></i>', 2);
        }
        // 3 stars and 1 half-star, the remaining are empty
        elseif ($rating >= 56 && $rating <= 65) {
            $stars = str_repeat('<i class="fas fa-star"></i>', 3) . '<i class="fas fa-star-half-alt"></i>' . '<i class="far fa-star"></i>';
        }
        // 4 stars, the remaining one is empty
        elseif ($rating >= 66 && $rating <= 75) {
            $stars = str_repeat('<i class="fas fa-star"></i>', 4) . '<i class="far fa-star"></i>';
        }
        // 4 stars and 1 half star
        elseif ($rating >= 76 && $rating <= 85) {
            $stars = str_repeat('<i class="fas fa-star"></i>', 4) . '<i class="fas fa-star-half-alt"></i>';
        }
        // 5 stars for 86+
        else {
            $stars = str_repeat('<i class="fas fa-star"></i>', 5);
        }
        return $stars;
    }
}
?>