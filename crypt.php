<?php

function CRYPT($q, $status)
{
    $cryptKey = 'qJB0rGtIn5UB1xG03efyCp';
    $ivLength = openssl_cipher_iv_length('aes-256-cbc');

    if ($status === 'hide') {
        // Generate a random IV
        $iv = openssl_random_pseudo_bytes($ivLength);
        // Encrypt the data
        $encrypted = openssl_encrypt($q, 'aes-256-cbc', md5($cryptKey, true), OPENSSL_RAW_DATA, $iv);
        // Combine IV and encrypted data, then base64 encode
        return base64_encode($iv . $encrypted);
    }

    if ($status === 'show') {
        // Decode the base64-encoded string
        $data = base64_decode($q);
        // Extract the IV and encrypted data
        if (strlen($data) < $ivLength) {
            return false; // Invalid data
        }
        $iv = substr($data, 0, $ivLength);
        $encrypted = substr($data, $ivLength);

        // Decrypt the data
        $decrypted = openssl_decrypt($encrypted, 'aes-256-cbc', md5($cryptKey, true), OPENSSL_RAW_DATA, $iv);
        return $decrypted !== false ? $decrypted : false; // Return false on failure
    }

    return false; // Invalid status
}

// Example usage
$hidden = CRYPT('Hello, World!', 'hide');
echo "Encrypted: " . $hidden . "\n";

$revealed = CRYPT($hidden, 'show');
echo "Decrypted: " . $revealed . "\n";
