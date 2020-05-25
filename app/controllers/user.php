<?php 
namespace App\controllers;
use Delight\Auth\Auth;
use League\Plates\Engine;
use App\Model\Product as ProductData;
use \Tamtamchik\SimpleFlash\Flash;

class user {
   private $templates, $pdo, $auth, $error, $flash;
   private $selector, $token;

   public function __construct(Auth $auth, Engine $engine, ProductData $db, Flash $flash)
   {
      $this->templates = $engine;
      $this->db = $db;
      $this->auth = $auth;
      $this->flash = $flash;

   }

   public function login()
   {
      if (!empty($_POST)) {
         try {
            $this->auth->login($_POST['email'], $_POST['password']);
      
            header('Location: http://lavel2/');
         }
         catch (\Delight\Auth\InvalidEmailException $e) {
         $this->flash->error('Wrong email address');
         }
         catch (\Delight\Auth\InvalidPasswordException $e) {
         $this->flash->error('Wrong password');
         }
         catch (\Delight\Auth\EmailNotVerifiedException $e) {
         $this->flash->error('Email not verified');
         }
         catch (\Delight\Auth\TooManyRequestsException $e) {
         $this->flash->error('Too many requests');
         }
      }

      echo $this->templates->render('login', ['category'=>$this->db->getCategory(), 'errors'=>$this->flash, 'auth'=>$this->auth]);
   }

   public function LogOut()
   {
      $this->auth->logOut();
      header('Location: http://lavel2/');

   }

   public function register()
   {  
      if (!empty($_POST)) {
         try {
            $userId = $this->auth->register($_POST['email'], $_POST['password'], $_POST['username'], function ($selector, $token)  {
              // echo 'Send ' . $selector . ' and ' . $token . ' to the user (e.g. via email)';
              $this->selector = $selector;
              $this->token = $token;
            });
            $this->flash->success('Success registration');
            //echo 'We have signed up a new user with the ID ' . $userId;
         }
         catch (\Delight\auth\InvalidEmailException $e) {
            $this->flash->error('Invalid email address');
         }
         catch (\Delight\auth\InvalidPasswordException $e) {
            $this->flash->error('Invalid password');
         }
         catch (\Delight\auth\UserAlreadyExistsException $e) {
            $this->flash->error('User already exists');
         }
         catch (\Delight\auth\TooManyRequestsException $e) {
            $this->flash->error('Too many requests');
         }

         try {
            $this->auth->confirmEmail($this->selector, $this->token);
        
            //echo 'Email address has been verified';
        }
        catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
            //die('Invalid token');
        }
        catch (\Delight\Auth\TokenExpiredException $e) {
            //die('Token expired');
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
           // die('Email address already exists');
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            //die('Too many requests');
        }
      }  
         
      echo $this->templates->render('register', ['category'=>$this->db->getCategory(), 'errors'=>$this->flash, 'auth'=>$this->auth]);
     
   }
}