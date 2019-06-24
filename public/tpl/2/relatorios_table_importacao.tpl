<div class="col padding-12">
    total de <b>{$total}</b> resultados
</div>

<div class="col">
    <table class="table-all">
        <thead>
        <tr>
            <th>
                <span>Nome/Razão Social</span>
            </th>
            <th>
                <span>CPF/CNPJ</span>
            </th>
            <th>
                <span>Celular</span>
            </th>
            <th>
                <span>Consultor</span>
            </th>
            <th>
                <span>Plano</span>
            </th>
            <th>
                <span>Data do Contrato</span>
            </th>
            <th>
                <span>Vencimento</span>
            </th>
        </tr>
        </thead>
        <tbody class="relative" id="relatorioBody">
        {foreach key=i item=k from=$clientes}
            <tr>
                <td class="padding-16">
                    {(!empty($k.nome_completo)) ? $k.nome_completo : ((!empty($k.razao_social)) ? $k.razao_social : "")}
                </td>
                <td class="padding-16">
                    {(!empty($k.cpf)) ? $k.cpf : ((!empty($k.cnpj)) ? $k.cnpj : "")}
                </td>
                <td class="padding-16">
                    {$k.telefone}
                </td>
                <td class="padding-16">
                    {$k.consultor}
                </td>
                <td class="padding-16">
                    {$k.plano}
                </td>
                <td class="padding-16">
                    {$k.data_de_inicio}
                </td>
                <td class="padding-16">
                    {$k.dia_da_fatura}
                </td>
            </tr>
        {/foreach}
        </tbody>
    </table>
</div>