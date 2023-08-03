<?php 
// app/helpers.php

if (!function_exists('processPhoneNumber')) {
    function processPhoneNumber($phoneNumber)
    {
        // Menghilangkan karakter non-digit dari nomor telepon
        $phoneNumber = preg_replace('/\D/', '', $phoneNumber);

        // Jika angka pertama adalah 0, ganti dengan 62
        if (substr($phoneNumber, 0, 1) === '0') {
            return substr($phoneNumber, 1);
        }

        // Jika angka pertama adalah 62, kembalikan nomor telepon tanpa perubahan
        elseif (substr($phoneNumber, 0, 2) === '62') {
            return substr($phoneNumber, 2);
        }
        
        else{
            return $phoneNumber;
        }
    }
}
