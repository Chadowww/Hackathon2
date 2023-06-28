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
//        $client = HttpClient::create();
//
//        $response = $client->request('POST', 'https://api.techspecs.io/v4/product/search?query=' . $model, [
//            'headers' => [
//                'Accept-Encoding' => 'gzip, deflate',
//                'Authorization' => 'sha512-1NcgUAMT++G0O9aiKshWcWX+pshx6VbLcwMYL7zEjH7DQGRbbFBsCAfwpQUWXLlrRW1E0HcJTAljjLkthEfyYA==?9nKE',
//                'accept' => 'application/json',
//            ],
//        ]);
//        dd($response);

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
//        $client = HttpClient::create();
//
//        $response = $client->request('GET', 'https://api.techspecs.io/v4/product/detail?productId=' . $id, [
//            'headers' => [
//                'Accept-Encoding' => 'gzip, deflate',
//                'Authorization' => 'sha512-1NcgUAMT++G0O9aiKshWcWX+pshx6VbLcwMYL7zEjH7DQGRbbFBsCAfwpQUWXLlrRW1E0HcJTAljjLkthEfyYA==?9nKE',
//                'accept' => 'application/json',
//            ],
//        ]);

        return $response;
    }


}


