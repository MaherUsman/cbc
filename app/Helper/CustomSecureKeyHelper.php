<?php

use Illuminate\Support\Facades\Hash;
/*
 * THIS FUNCTION WILL TRIM A STRING
 * YOU CAN GIVE STARTING POINT OF TRIMMED STRING
 * DEFAULT START POINT IS 0
 * DEFINE LENGTH OF RESULTING STRING
 */
function TrimWord($text, $length, $startPoint = 0, $allowedTags = "")
{
    $text = html_entity_decode(htmlspecialchars_decode($text));
    $text = strip_tags($text, $allowedTags);
    if (strlen($text) > $length) {
        return $text = substr($text, $startPoint, $length) . "...";
    } else {
        return $text = substr($text, $startPoint, $length);
    }
}

function SplitWords($text,$length=10,$startPoint=0) {
    // Split the text into words
    $words = preg_split('/\s+/', $text);

    // Check if the number of words is greater than 30
    if (count($words) > $length) {
        // Take the first $length words and concatenate "..."
        $truncatedText = implode(' ', array_slice($words, $startPoint, $length)) . '...';
    } else {
        // If 30 words or less, return the original text
        $truncatedText = $text;
    }

    return $truncatedText;
}

/*
 * THIS FUNCTION WILL MAKE A ENCRYPTED KEY
 * DYNAMIC LENGTH OPTION IS AVAILABLE DEFAULT LENGTH IS 10
 */
function EncryptedKey($length_of_string = 10)
{
    $str_result = uniqid() . '0123456789#ABCDEFGHIJKLMNOPQRSTUVWXYZ@abcdefghijklmnopqrstuvwxyz';
    $hashed_key = Hash::make(substr(str_shuffle($str_result), 0, $length_of_string));
    return substr(str_replace(['$', '.', '/', '\\', ','], '', $hashed_key), 7, $length_of_string);
}
