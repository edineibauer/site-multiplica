<div class="col padding-24">

    <div class="col padding-small padding-12">
        {foreach $categorias as $e => $cat}
            <div class="col" style="width: auto; padding:0 5px 0 0">
                <div class="card col padding-medium pointer hover-shadow upper"
                     onclick="partnerFilter({$e})">{$cat}</div>
            </div>
        {/foreach}
    </div>

    {foreach $dados as $dado}
        <div class="col s12 m6 l3 padding-small partner-card"
             rel="[100000{foreach $dado.especialidades as $i => $esp}{if !empty($esp.categoria)},{$esp.categoria}{/if}{/foreach}]">
            <div class="card col">
                <div class="col margin-bottom">
                <span class="col font-small theme padding-small padding-bottom font-bold">
                    <span class="left">{$dado.bairro}</span>
                    <span class="right">{$dado.cidade}/{$dado.estado}</span>
                </span>
                    <h4 class="padding-medium theme-l1 upper" style="line-height: 25px;height: 70px; overflow: hidden">
                        {($dado.tipo === 1)? $dado.nome : $dado.razao_social}
                    </h4>
                    <span class="col padding-medium padding-4 color-gray-light" style="height: 55px;overflow: hidden">
                        <span class="col">tel:&nbsp;&nbsp;{$dado.telefone}</span>
                        <span class="col">{$dado.email}</span>
                    </span>
                </div>
                <ul class="col" style="height: 200px; overflow-x:hidden; overflow-y: auto">
                    {foreach $dado.especialidades as $i => $esp}
                        <li class="col" style="background: {($i%2 === 0) ? "white": "#eee"}">
                            <span class="col right" style="width: 35px">{$esp.desconto|substr:0:2}%</span>
                            <span class="rest">{$esp.especialidade}</span>
                        </li>
                    {/foreach}
                </ul>
            </div>
        </div>
    {/foreach}
</div>

<script>
    function partnerFilter(id) {
        $(".partner-card").addClass("hide");
        $.each($(".partner-card"), function () {
            let $this = $(this);
            let rel = $this.attr("rel").replace("[100000,", "[");
            rel = JSON.parse(rel);
            if (rel.length) {
                if (rel.indexOf(id) > -1)
                    $this.removeClass("hide");
            }
        });
    }
</script>
