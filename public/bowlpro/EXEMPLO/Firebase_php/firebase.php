<?php
require 'vendor/autoload.php'; // Certifique-se de que o caminho para o autoload está correto

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

$serviceAccount = ServiceAccount::fromJsonFile('path/to/your/firebase-credentials.json');
$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->create();
$auth = $firebase->getAuth();
$firestore = $firebase->getFirestore();
?>
