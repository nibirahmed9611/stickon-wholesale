<?php

namespace App\Http\Livewire\Account;

use App\Models\Account;
use Livewire\Component;

class CreateAccount extends Component {

    public Account $account;

    protected $rules = [
        'account.name'  => 'required|string',
        'account.value' => 'required|numeric|min:0',
        'account.pm'    => 'required',
    ];


    public function mount() {
        $this->account = new Account();
        $this->account->pm = "Plus";
    }

    public function save() {
        $this->validate();

        $this->account->save();

        session()->flash( 'success', 'Account added successfully' );

        $this->mount();
    }

    public function render() {
        return view( 'livewire.account.create-account' );
    }
}
