<?php

namespace App\Observers;

use App\Jobs\TesteJob;
use App\Models\Cidade;
use App\Models\User;

class CidadeObserver
{
    /**
     * Handle the Cidade "created" event.
     *
     * @param  \App\Models\Cidade  $cidade
     * @return void
     */
    public function created()
    {
        $user = User::where('id', 2)->get()->first();
        TesteJob::dispatch($user);
    }

    /**
     * Handle the Cidade "updated" event.
     *
     * @param  \App\Models\Cidade  $cidade
     * @return void
     */
    public function updated(Cidade $cidade)
    {
        //
    }

    /**
     * Handle the Cidade "deleted" event.
     *
     * @param  \App\Models\Cidade  $cidade
     * @return void
     */
    public function deleted(Cidade $cidade)
    {
        //
    }

    /**
     * Handle the Cidade "restored" event.
     *
     * @param  \App\Models\Cidade  $cidade
     * @return void
     */
    public function restored(Cidade $cidade)
    {
        //
    }

    /**
     * Handle the Cidade "force deleted" event.
     *
     * @param  \App\Models\Cidade  $cidade
     * @return void
     */
    public function forceDeleted(Cidade $cidade)
    {
        //
    }
}
