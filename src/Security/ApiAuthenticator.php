<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

final class ApiAuthenticator extends AbstractGuardAuthenticator
{
    /**
     * @var string
     */
    private const AUTHORIZATION = 'Authorization';

    /**
     * @var array<string, string>
     */
    private const DATA = [
        // you might translate this message
        'message' => 'Authentication Required'
    ];

    public function __construct()
    {
    }

    public function supports(Request $request): bool
    {
        if (!$request->headers->has(self::AUTHORIZATION)) {
            return false;
        }

        return 0 === strpos($request->headers->get(self::AUTHORIZATION), 'Bearer ');
    }

    public function getCredentials(Request $request): string
    {
        $authorizationHeader = $request->headers->get(self::AUTHORIZATION);
        // skip beyond "Bearer "
        return substr($authorizationHeader, 7);
    }



    public function getUser($credentials, UserProviderInterface $userProvider): ?UserInterface
    {

        if (null === $credentials) {
            // The token header was empty, authentication fails with HTTP Status
            // Code 401 "Unauthorized"
            return null;
        }


        // The "username" in this case is the apiToken, see the key `property`
        // of `your_db_provider` in `security.yaml`.
        // If this returns a user, checkCredentials() is called next:
        return $userProvider->loadUserByIdentifier($credentials);
    }

    public function checkCredentials($credentials, UserInterface $user): bool
    {

        // Check credentials - e.g. make sure the password is valid.
        // In case of an API token, no credential check is needed.

        // Return `true` to cause authentication success
        return true;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey): ?Response
    {
        // on success, let the request continue
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $authenticationException): \Symfony\Component\HttpFoundation\JsonResponse
    {
        $data = [
            // you may want to customize or obfuscate the message first
            'message' => strtr($authenticationException->getMessageKey(), $authenticationException->getMessageData())

            // or to translate this message
            // $this->translator->trans($exception->getMessageKey(), $exception->getMessageData())
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Called when authentication is needed, but it's not sent
     */
    public function start(Request $request, AuthenticationException $authenticationException = null): \Symfony\Component\HttpFoundation\JsonResponse
    {
        return new JsonResponse(self::DATA, Response::HTTP_UNAUTHORIZED);
    }

    public function supportsRememberMe(): bool
    {
        return false;
    }
}
