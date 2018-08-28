<div class='col padding-32 padding-large'>

    {if !$allow}
        <div class="col padding-bottom margin-bottom">
            <div class="z-depth-2 color-white radius border padding-large">
                Você pode fazer alterações entre os dias 1 e 4 do mês
            </div>
        </div>
    {/if}

    <div class='col'>
        <span class="left padding-medium font-light upper">
            {$total} {($total == 1) ? "usuário ativo" : "usuários ativos"}
        </span>
        <button class="right button theme opacity {(!$allow)?"disabled" : "hover-shadow hover-opacity-off"}"
                {($allow)? " onclick='addUsuario()'" : ""}>
            <i class="material-icons left padding-right">add</i>Usuário
        </button>
    </div>
    <table class='col margin-top border color-white radius table striped'>
        <thead class="col padding-4 padding-medium color-grey-light">
        <tr class="col">
            <th class="left padding-4 padding-medium">
                Nome
            </th>
            <th class="left padding-4 padding-medium">
                CPF
            </th>
            <th class="left padding-4 padding-medium">
                Data de Nascimento
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
                    <td class="left padding-xlarge">
                        {$u.cpf}
                    </td>
                    <td class="left padding-xlarge">
                        {$u.data_de_nascimento}
                    </td>
                    <td class="right">
                        {($u.status_do_convenio == 1) ? "<button class='button color-grey-light hover-color-red opacity {(!$allow)?"disabled" : "hover-opacity-off hover-shadow"}' onclick='desativarUsuario({$u.id})'>desativar</button>" : "<button class='button right color-grey-light hover-color-red opacity {(!$allow)?"disabled" : "hover-opacity-off hover-shadow"}' onclick='removerUsuario({$u.id})'>remover</button><button class='button theme opacity right {(!$allow)?"disabled" : "hover-opacity-off hover-shadow"}' onclick='ativarUsuario({$u.id})'>Ativar</button>"}
                    </td>
                </tr>
            {/foreach}
        {/if}
        </tbody>
    </table>
</div>