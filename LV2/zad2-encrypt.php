<?php
// Definirajte ključ koji će se koristiti za kriptiranje i dekriptiranje datoteka
$key = 'moj_tajni_kljuc';

// Provjerite da li je datoteka poslana putem HTTP POST metode
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Provjerite da li je datoteka uspješno poslana i nema grešaka
  if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    // Definirajte naziv datoteke
    $filename = $_FILES['file']['name'];
    // Definirajte putanju za pohranu datoteke
    $path = 'putanja/do/direktorija/za/pohranu/';
    // Generirajte nasumični naziv za datoteku kako bi se izbjegli eventualni problemi prijenosa
    $random_name = uniqid();
    // Dodajte ekstenziju datoteke
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $encrypted_file = $random_name . '.' . $extension . '.enc';
    // Kriptirajte datoteku
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted_data = openssl_encrypt(file_get_contents($_FILES['file']['tmp_name']), 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
    $encrypted_data_with_iv = $iv . $encrypted_data;
    // Spremite kriptiranu datoteku na server
    file_put_contents($path . $encrypted_file, $encrypted_data_with_iv);
    // Obavijestite korisnika o uspješnom uploadu
    echo 'Datoteka je uspješno uploadana i kriptirana.';
  } else {
    // Ako datoteka nije uspješno poslana, obavijestite korisnika o greški
    echo 'Došlo je do pogreške prilikom uploada datoteke.';
  }
}
?>
