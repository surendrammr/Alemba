<?php namespace Alemba\Alemba\Models;

class TeamExport extends \Backend\Models\ExportModel
{
    public function exportData($columns, $sessionKey = null)
    {
        $team_members = Team::all();
        $team_members->each(function($team_member) use ($columns) {
            $team_member->addVisible($columns);
        });
        return $team_members->toArray();
    }
}

?>