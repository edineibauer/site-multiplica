<div class='col padding-12 padding-large'>
    <div class="col padding-bottom margin-bottom">
        <div class="col padding-medium">
            <button class="btn-floating color-grey opacity hover-shadow hover-opacity-off right" onclick="goFuncionarios()">
                <i class="material-icons">arrow_back</i>
            </button>
        </div>
        <div class="z-depth-2 color-white radius border padding-xxlarge col">

            {if !empty($clientes_juridicos) && $clientes_juridicos.id}
                {* Já esta Associado a sua conta *}

                <b>{$nome_completo}</b> já esta em sua lista de conveniados!

            {else}
                <b>{$nome_completo}</b>
                já possúi uma conta
                {(!empty($plano) && $plano.status == "1") ? "<b style='color:green'>ATIVA</b>" : ""}
                na {$sitename}!
                {if !empty($clientes_juridicos)}
                    com associação a Empresa
                    <b>{$clientes_juridicos.nome}</b>
                    .</p>
                {/if}
                {if empty($plano) || $plano.status == "0"}
                    <br>
                    <br>
                    <button class="btn theme opacity hover-opacity-off hover-shadow"
                            onclick="addUsuarioExistente({$id})">
                        Adicionar {$nome_completo}
                    </button>
                {else}
                    <br>
                    <p>Enquanto o plano estiver <b>ATIVO</b>. Você não poderá associá-lo a sua empresa!</p>
                    <p>
                        entre em contato com
                        {if !empty($clientes_juridicos)}
                            a empresa {(!empty($clientes_juridicos.tel)) ? "através do telefone: {$clientes_juridicos.tel}," : ""}
                            {(!empty($clientes_juridicos.email))? "pelo email: {$clientes_juridicos.email}." : ""}
                        {else}
                            {$nome_completo} {(!empty($telefone)) ? "através do telefone: {$telefone}," : ""}
                            {(!empty($email))? "pelo email: {$email}." : ""}
                        {/if}
                    </p>
                {/if}
            {/if}
        </div>
    </div>
</div>