<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;
use OpenApi\Attributes as OA;
use Nelmio\ApiDocBundle\Attribute\Model;
use Nelmio\ApiDocBundle\Attribute\Security;

class UserController extends AbstractController
{
    #[Route('/api/user', methods:['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Retourne la liste des utilisateurs',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: User::class, groups: ['user:list']))
        )
    )]
    #[OA\Tag(name: 'users')]
    #[Security(name: 'Bearer')]
    public function index(UserRepository $userRepository): JsonResponse
    {
        
        return $this->json(['users' =>$userRepository->findAll()], 200, [], ['groups'=>'user:list']);
    }

    #[Route('/api/user/{id}', methods:['GET'])]
    public function afficherUser(UserRepository $userRepository, $id): JsonResponse
    {
        
        return $this->json($userRepository->find($id), 200, [], ['groups'=>'user:detail']);
    }

    #[Route('/api/user/new', methods:['POST'])]
    #[OA\Response(
        response: 200,
        description: 'Retourne un utilisateur créé',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: User::class, groups: ['user:detail']))
        )
    )]
    #[OA\Parameter(
        name: 'email',
        in: 'query',
        description: 'le champ email',
        schema: new OA\Schema(type: 'string')
    )]
     #[OA\Parameter(
        name: 'password',
        in: 'query',
        description: 'le champ mot de passe',
        schema: new OA\Schema(type: 'string')
    )]
    #[OA\Tag(name: 'users')]
    #[Security(name: 'Bearer')]
    public function ajouterUser(UserRepository $userRepository, Request $request, SerializerInterface $serializerInterface, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): JsonResponse
    {
        $json = $request->getContent();
        $user = $serializerInterface->deserialize($json, User::Class, 'json');
        $hashedPassword = $passwordHasher->hashPassword($user,$user->getPassword() );
        $user->setPassword($hashedPassword);
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json(['user' =>$user], 200, [], ['groups'=>'user:detail']);
    }
}
