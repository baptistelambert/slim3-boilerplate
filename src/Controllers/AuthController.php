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

        $email = $request->getParam('email');
        $password = $request->getParam('password');
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $user = (new User())
            ->setEmail($email)
            ->setUsername($request->getParam('username'))
            ->setPassword($hashedPassword)
        ;

        $em->persist($user);
        $em->flush();

        $this->container->get('auth')->attempt($email, $password);

        return $this->redirect($response, 'homepage');
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function getSignIn(RequestInterface $request, ResponseInterface $response)
    {
        return $this->render($response, 'auth/signin.twig');
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function postSignIn(RequestInterface $request, ResponseInterface $response)
    {
        $auth = $this->container->get('auth')->attempt($request->getParam('email'), $request->getParam('password'));

        if (!$auth) {
            return $this->redirect($response, 'user_signin');
        }

        return $this->redirect($response, 'homepage');
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function getSignOut(RequestInterface $request, ResponseInterface $response)
    {
        $this->container->get('auth')->signout();

        return $this->redirect($response, 'homepage');
    }
}