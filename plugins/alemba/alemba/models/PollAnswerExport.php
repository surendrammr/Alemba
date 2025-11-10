<?php namespace Alemba\Alemba\Models;

class PollAnswerExport extends \Backend\Models\ExportModel
{
    public function exportData($columns, $sessionKey = null)
    {
        $answers = PollAnswer::all();
        $answers->each(function($answer) use ($columns) {
            $answer->addVisible($columns);
        });
        return $answers->toArray();
    }
}

?>