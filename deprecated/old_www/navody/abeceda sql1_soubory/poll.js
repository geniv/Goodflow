function pollLoad(div, id)
{
    var url = '/poll.php';
    if (id>0) url = url + '?id=' + id;
    new Ajax.Updater(div, url, {asynchronous:true, evalScripts:false});
}

function pollVote(div, id, vote)
{
    var url = '/poll.php?mode=vote&id='+id+'&option='+vote;
    new Ajax.Updater(div, url, {asynchronous:true, evalScripts:false});    
}
function rateLoad(div, id)
{
    var url = '/article_vote.php';
    if (id>0) url = url + '?id=' + id;
    new Ajax.Updater(div, url, {asynchronous:true, evalScripts:false});
}

function rateSet(div, id, vote)
{
    var url = '/article_rate.html?mode=vote&id='+id+'&rate='+vote;
    new Ajax.Updater(div, url, {asynchronous:true, evalScripts:false});    
}