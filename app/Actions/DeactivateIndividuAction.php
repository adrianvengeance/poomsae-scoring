<?php

namespace App\Actions;

use App\Models\Participants;
use LaravelViews\Actions\Action;
use LaravelViews\Actions\Confirmable;
use LaravelViews\Views\View;

class DeactivateIndividuAction extends Action
{
    /**
     * Any title you want to be displayed
     * @var String
     * */
    public $title = "Selesai?";

    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = "check-circle";

    /**
     * Execute the action when the user clicked on the button
     *
     * @param Array $selectedModels Array with all the id of the selected models
     * @param $view Current view where the action was executed from
     */
    public function handle($selectedModels, View $view)
    {
        Participants::whereKey($selectedModels)->update(['status' => 'inactive']);
        $this->success();
    }

    use Confirmable;
}
