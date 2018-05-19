{code}
$form = $tplform::compile('
Název
{text:nazev;#}<br />
Barva #1
{text:barva1}<br />
Barva #2
{text:barva2}<br />
Barva #3
{text:barva3}<br />
{submit:;Vygenerovat}
  ')->setReturnValues($_POST);
{/code}

{$form}

{if="$form->isSubmitted()"}
  {$val = $form->getValues()}
<pre>
.btn-{$val.nazev} {
    border-color: #000;
    background-image: -ms-linear-gradient(top, {$val.barva1}, {$val.barva2});
    background-image: -webkit-gradient(linear, 0 0, 0 100%, from({$val.barva1}), to({$val.barva2}));
    background-image: -webkit-linear-gradient(top, {$val.barva1}, {$val.barva2});
    background-image: -o-linear-gradient(top, {$val.barva1}, {$val.barva2});
    background-image: -moz-linear-gradient(top, {$val.barva1}, {$val.barva2});
    background-image: linear-gradient(top, {$val.barva1}, {$val.barva2});
}

.btn-{$val.nazev}:hover,
.btn-{$val.nazev}:active,
.btn-{$val.nazev}.active,
.btn-{$val.nazev}.disabled,
.btn-{$val.nazev}[disabled] {
    background: {$val.barva3};
}
</pre>
{/if}