<?php
namespace Src\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator as Respect;
use Src\Entity\User;

class AuthController extends Controller
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function getSignUp(RequestInterface $request, ResponseInterface $response)
    {
        return $this->render($response, 'auth/signup.twig');
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function postSignUp(RequestInterface $request, ResponseInterface $response)
    {
        $em = $this->container->get('em');
        $userRepository = $em->getRepository(User::class);

        $validation = $this->container->get('validator')->validate($request, [
            'email' => Respect::noWhitespace()->notEmpty()->email()->emailAvailable($userRepository),
            'username' => Respect::noWhitespace()->notEmpty()->alnum()->usernameAvailable($userRepository),
            'password' => Respect::noWhitespace()->notEmpty(),
        ]);

        if (!$validation->isValid()) {
            return $this->redirect($response, 'user_signup');
        }

        $hashedPassword = password_hash($request->getParam('password'), PASSWORD_DEFAULT);

        $user = (new User())
            ->setEmail($request->getParam('email'))
            ->setUsername($request->getParam('username'))
            ->setPassword($hashedPassword)
        ;

        $em->persist($user);
        $em->flush();

        return $this->redirect($response, 'homepage');
    }
}