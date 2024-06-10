<?php
    namespace Lenovo\Shop\Controllers\Client;


    use Lenovo\Shop\Commons\Controller;
    use Lenovo\Shop\Models\User;

    class LoginController extends Controller{
        private User $user;

        public function __construct(){
            $this->user = new User();
        }

        public function showFormLogin(){
            auth_check();
            $this->renderViewClient('login');
        }

        public function login(){
            auth_check();
            try{
                $user = $this->user->findByEmail($_POST['email']);

                if(empty($user)){
                    throw new \Exception('Không tồn tại Email: ' . $_POST['email']);
                }

                $flag = password_verify($_POST['password'], $user['password']);

                if($flag){

                    $_SESSION['user'] = $user;

                    unset($_SESSION['cart']);

                    if($user['type'] == 'admin'){
                        header('Location: ' . url('admin/') );
                        exit;
                    }

                    header('Location: ' . url() );
                    exit;
                }

                throw new \Exception('Password không đúng');
            } catch (\Throwable $th){
                $_SESSION['error'] = $th->getMessage();

                header('Location: ' . url('login') );
                exit;
            }
        } 
        
        public function logout(){
            unset($_SESSION['cart-' . $_SESSION['user']['id']]);
            unset($_SESSION['user']);

            header('Location: ' . url());
            exit;
        }
    }