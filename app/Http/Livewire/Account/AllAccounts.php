<?php

namespace App\Http\Livewire\Account;

use App\Models\Account;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class AllAccounts extends Component {

    use WithPagination;

    public $from;

    public $to;

    public $deleteConfirm;

    protected $paginationTheme = 'bootstrap';

    public function mount() {
        $this->from = "";
        $this->to   = "";
    }

    public function resetFilter() {
        $this->mount();
    }

    public function delete( $id ) {
        $this->deleteConfirm = $id;
    }

    public function modalDelete() {

        Account::find( $this->deleteConfirm )->delete();

        $this->mount();
    }

    public function render() {

        if ( $this->from != "" && $this->to != "" ) {
            $from = Carbon::createFromFormat( "Y-m-d", $this->from );
            $to   = Carbon::createFromFormat( "Y-m-d", $this->to );

            return view( 'livewire.account.all-accounts', [
                'allAccounts' => Account::whereBetween( 'created_at', [$from, $to] )->orderByDesc( "id" )->paginate( 15 ),
                'plus'        => Account::whereBetween( 'created_at', [$from, $to] )->where( 'pm', 'Plus' )->sum( 'value' ),
                'minus'       => Account::whereBetween( 'created_at', [$from, $to] )->where( 'pm', 'Minus' )->sum( 'value' ),
            ] );

        } else {
            return view( 'livewire.account.all-accounts', [
                'allAccounts' => Account::whereDate( 'created_at', Carbon::today() )->orderByDesc( "id" )->paginate( 15 ),
                'plus'        => Account::whereDate( 'created_at', Carbon::today() )->where( 'pm', 'Plus' )->sum( 'value' ),
                'minus'       => Account::whereDate( 'created_at', Carbon::today() )->where( 'pm', 'Minus' )->sum( 'value' ),
            ] );
        }

    }

}
