<div class='col padding-large s-padding-tiny s-padding-24 padding-32'>
    <div class='col card padding-medium'>
        {$form}
    </div>
    <div class='right margin-bottom padding-small font-bold font-xxlarge' id='descontoTotal'></div>
    <div class='right padding-small font-bold color-text-grey padding-xlarge font-large'
         id='descontoRecebidoTotal'></div>
    <div class='col border radius'>
        <h4 class='padding-medium theme-l3 upper'>Últimos Descontos Aplicados</h4>
        <div class='col padding-medium' id='credenciado-desconto-historico'>
            <ul></ul>
        </div>
        <div class='col hide' id='credenciado-desconto-historico-ref'></div>
        <div class='col align-center'><i class='material-icons padding-medium pointer' onclick='readMoreHistoryDesc()'>keyboard_arrow_down</i>
        </div>
    </div>
</div>