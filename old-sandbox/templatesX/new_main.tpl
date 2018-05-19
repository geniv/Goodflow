<!doctype html>
<html ng-app>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.6/angular.min.js"></script>
  </head>
  <body>
    <div>
      <label>Name:</label>
      <input type="text" ng-model="yourName" placeholder="Enter a name here">
      <hr>
      <h1>Hello {{yourName}} {$neco}!</h1>
    </div>
  </body>
</html>

{*$value|print_r:true*}
abc..

<div class="menu">
{loop="$tpl->getMenu()"}
    {if="!$value->hasMenu()"}
      -- <a href="{$value->allurl}">{$value->name}</a> [lvl: {$value->level}, act: {$value->active}]<br />
    {else}
      <ul class="sub">
      {loop="$value->menu"}
        <li><a href="{$value->allurl}">{$value->name}</a> [lvl: {$value->level}, act: {$value->active}]</li>
      {/loop}
      </ul>
  {/if}
{/loop}
</div>

