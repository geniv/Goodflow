..strankovani..<br />
<br />
{* libovolny dotaz z dazabaze nebo pole... *}
{$source = range(1, 76)}

{code}
  $paginator = $paginator_class::init(count($source), 5)->setPage(isset($uri['number']) ? $uri['number'] : 1);
{/code}

visible: {$paginator->isVisible()}<br />

{if="!$paginator->isFirst()"}<a href="{$weburl}page/{$paginator->getFirstPage()}">prvni</a>{/if}
{if="$paginator->isPrev()"}<a href="{$weburl}page/{$paginator->getPrevPage()}">předchozí <<< </a>{/if}

{*loop="$paginator->render()"*}
{*loop="$paginator->render($paginator::TYPE1)"*}
{*loop="$paginator->render($paginator::TYPE2)"*}
{*loop="$paginator->render($paginator::TYPE3)"*}
{*loop="$paginator->render($paginator::TYPE1, array('koeficient' => 5))"*}
{*loop="$paginator->render($paginator::TYPE1, array('koeficient' => 5, 'range' => 2))"*}
{loop="$paginator->render($paginator::TYPE3, array('range' => 10))"}
  {if="$paginator->getPage()==$value"}[[{/if}<a href="{$weburl}page/{$value}">{$value}</a>{if="$paginator->getPage()==$value"}]]{/if}
{/loop}

{if="$paginator->isNext()"}<a href="{$weburl}page/{$paginator->getNextPage()}"> >>> další</a>{/if}
{if="!$paginator->isLast()"}<a href="{$weburl}page/{$paginator->getLastPage()}">posledni</a>{/if}

<br />
page: {$paginator->getPage()} / {$paginator->getPageCount()}
<br />
sql: {$paginator->getLimit()}

<hr /><hr />

{loop="$paginator->getArraySlice($source)"}
  velky row: {$value} ({$key})<hr />
{/loop}
