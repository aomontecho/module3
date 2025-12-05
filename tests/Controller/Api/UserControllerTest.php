<?php

namespace App\Tests\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class UserControllerTest extends WebTestCase
{

   /* protected function createAuthenticatedClient(UserInterface $user): \Symfony\Bundle\FrameworkBundle\KernelBrowser
    {
        $client = static::createClient();
        
        /** @var JWTTokenManagerInterface $jwtManager 
        $jwtManager = static::getContainer()->get('lexik_jwt_authentication.jwt_manager');
        $token = $jwtManager->create($user);

        $client->setDefaultOptions([
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ]);

        return $client;
    } */

    public function testIndex(): void
    {
       /*
        $url = "http://127.0.0.1:8000/api/login_check";

        $data = [
            'username' => 'aomontecho@cnss.bj',
            'password' => 'cnsscnss',
        ];
        
    // Initialisation
    $ch = curl_init($url);

    // Configuration
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retourner la réponse
    curl_setopt($ch, CURLOPT_POST, true);           // Méthode POST
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json"
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // JSON envoyé

    // Exécution
    $response = curl_exec($ch);
        
       var_dump($response);
        $jsonResponse = json_decode($response,true);
        //var_dump($jsonResponse);

        */
        $client = static::CreateClient();
        
        //
        $client->request('GET', 'http://127.0.0.1:8000/api/user', [
            'headers' => [
                'Content-Type' => 'application/json', // Essential for JSON data
                //'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE3NjQ5MzEwNzUsImV4cCI6MTc2NDkzNDY3NSwicm9sZXMiOltdLCJ1c2VybmFtZSI6ImFvbW9udGVjaG9AY25zcy5iaiJ9.cdB8SvccxE1UTcVqJqvdLQvoEhWXgfAKxjbOhbSkzhIYZcW2oMPawhG4ykHdG-2FHUJVSENWwt0twO8tbZIoIu0hGTnkqULeYQF2E0Z02PR8uMW3De3QOaoN1aEdTZVWF4VnRn-1VuETyMkuHm0m5wh8R6WghKWnddJhnA0V73RSs9gdi5IOpjwGlqDXLbgy-DgDylCQ0972281NCAF6dU-9K4KuM-XUmbzNG_RZ6QOmZWclRHg4YEgbVDU4L6Ob0Xw8dtEsgDCOM_Euzj0ATa-vrfswOp9Fo05Z05Ia1IEVEGX0RsywaeNtJXLyqQNNRhFv0iH8LFynvujuwRqyag',
            ],
            

        ]);

        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseIsSuccessful();
        $this->assertResponseFormatSame('json');
        
    }

    public function testGetUser()
    {

        $client = static::CreateClient();
        
        //
       
        $request= $client->request('GET', 'http://127.0.0.1:8000/api/user/1', [
            'headers' => [
                'Content-Type' => 'application/json', // Essential for JSON data
                //'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE3NjQ5MzEwNzUsImV4cCI6MTc2NDkzNDY3NSwicm9sZXMiOltdLCJ1c2VybmFtZSI6ImFvbW9udGVjaG9AY25zcy5iaiJ9.cdB8SvccxE1UTcVqJqvdLQvoEhWXgfAKxjbOhbSkzhIYZcW2oMPawhG4ykHdG-2FHUJVSENWwt0twO8tbZIoIu0hGTnkqULeYQF2E0Z02PR8uMW3De3QOaoN1aEdTZVWF4VnRn-1VuETyMkuHm0m5wh8R6WghKWnddJhnA0V73RSs9gdi5IOpjwGlqDXLbgy-DgDylCQ0972281NCAF6dU-9K4KuM-XUmbzNG_RZ6QOmZWclRHg4YEgbVDU4L6Ob0Xw8dtEsgDCOM_Euzj0ATa-vrfswOp9Fo05Z05Ia1IEVEGX0RsywaeNtJXLyqQNNRhFv0iH8LFynvujuwRqyag',
            ],
            

        ]);

       // $this->assertResponseStatusCodeSame(200);
      //  $this->assertResponseIsSuccessful();
       // $this->assertResponseFormatSame('json');

        $result = $client->getResponse()->getContent();
         $this->assertSame(json_encode([
        "email"=> "aomontecho@cnss.bj",
        "roles"=> []
        ]), $result);
         
    }
}
