<div class='col padding-32 padding-large'>
    <div class='col'>
        <span class="left padding-medium font-light upper">
            FATURAS
        </span>
    </div>
    <table class='col margin-top border color-white radius table striped'>
        <thead class="col padding-4 padding-medium color-grey-light">
        <tr class="col">
            <th class="left padding-4 padding-medium">
                dia
            </th>
            <th class="left padding-4 padding-medium" style="margin-left: 92px">
                Usuários
            </th>
            <th class="right align-right padding-4 padding-medium" style="margin-left: 40px">
                Ação
            </th>
            <th class="right padding-4 padding-medium">
                Valor
            </th>
        </tr>
        </thead>
        <tbody>
        {foreach key=k item=f from=$faturas}
            <tr class="col">
                <td class="left padding-xlarge">
                    {$f.data}
                </td>
                <td class="left padding-xlarge" style="max-width: 520px">
                    {$f.descricao}
                </td>
                <td class="right">
                    {($f.status == 1) ? "<button class='button color-grey-light hover-color-red opacity hover-opacity-off hover-shadow'>Pago</button>" : "<a href='{$home}fatura&i={$f.id}' target='_blank' class='button theme opacity hover-opacity-off hover-shadow'>Pagar</a>"}
                </td>
                <td class="right padding-xlarge">
                    R$<b class="checkBoxValor">{$f.valor}</b>
                </td>
            </tr>
        {/foreach}
        </tbody>
    </table>
</div>