    var url = window.location.pathname.split('/').pop();    // posledni cast adresy

    $(document).ready(function(){
        $('textarea').autosize();

        $('#project_name').keydown(function(e) {
            if (e.keyCode == '13') {
                e.preventDefault();
                addProject();
            }
        });

        $('#addProject').on('shown.bs.modal', function () {
            $('#project_name').focus();
        });

    });


    // $("#dialog-form").hide();

    // dialog pro novy projekt
/*
    $('.add_task').click(function(e) {
        e.preventDefault();
        $("#dialog-form").dialog({
            height: 300,
            width: 350,
            modal: true
        });
    });

*/


    // pridani projektu
    function addProject() {
        //TODO bud js dialog nebo proste prompt...
        if ($('#project_name').val().length > 0) {
            $.post('http://localhost/www/git/goodflow/gmr_timer/ajax.php', {'type': 'addproject', 'name': $('#project_name').val()}, function(data) {

                // console.log('hele ulozil jsem projekt... jen tak pro informaci');

                // $("#dialog-form").dialog('close');
                $('#project_name').val('');
                // console.log(data);

                window.location.reload();
            });
        }
    }

    // uprava projektu
    function editProject(id, value) {
        var name = prompt('zadej nový název: ', value);
        if (name != null && name != value) {  // pokud je nazev lisi a nezmackl se cancel
            $.post('http://localhost/www/git/goodflow/gmr_timer/ajax.php', {'type': 'editproject', 'id': id, 'name': name}, function(data) {

                // console.log('upraven projekt...');
                // console.log(data);

                window.location.reload();
            });
        }
    }

    // mazani projektu
    function delProject(id, value) {
        if (confirm('opravdu smazat projekt: ' + value)) {
            $.post('http://localhost/www/git/goodflow/gmr_timer/ajax.php', {'type': 'delproject', 'id': id}, function(data) {

                // console.log('provadim mazani projektu...');
                // console.log(data);

                window.location.reload();
            });
        }
    }

    // obnova projektu
    function restoreProject(id, value) {
        if (confirm('opravdu obnovit projekt: ' + value)) {
            $.post('http://localhost/www/git/goodflow/gmr_timer/ajax.php', {'type': 'restoreproject', 'id': id}, function(data) {
                // console.log(data);
                window.location.reload();
            });
        }
    }

    // archivace projektu
    function archiveProject(id, value) {
        if (confirm('opravdu archivovat projekt: ' + value)) {
            $.post('http://localhost/www/git/goodflow/gmr_timer/ajax.php', {'type': 'archiveproject', 'id': id}, function(data) {
                // console.log(data);
                window.location.reload();
            });
        }
    }



    // pridani tasku
    function addTask(id) {
        $.post('http://localhost/www/git/goodflow/gmr_timer/ajax.php', {'type': 'addtask', 'id': id}, function(data) {

            // console.log('hele pridal jsem task...');
            // console.log(data);

            window.location.reload();
        });
    }

    // mazani tasku
    function delTask(id, task, value, time) {
        //~ var t = new Date(time * 1000);
        if (confirm('opravdu smazat task z projektu: ' + value + '  započatý v: ' + time)) { /// t.getDate() + (t.getMonth()+1) )
            $.post('http://localhost/www/git/goodflow/gmr_timer/ajax.php', {'type': 'deltask', 'id': id, 'task': task}, function(data) {

                // console.log('provadim mazani tasku...');
                //console.log(data);

                window.location.reload();
            });
        }
    }

    // pouzity task
    function usedTask(id, task, state) {
        $.post('http://localhost/www/git/goodflow/gmr_timer/ajax.php', {'type': 'usedtask', 'id': id, 'task': task, 'state': state}, function(data) {
            // console.log(data);
        });
    }

    // zastaveni tasku
    function stopTask(id, task, value, time) {
        if (confirm('opravdu zastavit task z projektu: ' + value + ' započatý v: ' + time)) {
            $.post('http://localhost/www/git/goodflow/gmr_timer/ajax.php', {'type': 'stoptask', 'id': id, 'task': task}, function(data) {

                // console.log('hele stopnul jsem ulohu...');
                // console.log(data);

                window.location.reload();
            });
        }
    }

    // zapauzovani tasku
    function pauseTask(id, task) {
        $.post('http://localhost/www/git/goodflow/gmr_timer/ajax.php', {'type': 'pausetask', 'id': id, 'task': task}, function(data) {

            $('#pause_'+id+'_'+task).html( $('#pause_'+id+'_'+task).html() == 'Pozastavit' ? 'Pokračovat' : 'Pozastavit'); // Pozastavit / Pokračovat




            if ( $('#pause_'+id+'_'+task).html() == 'Pozastavit' ) {
               $('#pause_'+id+'_'+task).removeClass('btn-danger').addClass('btn-success');
            } else {
               $('#pause_'+id+'_'+task).removeClass('btn-success').addClass('btn-danger');
               // 'Pokračovat' : 'Pozastavit'
            }

            // console.log('hele zapauzoval jsem ulohu...');
            // console.log(data);

        });
    }

    // ulozeni textu tasku
    var tim = null;
    function saveDescription(id, task, value) {
        if (tim != null) {  // pokud je casovac pusteny nuluje
            clearTimeout(tim);
        }
        tim = setTimeout(function() {
            $.post('http://localhost/www/git/goodflow/gmr_timer/ajax.php', {'type': 'savedescription', 'id': id, 'task': task, 'description': value}, function(data) {
                // console.log('hele ulozil jsem poznamku...');
                // console.log(data);
                $('#save_info_box').fadeIn().html('Text byl uložen...').fadeOut();
            });
        }, 500); // interval checku na ulozeni textu
    }

    setInterval(function() {  // casova smycka
        $.post('http://localhost/www/git/goodflow/gmr_timer/ajax.php', {'type': 'activetask'}, function(data) {
            // console.log(data);
            var jdata = jQuery.parseJSON(data);

            var res = '';
            for (var proj in jdata) {
                // console.log(jdata[proj].list);

                res += '<div class="panel panel-primary">'+
    '<div class="panel-heading clearfix">'+
        '<h3 class="panel-title pull-left">' + jdata[proj].name + '</h3>'+
    '</div>'+
    '<div class="panel-body">';

                var poc = 0;
                for (var task in jdata[proj].list) {

                    if (poc > 0) {
                        res += '<hr>';
                    }

                    res += '<p class="now-projekt-time">' + jdata[proj].list[task].name + '</p>'+
                            '<p class="now-projekt-desc">' + jdata[proj].list[task].from + ' - ?</p>';

                    if (jdata[proj].list[task].state == 'pause') {
                        res +=
                        '<div class="panel panel-danger">'+
                            '<div class="panel-heading clearfix">'+
                            '<h3 class="panel-title pull-left">Pozastaveno' + jdata[proj].list[task].pause + '</h3>'+
                        '</div>'+
                        '<div class="panel-body">'+
                            '<div class="col-xs-6 time-pause">'+
                                '<p class="now-projekt-time">' + jdata[proj].list[task].current + '</p>'+
                                '<p class="now-projekt-desc">Čas pauzy</p>'+
                            '</div>'+
                            '<div class="col-xs-6 time-pause">'+
                                '<p class="now-projekt-time">' + jdata[proj].list[task].sum + '</p>'+
                                '<p class="now-projekt-desc">Celkový čas pauzy</p>'+
                            '</div>'+
                        '</div>'+
                    '</div>';
                    }
                    poc++;
                }

                res += '</div></div>';

            }

            $('#bezici_task').html(res);
        });
      }, 1000);