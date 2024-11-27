<?php

namespace App\Actions;

use App\Models\Participants;
use LaravelViews\Actions\Action;
use LaravelViews\Actions\Confirmable;
use LaravelViews\Views\View;

class ActivateIndividuAction extends Action
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
     * @param Array $selectedModels Array with all the id of the selected models
     * @param $view Current view where the action was executed from
     */
    public function handle($selectedModels, View $view)
    {
        $statusNull = Participants::whereKey($selectedModels)->whereNull('status')->get();
        if ($statusNull->isEmpty()) {
            $this->error("Participants have been assessed!");
            return;
        } else {
            Participants::whereKey($selectedModels)->whereNull('status')->update(['status' => 'active']);
            sort($selectedModels);
            $this->success();
        }
    }

    use Confirmable;
}
