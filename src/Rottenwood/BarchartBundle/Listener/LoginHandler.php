<?php
/**
 * Author: Rottenwood
 * Date Created: 06.01.15 23:27
 */

namespace Rottenwood\BarchartBundle\Listener;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class LoginHandler implements AuthenticationSuccessHandlerInterface {

    private $router;

    function __construct(UrlGeneratorInterface $router) {
        $this->router = $router;
    }

    /**
     * Обработчик события, запускаемого при логине юзера в систему
     * @param Request        $request
     * @param TokenInterface $token
     * @return Response never null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token) {
        $url = $this->router->generate('index');
        return new RedirectResponse($url);
    }

}
