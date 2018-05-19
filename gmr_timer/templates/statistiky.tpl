<p>statistiky</p>

statistika za rok:<br />
{loop="$db->rawQuery('SELECT strftime(\'%Y\', start) rok FROM projects
                    JOIN tasks USING(idproject)
                    WHERE iduser=?
                    GROUP BY rok', array($iduser))" as $year}
    rok: {$year->rok}<br />

    {$sm = $crate->sqlSummaryTask('strftime(\'%Y\', start)=?', array($year->rok))}
    celkově: {$sm.sum}<br />
    čistý čas: {$sm.time}<br />
    pauzy: {$sm.pause}<br />
    {$sm.hours_sum}h, {$sm.hours_time}h, {$sm.hours_pause}h<br /><br />

{/loop}


<hr /><hr />


statistika za měsíce:<br />
{loop="$db->rawQuery('SELECT strftime(\'%Y\', start) rok FROM projects
                    JOIN tasks USING(idproject)
                    WHERE iduser=?
                    GROUP BY rok', array($iduser))" as $year}
    rok: {$year->rok}<br />

    {loop="$db->rawQuery('SELECT strftime(\'%m\', start) mesic FROM projects
                        JOIN tasks USING(idproject)
                        GROUP BY mesic
                        HAVING strftime(\'%Y\', start)=?', array($year->rok))" as $month}
        za mesic: {$month->mesic}<br />

        {$sm = $crate->sqlSummaryTask('strftime(\'%Y\', start)=? AND strftime(\'%m\', start)=?', array($year->rok, $month->mesic))}
        celkově: {$sm.sum}<br />
        čistý čas: {$sm.time}<br />
        pauzy: {$sm.pause}<br />
        {$sm.hours_sum}h, {$sm.hours_time}h, {$sm.hours_pause}h<br /><br />

    {/loop}

{/loop}

<hr /><hr />

statistika za týdny:<br />

{loop="$db->rawQuery('SELECT strftime(\'%Y\', start) rok FROM projects
                    JOIN tasks USING(idproject)
                    WHERE iduser=?
                    GROUP BY rok', array($iduser))" as $year}
    rok: {$year->rok}<br />

    {loop="$db->rawQuery('SELECT strftime(\'%W\', start) tyden FROM projects
                        JOIN tasks USING(idproject)
                        GROUP BY tyden
                        HAVING strftime(\'%Y\', start)=?', array($year->rok))" as $week}
        číslo týdne: {$week->tyden}<br />

        {$sm = $crate->sqlSummaryTask('strftime(\'%Y\', start)=? AND strftime(\'%W\', start)=?', array($year->rok, $week->tyden))}
        celkově: {$sm.sum}<br />
        čistý čas: {$sm.time}<br />
        pauzy: {$sm.pause}<br />
        {$sm.hours_sum}h, {$sm.hours_time}h, {$sm.hours_pause}h<br /><br />

    {/loop}

{/loop}


<hr /><hr />


statistika za dny:<br />

{loop="$db->rawQuery('SELECT strftime(\'%Y\', start) rok FROM projects
                    JOIN tasks USING(idproject)
                    WHERE iduser=?
                    GROUP BY rok', array($iduser))" as $year}
    rok: {$year->rok}<br />

    {loop="$db->rawQuery('SELECT strftime(\'%m\', start) mesic FROM projects
                        JOIN tasks USING(idproject)
                        GROUP BY mesic
                        HAVING strftime(\'%Y\', start)=?', array($year->rok))" as $month}
        za mesic: {$month->mesic}<br />

        {loop="$db->rawQuery('SELECT strftime(\'%d\', start) den FROM projects
                            JOIN tasks USING(idproject)
                            GROUP BY den
                            HAVING strftime(\'%Y\', start)=? AND strftime(\'%m\', start)=?', array($year->rok, $month->mesic))" as $day}
            za den: {$day->den}<br />

            {$sm = $crate->sqlSummaryTask('strftime(\'%Y\', start)=? AND strftime(\'%m\', start)=? AND strftime(\'%d\', start)=?', array($year->rok, $month->mesic, $day->den))}
            celkově: {$sm.sum}<br />
            čistý čas: {$sm.time}<br />
            pauzy: {$sm.pause}<br />
            {$sm.hours_sum}h, {$sm.hours_time}h, {$sm.hours_pause}h<br /><br />

        {/loop}

    {/loop}

{/loop}
