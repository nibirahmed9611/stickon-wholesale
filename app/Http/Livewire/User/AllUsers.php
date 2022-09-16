<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AllUsers extends Component {

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render() {
        return view( 'livewire.user.all-users',[
            'allUsers' => User::with('order')->orderByDesc('id')->paginate(15),
        ] );
    }
}
