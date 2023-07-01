<?php
namespace App\Services;

use Symfony\Component\HttpClient\HttpClient;

class APIServices{

    public function getIdProduct($model){
        $pathFichier1 = __DIR__ . '/exemple.json';
       $contenuFichier1 = file_get_contents($pathFichier1);
        if ($contenuFichier1 === false) {
            // Gérer l'erreur de lecture du fichier
            die('Erreur lors de la lecture du fichier 1.');
        }
        $response = json_decode($contenuFichier1, true);
  //     $client = HttpClient::create();
//        $client = new \GuzzleHttp\Client();
//
        //      $response = $client->request('POST', 'https://api.techspecs.io/v4/product/search?query=' . $model, [
        //  'headers' => [
        //      'Accept-Encoding' => 'gzip, deflate',
        //      'Authorization' => 'api key',
        //      'accept' => 'application/json',
        //  ],
        //  ]);
//        // $response = $response->toArray();
        //  $response = json_decode($response->getBody(), true);

        return $response;
    }

    public function getDetailsProduct($id){
        $pathFichier1 = __DIR__ . '/exempleDetails.json';
        $contenuFichier1 = file_get_contents($pathFichier1);
        if ($contenuFichier1 === false) {
            // Gérer l'erreur de lecture du fichier
            die('Erreur lors de la lecture du fichier 1.');
        }
        $response = json_decode($contenuFichier1, true);
        // $requete = 'https://api.techspecs.io/v4/product/detail?productId=' . $id;

        // $client = HttpClient::create();
//        $clientGuzz = new \GuzzleHttp\Client();
        // $response = $client->request('GET', $requete, [
        //  'headers' => [
        //      'Accept-Encoding' => 'gzip, deflate',
        //      'Authorization' => 'api key',
        //   'accept' => 'application/json',
        //  ],
        //  ]);
//        $response = $response->toArray();
//        $response = json_decode($clientGuzz->getBody(), true);
//        dd($response);

        return $response;
    }


}


