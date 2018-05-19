                <div class="row">
                    <div class="col-lg-12 wrap_add_task">
                        <a href="#" class="add_task btn col-xs-4 col-xs-offset-4" data-toggle="modal" data-target="#addProject">Vytvořit projekt</a>
                    </div>
                </div>
                <div class="row content-row">
                    <div class="col-lg-4 col-sm-4 col-xs-5">
                        <div id="bezici_task" class="preload">





                        </div>

                    </div>
                    <div class="col-lg-8 col-sm-8 col-xs-7 projekt-content">

{loop="$db->query('projects', 'idproject, name', 'archive IS NULL AND iduser=?', array($iduser))"}

{$sum = $crate->summaryTask($value->idproject)}


<div class="panel panel-info">
    <div class="panel-heading clearfix">
        <h3 class="panel-title pull-left">{$value->name}</h3>
        <p class="pull-right btn-group btn-group-xs">
            <a href="#" class="btn btn-primary" onclick="addTask({$value->idproject}); return false;">Spustit čas</a>
            <a href="#" class="btn btn-primary" onclick="editProject({$value->idproject}, '{$value->name}'); return false;">Upravit</a>
            <a href="#" class="btn btn-primary" onclick="delProject({$value->idproject}, '{$value->name}'); return false;">Smazat</a>
            <a href="#" class="btn btn-primary" onclick="archiveProject({$value->idproject}, '{$value->name}'); return false;">Archivovat</a>
        </p>
    </div>
    <div class="row projekt-info">
        <div class="col-xs-4">
            <p class="projekt-time">{$sum.time}</p>
            <p class="projekt-desc">Celkový čas</p>
        </div>
        <div class="col-xs-4">
            <p class="projekt-time">{$sum.pause}</p>
            <p class="projekt-desc">Celkový čas pauzy</p>
        </div>
        <div class="col-xs-4">
            <p class="projekt-time">{$sum.sum}</p>
            <p class="projekt-desc">Celkový čas včetně pauzy</p>
        </div>
    </div>
    <hr />
    <div class="panel-body">



{loop="$db->query('tasks', 'idtask, idproject, start, stop, description, used, pause_length', 'idproject=?', array($value->idproject), null, null, 'start DESC')" as $task}

<div class="panel panel-success">
    <div class="panel-heading clearfix">
        <h3 class="panel-title pull-left">{date_str="H:i:s (d.m.Y)", $task->start}{if="$task->stop"} - {date_str="H:i:s (d.m.Y)", $task->stop}{else} - ?{/if}</h3>
        <p class="pull-right btn-group btn-group-xs" data-toggle="buttons">
            <a href="#" class="btn btn-success" onclick="delTask({$task->idproject}, {$task->idtask}, '{$value->name}', '{$task->start}'); return false;">Smazat</a>
            <label class="btn btn-success{$task->used ? ' active' : null}" onclick="usedTask({$value->idproject}, {$task->idtask}, !$(this).hasClass('active'));">

<input type="checkbox" name="used" onclick="usedTask({$value->idproject}, {$task->idtask}, this.checked);"{$task->used ? ' checked' : null} /> Zapsáno

            </label>
        </p>
    </div>
    <div class="panel-body projekt-listing {$task->stop ? "projekt-listing-nopadd" : "projekt-listing-padd"}">



            {if="$task->stop"}
            {$diff = classes\DateAndTime::different($task->start, strtotime($task->stop) - $task->pause_length)}
            {$diff2 = classes\DateAndTime::different($task->start, strtotime($task->start) + $task->pause_length)}

                <!-- {date_str="d.m.Y, H:i:s", $task->stop} -->



    <div class="row">
        <div class="col-xs-6">
            <p class="projekt-time">{$crate::getFormatDate($diff, Crate::DATE_DIFF)}</p>
            <p class="projekt-desc">Čas</p>
        </div>
        <div class="col-xs-6">
            <p class="projekt-time">{$crate::getFormatDate($diff2, Crate::DATE_DIFF)}</p>
            <p class="projekt-desc">Čas pauzy</p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 time-desc">
            {if="$task->description"}<hr><p>{$task->description}</p>{/if}
        </div>
    </div>



            {else}
<!-- ted probiha -->
            {/if}


            {if="$crate->isActiveTask($task->idproject, $task->idtask)"}


<div class="input-group">
    <span class="input-group-addon">Popis</span>
    <textarea name="descr" id="iddescription" class="form-control" rows="3" onkeyup="saveDescription({$task->idproject}, {$task->idtask}, this.value);">{$task->description}</textarea>
</div>




<div class="btn-group btn-group-justified">


<a href="#" class="btn {if="$crate->isPausedTask($task->idproject, $task->idtask)"}btn-success{else}btn-danger{/if}" onclick="pauseTask({$task->idproject}, {$task->idtask}); return false;" id="pause_{$task->idproject}_{$task->idtask}">{if="$crate->isPausedTask($task->idproject, $task->idtask)"}Pozastavit{else}Pokračovat{/if}</a>
<a href="#" class="btn btn-success" onclick="stopTask({$task->idproject}, {$task->idtask}, '{$value->name}', '{$task->start}'); return false;">Zastavit</a>

</div>



            {/if}


    </div>
</div>




        {/loop}



    </div>
</div>




{emptyloop}
    žádný projekt
{/loop}






                    </div>
                </div>
                <div class="modal fade" id="addProject" tabindex="-1" role="dialog" aria-labelledby="addProjectLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="addProjectLabel">Vytvořit projekt</h4>
                            </div>
                            <div class="modal-body">
                                <form onsubmit="return false">
                                    <fieldset>
                                        <div class="input-group">
                                            <span class="input-group-addon">Název projektu</span>
                                            <input type="text" class="form-control" name="name" id="project_name" placeholder="..." />
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Zavřít</button>
                                <button type="button" class="btn btn-primary" onclick="addProject();">Uložit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="save_info_box" class="alert alert-info"></div>