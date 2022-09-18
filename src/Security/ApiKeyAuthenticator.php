<?php

namespace App\Security;

use App\Entity\ApiUser;
use App\Repository\ApiUserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\CustomCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

final class ApiKeyAuthenticator extends AbstractAuthenticator
{
    private readonly \App\Repository\ApiUserRepository $apiUserRepository;

    public function __construct(ApiUserRepository $apiUserRepository)
    {
        $this->apiUserRepository = $apiUserRepository;
    }


    /**
     * Called on every request to decide if this authenticator should be
     * used for the request. Returning `false` will cause this authenticator
     * to be skipped.
     */
    public function supports(Request $request): ?bool
    {
        return $request->headers->has('X-AUTH-TOKEN');
    }

    public function authenticate(Request $request): SelfValidatingPassport
    {
        $apiToken = $request->headers->get('X-AUTH-TOKEN');
        $apiUser = $request->headers->get('X-AUTH-USER');

        if (null === $apiToken) {
            // The token header was empty, authentication fails with HTTP Status
            // Code 401 "Unauthorized"
            throw new CustomUserMessageAuthenticationException('No API token provided');
        }

        $userfromDb = $this->apiUserRepository->findOneBy(['username' => $apiUser]);
        $this->checkUser($userfromDb, $apiToken);
        return new SelfValidatingPassport(new UserBadge($apiUser), []);
    }


    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // on success, let the request continue
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $authenticationException): ?Response
    {
        $data = [
            // you may want to customize or obfuscate the message first
            'message' => strtr($authenticationException->getMessageKey(), $authenticationException->getMessageData())

            // or to translate this message
            // $this->translator->trans($exception->getMessageKey(), $exception->getMessageData())
        ];
        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    private function checkUser(?ApiUser $apiUser, $apiToken): void
    {
        if (null === $apiUser) {
            throw new CustomUserMessageAuthenticationException('API user not found');
        }

        if ($apiUser->getApiToken() !== $apiToken) {
            throw new CustomUserMessageAuthenticationException('Invalid API token');
        }
    }
}
