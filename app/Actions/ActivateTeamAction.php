<?php

namespace App\Actions;

use App\Models\Participants;
use LaravelViews\Actions\Action;
use LaravelViews\Actions\Confirmable;
use LaravelViews\Views\View;

class ActivateTeamAction extends Action
{
    /**
     * Any title you want to be displayed
     * @var String
     * */
    public $title = "Masukan ke Penjurian";

    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = "log-in";

    /**
     * Execute the action when the user clicked on the button
     *
     * @param $model Model object of the list where the user has clicked
     * @param $view Current view where the action was executed from
     */
    public function handle($model, View $view)
    {
        $statusNull = Participants::whereKey($model)->whereNull('status')->get();
        if ($statusNull->isEmpty()) {
            $this->error("Participants have been assessed!");
            return;
        } else {
            Participants::whereKey($model)->whereNull('status')->update(['status' => 'active']);
            sort($model);
            $this->success();
        }
    }

    use Confirmable;
}
