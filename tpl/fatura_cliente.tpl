<div class="col padding-small" style="background: {$back}">
    <div class="col s12 m9 padding-small">
        <div class="col s12 m4 l2 padding-medium">
            {$data}
        </div>
        <div class="col s12 m8 l10 padding-medium">
            {$descricao}
        </div>
    </div>
    <div class="col s12 m3 padding-small align-right">
        {if $status == 1}
            <span class="opacity color-grey-light right">PAGO</span>
        {else}
            <a href="{$home}fatura&i={$id}" target="_blank" class="btn theme opacity hover-opacity-off hover-shadow radius right">PAGAR</a>
        {/if}
        <div class='color-text-grey right padding-medium'>
            R$<b class="checkBoxValor">{$valor}</b>
        </div>
    </div>
</div>