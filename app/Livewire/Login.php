<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title("Login")]
class Login extends Component
{
    #[Validate('email|required')]
    public $email = '';
    #[Validate('required')]
    public $password = '';
    public $loginMessage = '';

    public function authenticate() {
        $this->validate();
        $valid = Auth::attempt(['email' => $this->email, 'password' => $this->password]);

        if($valid) {
            $this->redirectIntended('/dashboard');
        } else {
            $this->loginMessage = 'Incorrect email or password';
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
