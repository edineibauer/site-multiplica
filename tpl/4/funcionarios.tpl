<div class='col padding-32 padding-large'>
    <div class='col'>
        <span class="left padding-medium font-light upper">
            {$total} funcionário{($total == 1) ? "" : "s"}
        </span>
        <button class="right button theme opacity hover-shadow hover-opacity-off" onclick='addFuncionario()'>
            <i class="material-icons left padding-right">add</i>Funcionário
        </button>
    </div>
    <table class='col margin-top border color-white radius table striped'>
        <thead class="col padding-4 padding-medium color-grey-light">
        <tr class="col">
            <th class="left padding-4 padding-medium">
                Nome
            </th>
            <th class="right align-right padding-4 padding-medium">
                Ação
            </th>
        </tr>
        </thead>
        <tbody>
        {if $usuarios}
            {foreach key=k item=u from=$usuarios}
                <tr class="col">
                    <td class="left padding-xlarge">
                        {$u.nome_completo}
                    </td>
                    <td class="right">
                        <button class='button right color-grey-light hover-color-red opacity hover-opacity-off hover-shadow' onclick='removerFuncionario({$u.id})'>remover</button>
                    </td>
                </tr>
            {/foreach}
        {/if}
        </tbody>
    </table>
</div>