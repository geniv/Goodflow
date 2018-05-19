<p>archiv</p>

{loop="$db->query('projects', 'idproject, name', 'archive IS NOT NULL AND iduser=?', array($iduser))"}
{$sum = $crate->summaryTask($value->idproject)}

<div class="panel panel-info">
    <div class="panel-heading clearfix">
        <h3 class="panel-title pull-left">{$value->name}</h3>
        <p class="pull-right btn-group btn-group-xs">

            <a href="#" class="btn btn-primary" onclick="delProject({$value->idproject}, '{$value->name}'); return false;">Smazat</a>
            <a href="#" class="btn btn-primary" onclick="restoreProject({$value->idproject}, '{$value->name}'); return false;">Obnovit</a>
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
        <h3 class="panel-title pull-left">{date_str="H:i:s (d.m.Y)", $task->start} - {date_str="H:i:s (d.m.Y)", $task->stop}</h3>
<p class="pull-right btn-group btn-group-xs">
použito: <input type="checkbox" name="used" disabled{$task->used ? ' checked' : null}/>
</p>
    </div>
    <div class="panel-body projekt-listing">



            {if="$task->stop"}
            {$diff = classes\DateAndTime::different($task->start, strtotime($task->stop) - $task->pause_length)}
            {$diff2 = classes\DateAndTime::different($task->start, strtotime($task->start) + $task->pause_length)}









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

    </div>
</div>

{/loop}


    </div>
</div>


{emptyloop}
    žádný projekt
{/loop}