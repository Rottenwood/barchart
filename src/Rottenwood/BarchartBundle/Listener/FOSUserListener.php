<?php
/**
 * Author: Rottenwood
 * Date Created: 06.01.15 20:16
 */

namespace Rottenwood\BarchartBundle\Listener;

use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Листнер событий FOSUserBundle
 * @package Rottenwood\BarchartBundle\Listener
 */
class FOSUserListener implements EventSubscriberInterface {

    private $router;

    public function __construct(UrlGeneratorInterface $router) {
        $this->router = $router;
    }

    public static function getSubscribedEvents() {
        return [
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess'
        ];
    }

    public function onRegistrationSuccess(FormEvent $event) {
//        $url = $this->router->generate('index');
//        $event->setResponse(new RedirectResponse($url));
    }
}
