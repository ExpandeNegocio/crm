<?php

require_once ('modules/Users/User.php');

$resp= User::checkPassword($password,'$user->user_hash');

echo $resp;

$string = "Some text to be encrypted";

$secret_key = "This is my secret key";

// Create the initialization vector for added security.

$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);


// Encrypt $string

$encrypted_string = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $secret_key, $string, MCRYPT_MODE_CBC, $iv);

// Decrypt $string

$decrypted_string = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $secret_key, $encrypted_string, MCRYPT_MODE_CBC, $iv);

 

echo "Original string : " . $string . "<br />\n";

echo "Encrypted string : " . $encrypted_string . "<br />\n";

echo '<br>';

echo "Decrypted string : " . $decrypted_string . "<br />\n";

?>

