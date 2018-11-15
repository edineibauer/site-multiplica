<table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%"
       id="m_5372895143664279880bodyTable"
       style="border-collapse:collapse;height:100%;margin:0;padding:0;width:100%;background-color:{$theme}">
    <tbody>
    <tr>
        <td align="center" valign="top" id="m_5372895143664279880bodyCell"
            style="height:100%;margin:0;padding:0;width:100%;border-top:0">

            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse">
                <tbody>
                <tr>
                    <td align="center" valign="top" id="m_5372895143664279880templatePreheader"
                        style="background:{$theme} none no-repeat center/cover;background-color:{$theme};background-image:none;background-repeat:no-repeat;background-position:center;background-size:cover;border-top:0;border-bottom:0;padding-top:20px;padding-bottom:20px">

                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
                               class="m_5372895143664279880templateContainer"
                               style="border-collapse:collapse;max-width:600px!important">
                            <tbody>
                            <tr>
                                <td valign="top" class="m_5372895143664279880preheaderContainer">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                           class="m_5372895143664279880mcnImageBlock"
                                           style="min-width:100%;border-collapse:collapse">
                                        <tbody class="m_5372895143664279880mcnImageBlockOuter">
                                        <tr>
                                            <td valign="top" style="padding:0px"
                                                class="m_5372895143664279880mcnImageBlockInner">
                                                <table align="left" width="100%" border="0" cellpadding="0"
                                                       cellspacing="0"
                                                       class="m_5372895143664279880mcnImageContentContainer"
                                                       style="min-width:100%;border-collapse:collapse">
                                                    <tbody>
                                                    <tr>
                                                        <td class="m_5372895143664279880mcnImageContent" valign="top"
                                                            style="padding-right:0px;padding-left:0px;padding-top:0;padding-bottom:0;text-align:center">

                                                            <a href="{$home}" title="" target="_blank"
                                                               data-saferedirecturl="https://www.google.com/url?q={$home}">
                                                                <img align="center" alt=""
                                                                     src="{$logo}"
                                                                     width="179"
                                                                     style="max-width:179px;padding-bottom:0;display:inline!important;vertical-align:bottom;border:0;height:auto;outline:none;text-decoration:none"
                                                                     class="m_5372895143664279880mcnImage CToWUd">
                                                            </a>

                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top" id="m_5372895143664279880templateHeader"
                        style="background:rgba(0,0,0,0.5){if isset($background)} url(&quot;{$background}&quot;) no-repeat center/cover{/if};background-color:rgba(0,0,0,0.5);{if isset($background)}background-image:url({$background});background-repeat:no-repeat;background-position:center;background-size:cover;{/if}border-top:0;border-bottom:0;padding-top:80px;padding-bottom:40px">

                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
                               class="m_5372895143664279880templateContainer"
                               style="border-collapse:collapse;max-width:600px!important">
                            <tbody>
                            <tr>
                                <td valign="top" class="m_5372895143664279880headerContainer">
                                    {if isset($image)}
                                        {if isset($image.image)}
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                                   class="m_5372895143664279880mcnImageBlock"
                                                   style="min-width:100%;border-collapse:collapse">
                                                <tbody class="m_5372895143664279880mcnImageBlockOuter">
                                                <tr>
                                                    <td valign="top" style="padding:9px"
                                                        class="m_5372895143664279880mcnImageBlockInner">
                                                        <table align="left" width="100%" border="0" cellpadding="0"
                                                               cellspacing="0"
                                                               class="m_5372895143664279880mcnImageContentContainer"
                                                               style="min-width:100%;border-collapse:collapse">
                                                            <tbody>
                                                            <tr>
                                                                <td class="m_5372895143664279880mcnImageContent"
                                                                    valign="top"
                                                                    style="padding-right:9px;padding-left:9px;padding-top:0;padding-bottom:0;text-align:center">

                                                                    <a href="{(isset($image.url))? $image.url : $home}"
                                                                       title="" target="_blank"
                                                                       data-saferedirecturl="https://www.google.com/url?q={(isset($image.url))? $image.url : $home}">
                                                                        <img align="center" alt=""
                                                                             src="{$image.image}"
                                                                             width="400"
                                                                             style="max-width:400px;padding-bottom:0;display:inline!important;vertical-align:bottom;border:0;height:auto;outline:none;text-decoration:none"
                                                                             class="m_5372895143664279880mcnImage CToWUd">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        {else}
                                            {foreach key=i item=k from=$image}
                                                {if isset($k.image)}
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                                           class="m_5372895143664279880mcnImageBlock"
                                                           style="min-width:100%;border-collapse:collapse">
                                                        <tbody class="m_5372895143664279880mcnImageBlockOuter">
                                                        <tr>
                                                            <td valign="top" style="padding:9px"
                                                                class="m_5372895143664279880mcnImageBlockInner">
                                                                <table align="left" width="100%" border="0"
                                                                       cellpadding="0"
                                                                       cellspacing="0"
                                                                       class="m_5372895143664279880mcnImageContentContainer"
                                                                       style="min-width:100%;border-collapse:collapse">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td class="m_5372895143664279880mcnImageContent"
                                                                            valign="top"
                                                                            style="padding-right:9px;padding-left:9px;padding-top:0;padding-bottom:0;text-align:center">

                                                                            <a href="{(isset($k.url))? $k.url : $home}"
                                                                               title="" target="_blank"
                                                                               data-saferedirecturl="https://www.google.com/url?q={(isset($k.url))? $k.url : $home}">
                                                                                <img align="center" alt=""
                                                                                     src="{$k.image}"
                                                                                     width="400"
                                                                                     style="max-width:400px;padding-bottom:0;display:inline!important;vertical-align:bottom;border:0;height:auto;outline:none;text-decoration:none"
                                                                                     class="m_5372895143664279880mcnImage CToWUd">
                                                                            </a>

                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                {/if}
                                            {/foreach}
                                        {/if}
                                    {/if}
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                           class="m_5372895143664279880mcnTextBlock"
                                           style="min-width:100%;border-collapse:collapse">
                                        <tbody class="m_5372895143664279880mcnTextBlockOuter">
                                        <tr>
                                            <td valign="top" class="m_5372895143664279880mcnTextBlockInner"
                                                style="padding-top:9px">


                                                <table align="left" border="0" cellpadding="0" cellspacing="0"
                                                       style="max-width:100%;min-width:100%;border-collapse:collapse"
                                                       width="100%"
                                                       class="m_5372895143664279880mcnTextContentContainer">
                                                    <tbody>
                                                    <tr>

                                                        <td valign="top" class="m_5372895143664279880mcnTextContent"
                                                            style="padding-top:0;padding-right:18px;padding-bottom:9px;padding-left:18px;word-break:break-word;color:#ffffff;font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;line-height:150%;text-align:center">

                                                            <h2 class="m_5372895143664279880null"
                                                                style="display:block;margin:0;padding:0;color:#ffffff;font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:30px;font-style:normal;font-weight:bold;line-height:125%;letter-spacing:normal;text-align:center">
                                                                <span style="font-size:40px">
                                                                    {$title}
                                                                </span>
                                                            </h2>

                                                            <p style="margin:10px 0;padding:0;color:#ffffff;font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;line-height:150%;text-align:center">
                                                                {$content}
                                                            </p>

                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>


                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    {if isset($btn)}
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                               class="m_5372895143664279880mcnButtonBlock"
                                               style="min-width:100%;border-collapse:collapse">
                                            <tbody class="m_5372895143664279880mcnButtonBlockOuter">
                                            <tr>
                                                <td style="padding-top:0;padding-right:18px;padding-bottom:18px;padding-left:18px"
                                                    valign="top" align="center"
                                                    class="m_5372895143664279880mcnButtonBlockInner">
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                                           class="m_5372895143664279880mcnButtonContentContainer"
                                                           style="border-collapse:separate!important;border:1px solid rgba(255,255,255, 0.1);border-radius:2px;background-color:rgba(255,255,255, 0.1)">
                                                        <tbody>
                                                        <tr>
                                                            <td align="center" valign="middle"
                                                                class="m_5372895143664279880mcnButtonContent"
                                                                style="font-family:&quot;Open Sans&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:14px;padding:15px">
                                                                {if isset($url)}
                                                                    <a title="COMPRAR AGORA!"
                                                                       href="{$url}"
                                                                       style="font-weight:bold;letter-spacing:normal;line-height:100%;text-align:center;text-decoration:none;color:#ffffff;display:block"
                                                                       target="_blank"
                                                                       data-saferedirecturl="https://www.google.com/url?q={$url}">
                                                                        {/if}
                                                                    {$btn}
                                                                    {if isset($url)}
                                                                    </a>
                                                                {/if}
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    {/if}
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </td>
                </tr>
                {if isset($related)}
                    <tr>
                        <td align="center" valign="top" id="m_5372895143664279880templateBody"
                            style="background:{$theme} none no-repeat center/cover;background-color:{$theme};background-image:none;background-repeat:no-repeat;background-position:center;background-size:cover;border-top:0;border-bottom:0;padding-top:20px;padding-bottom:0">

                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
                                   class="m_5372895143664279880templateContainer"
                                   style="border-collapse:collapse;max-width:600px!important">
                                <tbody>
                                <tr>
                                    <td valign="top" class="m_5372895143664279880bodyContainer">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                               class="m_5372895143664279880mcnCaptionBlock"
                                               style="border-collapse:collapse">
                                            <tbody class="m_5372895143664279880mcnCaptionBlockOuter">
                                            <tr>
                                                <td class="m_5372895143664279880mcnCaptionBlockInner" valign="top"
                                                    style="padding:9px">


                                                    <table align="left" border="0" cellpadding="0" cellspacing="0"
                                                           class="m_5372895143664279880mcnCaptionBottomContent"
                                                           width="282"
                                                           style="border-collapse:collapse">
                                                        <tbody>
                                                        <tr>
                                                            <td class="m_5372895143664279880mcnCaptionBottomImageContent"
                                                                align="center" valign="top"
                                                                style="padding:0 9px 9px 9px">


                                                                <a href="https://nuuvem.us4.list-manage.com/track/click?u=c38947ad4cbb7a03997e53a0b&amp;id=04583689c7&amp;e=54a8c8f101"
                                                                   title="" target="_blank"
                                                                   data-saferedirecturl="https://www.google.com/url?q=https://nuuvem.us4.list-manage.com/track/click?u%3Dc38947ad4cbb7a03997e53a0b%26id%3D04583689c7%26e%3D54a8c8f101&amp;source=gmail&amp;ust=1535571759061000&amp;usg=AFQjCNFWipELQsZhBza-EosgMdqj6VZSvQ">


                                                                    <img alt=""
                                                                         src="https://ci6.googleusercontent.com/proxy/M-pcqQZKb0JbTET9CU7gMJi7dpWuyKgbS1ZePcRWwN7nFeJSexrtTcIEiaPPDLBi6QXuKfhiabuKjr_MQQxmQ8zlzeJZ-cWDO6G9LFdShn8oBuDLcvKwVGAHjtjASo_K_Wd5WMHDWsoE7nHXyro7UEycJfD7eDfLQpfwTks=s0-d-e1-ft#https://gallery.mailchimp.com/c38947ad4cbb7a03997e53a0b/images/fd3eed3e-4fc5-4f2e-9b6e-33a221034e9b.jpg"
                                                                         width="264"
                                                                         style="max-width:799px;border:0;height:auto;outline:none;text-decoration:none;vertical-align:bottom"
                                                                         class="m_5372895143664279880mcnImage CToWUd">
                                                                </a>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="m_5372895143664279880mcnTextContent" valign="top"
                                                                style="padding:0px 9px;font-family:&quot;Open Sans&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;line-height:125%;text-align:left;word-break:break-word;color:#96a6b7;font-size:16px"
                                                                width="282">
                                                                <div style="margin-bottom:20px"><span
                                                                            style="font-size:14px"><strong><span
                                                                                    style="color:#fe6665;text-transform:uppercase">27% de Desconto</span></strong></span><br>
                                                                    <span style="font-size:16px"><span
                                                                                style="color:#ffffff;text-transform:uppercase">Usando o cupom </span><strong><span
                                                                                    style="color:#f90"><span
                                                                                        style="text-transform:uppercase">HEXAVEM</span></span></strong></span>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>

                                                    <table align="right" border="0" cellpadding="0" cellspacing="0"
                                                           class="m_5372895143664279880mcnCaptionBottomContent"
                                                           width="282"
                                                           style="border-collapse:collapse">
                                                        <tbody>
                                                        <tr>
                                                            <td class="m_5372895143664279880mcnCaptionBottomImageContent"
                                                                align="center" valign="top"
                                                                style="padding:0 9px 9px 9px">


                                                                <a href="https://nuuvem.us4.list-manage.com/track/click?u=c38947ad4cbb7a03997e53a0b&amp;id=335fcb0ea8&amp;e=54a8c8f101"
                                                                   title="" target="_blank"
                                                                   data-saferedirecturl="https://www.google.com/url?q=https://nuuvem.us4.list-manage.com/track/click?u%3Dc38947ad4cbb7a03997e53a0b%26id%3D335fcb0ea8%26e%3D54a8c8f101&amp;source=gmail&amp;ust=1535571759061000&amp;usg=AFQjCNHuJk5zkDT16qD4gQlX8i9NFVZCHA">


                                                                    <img alt=""
                                                                         src="https://ci5.googleusercontent.com/proxy/04yYy3BSUscMRvypXV-Pd5EQQrdavqCnyG5fbI_8s3SFDR6LOV0RSRXpbYviaL1tzzxoPuSB-OjSae3aGn5E1e2tdL5ou_Io14ktKuXZm5_1zJYFX1X4X4pqy9BAf6zOQ14-AOc-X1wIjme-rEkNnkrirTSp53Bwv6RtprM=s0-d-e1-ft#https://gallery.mailchimp.com/c38947ad4cbb7a03997e53a0b/images/30200ea1-c8c8-4fa6-bc55-559fc47bb950.jpg"
                                                                         width="264"
                                                                         style="max-width:799px;border:0;height:auto;outline:none;text-decoration:none;vertical-align:bottom"
                                                                         class="m_5372895143664279880mcnImage CToWUd">
                                                                </a>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="m_5372895143664279880mcnTextContent" valign="top"
                                                                style="padding:0px 9px;font-family:&quot;Open Sans&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;line-height:125%;text-align:left;word-break:break-word;color:#96a6b7;font-size:16px"
                                                                width="282">
                                                                <div><strong><span
                                                                                style="color:#fe6665;text-transform:uppercase">80% de Desconto</span></strong><br>
                                                                    <span style="color:#ffffff;font-size:12px;text-transform:uppercase">Últimas horas!</span>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>


                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                               class="m_5372895143664279880mcnCaptionBlock"
                                               style="border-collapse:collapse">
                                            <tbody class="m_5372895143664279880mcnCaptionBlockOuter">
                                            <tr>
                                                <td class="m_5372895143664279880mcnCaptionBlockInner" valign="top"
                                                    style="padding:9px">


                                                    <table align="left" border="0" cellpadding="0" cellspacing="0"
                                                           class="m_5372895143664279880mcnCaptionBottomContent"
                                                           width="282"
                                                           style="border-collapse:collapse">
                                                        <tbody>
                                                        <tr>
                                                            <td class="m_5372895143664279880mcnCaptionBottomImageContent"
                                                                align="center" valign="top"
                                                                style="padding:0 9px 9px 9px">


                                                                <a href="https://nuuvem.us4.list-manage.com/track/click?u=c38947ad4cbb7a03997e53a0b&amp;id=4ec22608e2&amp;e=54a8c8f101"
                                                                   title="" target="_blank"
                                                                   data-saferedirecturl="https://www.google.com/url?q=https://nuuvem.us4.list-manage.com/track/click?u%3Dc38947ad4cbb7a03997e53a0b%26id%3D4ec22608e2%26e%3D54a8c8f101&amp;source=gmail&amp;ust=1535571759061000&amp;usg=AFQjCNFnQR56QgWmtR_ir35SF7cqS4y3NQ">


                                                                    <img alt=""
                                                                         src="https://ci4.googleusercontent.com/proxy/qyNXeDv6Acg5G2dzcYoQ3oD0rvZMuIQ0pekNJv1fdm9YU7iqNFY2rupiVdeS6Ms3ssLQad5RInQowPSHd4mCs9cwJM4iiaAJPyUtnSALTSKD5OTZ6GnCefNwbk1vj5g47aPTFf7a7NBeTRTgsNvGNDvwhsN-q5Vmj88q_IQ=s0-d-e1-ft#https://gallery.mailchimp.com/c38947ad4cbb7a03997e53a0b/images/e4ab14e3-7857-4f03-a618-39d061431691.jpg"
                                                                         width="264"
                                                                         style="max-width:799px;border:0;height:auto;outline:none;text-decoration:none;vertical-align:bottom"
                                                                         class="m_5372895143664279880mcnImage CToWUd">
                                                                </a>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="m_5372895143664279880mcnTextContent" valign="top"
                                                                style="padding:0px 9px;font-family:&quot;Open Sans&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;line-height:125%;text-align:left;word-break:break-word;color:#96a6b7;font-size:16px"
                                                                width="282">
                                                                <div style="margin-bottom:20px"><strong><span
                                                                                style="color:#fe6665;text-transform:uppercase">8% de desconto</span></strong><br>
                                                                    <span style="color:#ffffff;font-size:12px;text-transform:uppercase">Pré-venda</span>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>

                                                    <table align="right" border="0" cellpadding="0" cellspacing="0"
                                                           class="m_5372895143664279880mcnCaptionBottomContent"
                                                           width="282"
                                                           style="border-collapse:collapse">
                                                        <tbody>
                                                        <tr>
                                                            <td class="m_5372895143664279880mcnCaptionBottomImageContent"
                                                                align="center" valign="top"
                                                                style="padding:0 9px 9px 9px">


                                                                <a href="https://nuuvem.us4.list-manage.com/track/click?u=c38947ad4cbb7a03997e53a0b&amp;id=0b138bf2a0&amp;e=54a8c8f101"
                                                                   title="" target="_blank"
                                                                   data-saferedirecturl="https://www.google.com/url?q=https://nuuvem.us4.list-manage.com/track/click?u%3Dc38947ad4cbb7a03997e53a0b%26id%3D0b138bf2a0%26e%3D54a8c8f101&amp;source=gmail&amp;ust=1535571759062000&amp;usg=AFQjCNHIlqOfLzW8DDjzPx0SFPEQtb3FFQ">


                                                                    <img alt=""
                                                                         src="https://ci6.googleusercontent.com/proxy/nddVzqjtWCpzpgRSR89AO1e6vjOO-k1wJ1sIby_PcUSi9lLSmpimuY0dzwKDiXiOyqxuP6UEeJk_NirXJ3GAybdCqqrEbuAAA-tdiH2djsZIERCQEsULkzdHPpJgGs_GFdALOeyzpcdO5KMk1HQBfPtOO5eQNfAF4CDs4O8=s0-d-e1-ft#https://gallery.mailchimp.com/c38947ad4cbb7a03997e53a0b/images/be7e543b-6a43-44ac-8705-a461efa1ebc0.jpg"
                                                                         width="264"
                                                                         style="max-width:799px;border:0;height:auto;outline:none;text-decoration:none;vertical-align:bottom"
                                                                         class="m_5372895143664279880mcnImage CToWUd">
                                                                </a>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="m_5372895143664279880mcnTextContent" valign="top"
                                                                style="padding:0px 9px;font-family:&quot;Open Sans&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;line-height:125%;text-align:left;word-break:break-word;color:#96a6b7;font-size:16px"
                                                                width="282">
                                                                <div><strong><span
                                                                                style="color:#fe6665;text-transform:uppercase">8% de desconto</span></strong><br>
                                                                    <span style="color:#ffffff;font-size:12px;text-transform:uppercase">Pré-venda</span>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>


                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                               class="m_5372895143664279880mcnDividerBlock"
                                               style="min-width:100%;border-collapse:collapse;table-layout:fixed!important">
                                            <tbody class="m_5372895143664279880mcnDividerBlockOuter">
                                            <tr>
                                                <td class="m_5372895143664279880mcnDividerBlockInner"
                                                    style="min-width:100%;padding:20px 18px">
                                                    <table class="m_5372895143664279880mcnDividerContent" border="0"
                                                           cellpadding="0" cellspacing="0" width="100%"
                                                           style="min-width:100%;border-top:1px dotted rgba(0,0,0,0.5);border-collapse:collapse">
                                                        <tbody>
                                                        <tr>
                                                            <td>
                                                                <span></span>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>

                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                               class="m_5372895143664279880mcnImageBlock"
                                               style="min-width:100%;border-collapse:collapse">
                                            <tbody class="m_5372895143664279880mcnImageBlockOuter">
                                            <tr>
                                                <td valign="top" style="padding:0px"
                                                    class="m_5372895143664279880mcnImageBlockInner">
                                                    <table align="left" width="100%" border="0" cellpadding="0"
                                                           cellspacing="0"
                                                           class="m_5372895143664279880mcnImageContentContainer"
                                                           style="min-width:100%;border-collapse:collapse">
                                                        <tbody>
                                                        <tr>
                                                            <td class="m_5372895143664279880mcnImageContent"
                                                                valign="top"
                                                                style="padding-right:0px;padding-left:0px;padding-top:0;padding-bottom:0;text-align:center">

                                                                <a href="https://nuuvem.us4.list-manage.com/track/click?u=c38947ad4cbb7a03997e53a0b&amp;id=679025e586&amp;e=54a8c8f101"
                                                                   title="" target="_blank"
                                                                   data-saferedirecturl="https://www.google.com/url?q=https://nuuvem.us4.list-manage.com/track/click?u%3Dc38947ad4cbb7a03997e53a0b%26id%3D679025e586%26e%3D54a8c8f101&amp;source=gmail&amp;ust=1535571759062000&amp;usg=AFQjCNGHHcHNb2qTYRxtUoTZKKOphsGd0Q">
                                                                    <img align="center" alt=""
                                                                         src="https://ci3.googleusercontent.com/proxy/894U7Hwc7rmd10V8FjVzQwBxA0qEFHt6vsBh1kbzPwCewlvxSOy0tvhzGEuq6bWNsyHQ4MyKOlJHU-FkOduIbPcPBFRoAHz750ZM9gxPqPtGqY5OajnnP_MB4iUF3-1157kkiKUXFWsU020192Ln8Q3pxOl6voDra5mR2s4=s0-d-e1-ft#https://gallery.mailchimp.com/c38947ad4cbb7a03997e53a0b/images/ee4ff6ba-f7b7-49d5-89b4-9a970351af86.jpg"
                                                                         width="600"
                                                                         style="max-width:600px;padding-bottom:0;display:inline!important;vertical-align:bottom;border:0;height:auto;outline:none;text-decoration:none"
                                                                         class="m_5372895143664279880mcnImage CToWUd">
                                                                </a>

                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                               class="m_5372895143664279880mcnDividerBlock"
                                               style="min-width:100%;border-collapse:collapse;table-layout:fixed!important">
                                            <tbody class="m_5372895143664279880mcnDividerBlockOuter">
                                            <tr>
                                                <td class="m_5372895143664279880mcnDividerBlockInner"
                                                    style="min-width:100%;padding:20px 18px">
                                                    <table class="m_5372895143664279880mcnDividerContent" border="0"
                                                           cellpadding="0" cellspacing="0" width="100%"
                                                           style="min-width:100%;border-top:1px dotted rgba(0,0,0,0.5);border-collapse:collapse">
                                                        <tbody>
                                                        <tr>
                                                            <td>
                                                                <span></span>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>

                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                               class="m_5372895143664279880mcnCaptionBlock"
                                               style="border-collapse:collapse">
                                            <tbody class="m_5372895143664279880mcnCaptionBlockOuter">
                                            <tr>
                                                <td class="m_5372895143664279880mcnCaptionBlockInner" valign="top"
                                                    style="padding:9px">


                                                    <table align="left" border="0" cellpadding="0" cellspacing="0"
                                                           class="m_5372895143664279880mcnCaptionBottomContent"
                                                           width="282"
                                                           style="border-collapse:collapse">
                                                        <tbody>
                                                        <tr>
                                                            <td class="m_5372895143664279880mcnCaptionBottomImageContent"
                                                                align="center" valign="top"
                                                                style="padding:0 9px 9px 9px">


                                                                <a href="https://nuuvem.us4.list-manage.com/track/click?u=c38947ad4cbb7a03997e53a0b&amp;id=741959725f&amp;e=54a8c8f101"
                                                                   title="" target="_blank"
                                                                   data-saferedirecturl="https://www.google.com/url?q=https://nuuvem.us4.list-manage.com/track/click?u%3Dc38947ad4cbb7a03997e53a0b%26id%3D741959725f%26e%3D54a8c8f101&amp;source=gmail&amp;ust=1535571759062000&amp;usg=AFQjCNFD0lgjrzDyTwzdVAHZweJ7X1lFNQ">


                                                                    <img alt=""
                                                                         src="https://ci4.googleusercontent.com/proxy/8e4OINNDCG0_EIiNZaUU3YJfX1kIsm1VJIYGTMG1ERU8-f3-XfShJtkgrkXcQHXCY3Ak0XWgMOJS_VK3EJbM2zLdYmVeIh5r7ThHc6UbDgO7ArXbE_9O5gvq57qRVJ8Rmcl1Wkkt7mVYogiCGVrs48UkkL8bbgJljnZ0Q1o=s0-d-e1-ft#https://gallery.mailchimp.com/c38947ad4cbb7a03997e53a0b/images/14405698-330a-41da-ab1b-f9e8a2ec8fc1.jpg"
                                                                         width="264"
                                                                         style="max-width:799px;border:0;height:auto;outline:none;text-decoration:none;vertical-align:bottom"
                                                                         class="m_5372895143664279880mcnImage CToWUd">
                                                                </a>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="m_5372895143664279880mcnTextContent" valign="top"
                                                                style="padding:0px 9px;font-family:&quot;Open Sans&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;line-height:125%;text-align:left;word-break:break-word;color:#96a6b7;font-size:16px"
                                                                width="282">
                                                                <div style="margin-bottom:20px"><strong><span
                                                                                style="color:#fe6665;text-transform:uppercase">Até 78% de desconto</span></strong><br>
                                                                    <span style="color:#ffffff;font-size:12px;text-transform:uppercase">Até 78% de desconto</span>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>

                                                    <table align="right" border="0" cellpadding="0" cellspacing="0"
                                                           class="m_5372895143664279880mcnCaptionBottomContent"
                                                           width="282"
                                                           style="border-collapse:collapse">
                                                        <tbody>
                                                        <tr>
                                                            <td class="m_5372895143664279880mcnCaptionBottomImageContent"
                                                                align="center" valign="top"
                                                                style="padding:0 9px 9px 9px">


                                                                <a href="https://nuuvem.us4.list-manage.com/track/click?u=c38947ad4cbb7a03997e53a0b&amp;id=16b8d635c2&amp;e=54a8c8f101"
                                                                   title="" target="_blank"
                                                                   data-saferedirecturl="https://www.google.com/url?q=https://nuuvem.us4.list-manage.com/track/click?u%3Dc38947ad4cbb7a03997e53a0b%26id%3D16b8d635c2%26e%3D54a8c8f101&amp;source=gmail&amp;ust=1535571759062000&amp;usg=AFQjCNHjqxxFHYAC38euweqRkYf3m2B3cw">


                                                                    <img alt=""
                                                                         src="https://ci6.googleusercontent.com/proxy/_Bi_eE4_dJoZ51jrmUZtS7GBAArVtxZAp20pZKZbUdaTpaqowz5lpbOEG6-P1dQU3w5ELoPviSebeUqgT5MuqPz0N8r4q6ul3FxClLWHDx0PMOH-Ac2AL_7dtGrXJZoOhaV5vpYZSlg7plT0F6ZrHGg6Bq--EOMU8jM-2Fc=s0-d-e1-ft#https://gallery.mailchimp.com/c38947ad4cbb7a03997e53a0b/images/832885d5-f34e-4d81-a317-4cec80de10c6.jpg"
                                                                         width="264"
                                                                         style="max-width:800px;border:0;height:auto;outline:none;text-decoration:none;vertical-align:bottom"
                                                                         class="m_5372895143664279880mcnImage CToWUd">
                                                                </a>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="m_5372895143664279880mcnTextContent" valign="top"
                                                                style="padding:0px 9px;font-family:&quot;Open Sans&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;line-height:125%;text-align:left;word-break:break-word;color:#96a6b7;font-size:16px"
                                                                width="282">
                                                                <div><strong><span
                                                                                style="color:#fe6665;text-transform:uppercase">Até 75% de desconto</span></strong><br>
                                                                    <span style="color:#ffffff;font-size:12px;text-transform:uppercase">Últimas horas!</span>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>


                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                               class="m_5372895143664279880mcnCaptionBlock"
                                               style="border-collapse:collapse">
                                            <tbody class="m_5372895143664279880mcnCaptionBlockOuter">
                                            <tr>
                                                <td class="m_5372895143664279880mcnCaptionBlockInner" valign="top"
                                                    style="padding:9px">


                                                    <table align="left" border="0" cellpadding="0" cellspacing="0"
                                                           class="m_5372895143664279880mcnCaptionBottomContent"
                                                           width="282"
                                                           style="border-collapse:collapse">
                                                        <tbody>
                                                        <tr>
                                                            <td class="m_5372895143664279880mcnCaptionBottomImageContent"
                                                                align="center" valign="top"
                                                                style="padding:0 9px 9px 9px">


                                                                <a href="https://nuuvem.us4.list-manage.com/track/click?u=c38947ad4cbb7a03997e53a0b&amp;id=60c3d5be7f&amp;e=54a8c8f101"
                                                                   title="" target="_blank"
                                                                   data-saferedirecturl="https://www.google.com/url?q=https://nuuvem.us4.list-manage.com/track/click?u%3Dc38947ad4cbb7a03997e53a0b%26id%3D60c3d5be7f%26e%3D54a8c8f101&amp;source=gmail&amp;ust=1535571759062000&amp;usg=AFQjCNEiQ9ScObtv9_TbBLq2_9Z1o0Jf9w">


                                                                    <img alt=""
                                                                         src="https://ci3.googleusercontent.com/proxy/3NRL5gbAIGg8jltFD9o5JjZlwicvfsj1QMF6OauzwNUDJFqBZMM--XSboRBp4nSWHXPFD-byN7Qc9hA3Fz1l0sVfNXlnNpEcBFAuqLZHyDFnykj7DcA0tFgrdz7lL9HHnAZm7VpAxUgVp43Z6N9YMaj6DecAqWjICsuDvRQ=s0-d-e1-ft#https://gallery.mailchimp.com/c38947ad4cbb7a03997e53a0b/images/cae57515-86bf-42db-a5aa-542c212c8eab.jpg"
                                                                         width="264"
                                                                         style="max-width:799px;border:0;height:auto;outline:none;text-decoration:none;vertical-align:bottom"
                                                                         class="m_5372895143664279880mcnImage CToWUd">
                                                                </a>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="m_5372895143664279880mcnTextContent" valign="top"
                                                                style="padding:0px 9px;font-family:&quot;Open Sans&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;line-height:125%;text-align:left;word-break:break-word;color:#96a6b7;font-size:16px"
                                                                width="282">
                                                                <div style="margin-bottom:20px"><span
                                                                            style="color:#09c"><strong><span
                                                                                    style="text-transform:uppercase">Lançamento</span></strong></span><br>
                                                                    <span style="color:#ffffff;font-size:12px;text-transform:uppercase">Indiana Jones purinho</span>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>

                                                    <table align="right" border="0" cellpadding="0" cellspacing="0"
                                                           class="m_5372895143664279880mcnCaptionBottomContent"
                                                           width="282"
                                                           style="border-collapse:collapse">
                                                        <tbody>
                                                        <tr>
                                                            <td class="m_5372895143664279880mcnCaptionBottomImageContent"
                                                                align="center" valign="top"
                                                                style="padding:0 9px 9px 9px">


                                                                <a href="https://nuuvem.us4.list-manage.com/track/click?u=c38947ad4cbb7a03997e53a0b&amp;id=e1b0d3903d&amp;e=54a8c8f101"
                                                                   title="" target="_blank"
                                                                   data-saferedirecturl="https://www.google.com/url?q=https://nuuvem.us4.list-manage.com/track/click?u%3Dc38947ad4cbb7a03997e53a0b%26id%3De1b0d3903d%26e%3D54a8c8f101&amp;source=gmail&amp;ust=1535571759062000&amp;usg=AFQjCNHoyQ8zYHnAJyy7cezslxVsoHswJg">


                                                                    <img alt=""
                                                                         src="https://ci5.googleusercontent.com/proxy/6LbYi6fjefcKPHumBXtQT_Aw8mxBI7L--BeN6Q45ecngV6RRllJKIgW04JD-Mu34yWyj9KQIjnoIYxZNNEdp5-BTGd8HiVSPDcx6cP1fqVhiYD15-Rid_X2h7pTryM66Ab2CVCTfQkUDU8ytilCdBYbiMJzADiaFa8TeY4Q=s0-d-e1-ft#https://gallery.mailchimp.com/c38947ad4cbb7a03997e53a0b/images/24663ed9-1db2-41d0-b1bc-7308545f3421.jpg"
                                                                         width="264"
                                                                         style="max-width:799px;border:0;height:auto;outline:none;text-decoration:none;vertical-align:bottom"
                                                                         class="m_5372895143664279880mcnImage CToWUd">
                                                                </a>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="m_5372895143664279880mcnTextContent" valign="top"
                                                                style="padding:0px 9px;font-family:&quot;Open Sans&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;line-height:125%;text-align:left;word-break:break-word;color:#96a6b7;font-size:16px"
                                                                width="282">
                                                                <div><strong><span
                                                                                style="color:#09c;text-transform:uppercase">Pré-venda</span></strong><br>
                                                                    <span style="color:#ffffff;font-size:12px;text-transform:uppercase">Uma viagem muito louca</span>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>


                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top" id="m_5372895143664279880templateUpperColumns"
                            style="background:{$theme} none no-repeat center/cover;background-color:{$theme};background-image:none;background-repeat:no-repeat;background-position:center;background-size:cover;border-top:0;border-bottom:0;padding-top:0;padding-bottom:0px">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                   class="m_5372895143664279880templateContainer"
                                   style="border-collapse:collapse;max-width:600px!important">
                                <tbody>
                                <tr>
                                    <td valign="top">

                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="200"
                                               class="m_5372895143664279880columnWrapper"
                                               style="border-collapse:collapse">
                                            <tbody>
                                            <tr>
                                                <td valign="top" class="m_5372895143664279880columnContainer"></td>
                                            </tr>
                                            </tbody>
                                        </table>

                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="200"
                                               class="m_5372895143664279880columnWrapper"
                                               style="border-collapse:collapse">
                                            <tbody>
                                            <tr>
                                                <td valign="top" class="m_5372895143664279880columnContainer"></td>
                                            </tr>
                                            </tbody>
                                        </table>

                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="200"
                                               class="m_5372895143664279880columnWrapper"
                                               style="border-collapse:collapse">
                                            <tbody>
                                            <tr>
                                                <td valign="top" class="m_5372895143664279880columnContainer"></td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top" id="m_5372895143664279880templateLowerColumns"
                            style="background:{$theme} none no-repeat center/cover;background-color:{$theme};background-image:none;background-repeat:no-repeat;background-position:center;background-size:cover;border-top:0;border-bottom:2px none #eaeaea;padding-top:0px;padding-bottom:40px">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                   class="m_5372895143664279880templateContainer"
                                   style="border-collapse:collapse;max-width:600px!important">
                                <tbody>
                                <tr>
                                    <td valign="top">

                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="300"
                                               class="m_5372895143664279880columnWrapper"
                                               style="border-collapse:collapse">
                                            <tbody>
                                            <tr>
                                                <td valign="top" class="m_5372895143664279880columnContainer"></td>
                                            </tr>
                                            </tbody>
                                        </table>

                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="300"
                                               class="m_5372895143664279880columnWrapper"
                                               style="border-collapse:collapse">
                                            <tbody>
                                            <tr>
                                                <td valign="top" class="m_5372895143664279880columnContainer"></td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                {/if}

                <tr>
                    <td align="center" valign="top" id="m_5372895143664279880templateFooter"
                        style="background:rgba(0,0,0,0.5) none no-repeat center/cover;background-color:rgba(0,0,0,0.5);background-image:none;background-repeat:no-repeat;background-position:center;background-size:cover;border-top:0;border-bottom:0;padding-top:10px;padding-bottom:40px">

                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
                               class="m_5372895143664279880templateContainer"
                               style="border-collapse:collapse;max-width:600px!important">
                            <tbody>
                            <tr>
                                <td valign="top" class="m_5372895143664279880footerContainer">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                           class="m_5372895143664279880mcnTextBlock"
                                           style="min-width:100%;border-collapse:collapse">
                                        <tbody class="m_5372895143664279880mcnTextBlockOuter">
                                        <tr>
                                            <td valign="top" class="m_5372895143664279880mcnTextBlockInner"
                                                style="padding-top:9px">


                                                <table align="left" border="0" cellpadding="0" cellspacing="0"
                                                       style="max-width:100%;min-width:100%;border-collapse:collapse"
                                                       width="100%"
                                                       class="m_5372895143664279880mcnTextContentContainer">
                                                    <tbody>
                                                    <tr>

                                                        <td valign="top" class="m_5372895143664279880mcnTextContent"
                                                            style="padding:0px 18px 9px;text-align:center;word-break:break-word;color:#96a6b7;font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:12px;line-height:150%">

                                                            Caso não consiga visualizar este email,&nbsp;<a
                                                                    href="{$home}"
                                                                    style="color:#0099cc;font-weight:normal;text-decoration:underline"
                                                                    target="_blank"
                                                                    data-saferedirecturl="https://www.google.com/url?q={$home}">acesse
                                                                o site</a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>


                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                           class="m_5372895143664279880mcnDividerBlock"
                                           style="min-width:100%;border-collapse:collapse;table-layout:fixed!important">
                                        <tbody class="m_5372895143664279880mcnDividerBlockOuter">
                                        <tr>
                                            <td class="m_5372895143664279880mcnDividerBlockInner"
                                                style="min-width:100%;padding:10px 18px">
                                                <table class="m_5372895143664279880mcnDividerContent" border="0"
                                                       cellpadding="0" cellspacing="0" width="100%"
                                                       style="min-width:100%;border-top:2px solid {$theme};border-collapse:collapse">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <span></span>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    {if isset($menu)}
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                               class="m_5372895143664279880mcnFollowBlock"
                                               style="min-width:100%;border-collapse:collapse">
                                            <tbody class="m_5372895143664279880mcnFollowBlockOuter">
                                            <tr>
                                                <td align="center" valign="top" style="padding:9px"
                                                    class="m_5372895143664279880mcnFollowBlockInner">
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                                           class="m_5372895143664279880mcnFollowContentContainer"
                                                           style="min-width:100%;border-collapse:collapse">
                                                        <tbody>
                                                        <tr>
                                                            <td align="center"
                                                                style="padding-left:9px;padding-right:9px">
                                                                <table border="0" cellpadding="0" cellspacing="0"
                                                                       width="100%"
                                                                       style="min-width:100%;border:1px none;border-collapse:collapse"
                                                                       class="m_5372895143664279880mcnFollowContent">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td align="center" valign="top"
                                                                            style="padding-top:9px;padding-right:9px;padding-left:9px">
                                                                            <table align="center" border="0"
                                                                                   cellpadding="0"
                                                                                   cellspacing="0"
                                                                                   style="border-collapse:collapse">
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td align="center" valign="top">


                                                                                        <table align="left" border="0"
                                                                                               cellpadding="0"
                                                                                               cellspacing="0"
                                                                                               style="display:inline;border-collapse:collapse">
                                                                                            <tbody>
                                                                                            <tr>
                                                                                                <td valign="top"
                                                                                                    style="padding-right:10px;padding-bottom:9px"
                                                                                                    class="m_5372895143664279880mcnFollowContentItemContainer">
                                                                                                    <table border="0"
                                                                                                           cellpadding="0"
                                                                                                           cellspacing="0"
                                                                                                           width="100%"
                                                                                                           class="m_5372895143664279880mcnFollowContentItem"
                                                                                                           style="border-collapse:collapse">
                                                                                                        <tbody>
                                                                                                        <tr>
                                                                                                            <td align="left"
                                                                                                                valign="middle"
                                                                                                                style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px">
                                                                                                                <table align="left"
                                                                                                                       border="0"
                                                                                                                       cellpadding="0"
                                                                                                                       cellspacing="0"
                                                                                                                       width=""
                                                                                                                       style="border-collapse:collapse">
                                                                                                                    <tbody>
                                                                                                                    <tr>


                                                                                                                        <td align="left"
                                                                                                                            valign="middle"
                                                                                                                            class="m_5372895143664279880mcnFollowTextContent"
                                                                                                                            style="padding-left:5px">
                                                                                                                            <a href="https://nuuvem.us4.list-manage.com/track/click?u=c38947ad4cbb7a03997e53a0b&amp;id=308b5bd800&amp;e=54a8c8f101"
                                                                                                                               style="font-family:&quot;Open Sans&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:12px;text-decoration:none;color:#ffffff;font-weight:bold"
                                                                                                                               target="_blank"
                                                                                                                               data-saferedirecturl="https://www.google.com/url?q=https://nuuvem.us4.list-manage.com/track/click?u%3Dc38947ad4cbb7a03997e53a0b%26id%3D308b5bd800%26e%3D54a8c8f101&amp;source=gmail&amp;ust=1535571759062000&amp;usg=AFQjCNF5lMmxVLTb8TBWZIdchuOzGeDzTg">LOJA</a>
                                                                                                                        </td>

                                                                                                                    </tr>
                                                                                                                    </tbody>
                                                                                                                </table>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </td>
                                                                                            </tr>
                                                                                            </tbody>
                                                                                        </table>


                                                                                        <table align="left" border="0"
                                                                                               cellpadding="0"
                                                                                               cellspacing="0"
                                                                                               style="display:inline;border-collapse:collapse">
                                                                                            <tbody>
                                                                                            <tr>
                                                                                                <td valign="top"
                                                                                                    style="padding-right:10px;padding-bottom:9px"
                                                                                                    class="m_5372895143664279880mcnFollowContentItemContainer">
                                                                                                    <table border="0"
                                                                                                           cellpadding="0"
                                                                                                           cellspacing="0"
                                                                                                           width="100%"
                                                                                                           class="m_5372895143664279880mcnFollowContentItem"
                                                                                                           style="border-collapse:collapse">
                                                                                                        <tbody>
                                                                                                        <tr>
                                                                                                            <td align="left"
                                                                                                                valign="middle"
                                                                                                                style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px">
                                                                                                                <table align="left"
                                                                                                                       border="0"
                                                                                                                       cellpadding="0"
                                                                                                                       cellspacing="0"
                                                                                                                       width=""
                                                                                                                       style="border-collapse:collapse">
                                                                                                                    <tbody>
                                                                                                                    <tr>


                                                                                                                        <td align="left"
                                                                                                                            valign="middle"
                                                                                                                            class="m_5372895143664279880mcnFollowTextContent"
                                                                                                                            style="padding-left:5px">
                                                                                                                            <a href="https://nuuvem.us4.list-manage.com/track/click?u=c38947ad4cbb7a03997e53a0b&amp;id=1883c24426&amp;e=54a8c8f101"
                                                                                                                               style="font-family:&quot;Open Sans&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:12px;text-decoration:none;color:#ffffff;font-weight:bold"
                                                                                                                               target="_blank"
                                                                                                                               data-saferedirecturl="https://www.google.com/url?q=https://nuuvem.us4.list-manage.com/track/click?u%3Dc38947ad4cbb7a03997e53a0b%26id%3D1883c24426%26e%3D54a8c8f101&amp;source=gmail&amp;ust=1535571759062000&amp;usg=AFQjCNFL30RoNacvWivw_Gu-vG-M8ydkgw">GAMES</a>
                                                                                                                        </td>

                                                                                                                    </tr>
                                                                                                                    </tbody>
                                                                                                                </table>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </td>
                                                                                            </tr>
                                                                                            </tbody>
                                                                                        </table>


                                                                                        <table align="left" border="0"
                                                                                               cellpadding="0"
                                                                                               cellspacing="0"
                                                                                               style="display:inline;border-collapse:collapse">
                                                                                            <tbody>
                                                                                            <tr>
                                                                                                <td valign="top"
                                                                                                    style="padding-right:10px;padding-bottom:9px"
                                                                                                    class="m_5372895143664279880mcnFollowContentItemContainer">
                                                                                                    <table border="0"
                                                                                                           cellpadding="0"
                                                                                                           cellspacing="0"
                                                                                                           width="100%"
                                                                                                           class="m_5372895143664279880mcnFollowContentItem"
                                                                                                           style="border-collapse:collapse">
                                                                                                        <tbody>
                                                                                                        <tr>
                                                                                                            <td align="left"
                                                                                                                valign="middle"
                                                                                                                style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px">
                                                                                                                <table align="left"
                                                                                                                       border="0"
                                                                                                                       cellpadding="0"
                                                                                                                       cellspacing="0"
                                                                                                                       width=""
                                                                                                                       style="border-collapse:collapse">
                                                                                                                    <tbody>
                                                                                                                    <tr>


                                                                                                                        <td align="left"
                                                                                                                            valign="middle"
                                                                                                                            class="m_5372895143664279880mcnFollowTextContent"
                                                                                                                            style="padding-left:5px">
                                                                                                                            <a href="https://nuuvem.us4.list-manage.com/track/click?u=c38947ad4cbb7a03997e53a0b&amp;id=bf94abd7ed&amp;e=54a8c8f101"
                                                                                                                               style="font-family:&quot;Open Sans&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:12px;text-decoration:none;color:#ffffff;font-weight:bold"
                                                                                                                               target="_blank"
                                                                                                                               data-saferedirecturl="https://www.google.com/url?q=https://nuuvem.us4.list-manage.com/track/click?u%3Dc38947ad4cbb7a03997e53a0b%26id%3Dbf94abd7ed%26e%3D54a8c8f101&amp;source=gmail&amp;ust=1535571759062000&amp;usg=AFQjCNHyuigyfa3mBw5FBtiv17FBbAR_rA">CALENDÁRIO</a>
                                                                                                                        </td>

                                                                                                                    </tr>
                                                                                                                    </tbody>
                                                                                                                </table>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </td>
                                                                                            </tr>
                                                                                            </tbody>
                                                                                        </table>


                                                                                        <table align="left" border="0"
                                                                                               cellpadding="0"
                                                                                               cellspacing="0"
                                                                                               style="display:inline;border-collapse:collapse">
                                                                                            <tbody>
                                                                                            <tr>
                                                                                                <td valign="top"
                                                                                                    style="padding-right:10px;padding-bottom:9px"
                                                                                                    class="m_5372895143664279880mcnFollowContentItemContainer">
                                                                                                    <table border="0"
                                                                                                           cellpadding="0"
                                                                                                           cellspacing="0"
                                                                                                           width="100%"
                                                                                                           class="m_5372895143664279880mcnFollowContentItem"
                                                                                                           style="border-collapse:collapse">
                                                                                                        <tbody>
                                                                                                        <tr>
                                                                                                            <td align="left"
                                                                                                                valign="middle"
                                                                                                                style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px">
                                                                                                                <table align="left"
                                                                                                                       border="0"
                                                                                                                       cellpadding="0"
                                                                                                                       cellspacing="0"
                                                                                                                       width=""
                                                                                                                       style="border-collapse:collapse">
                                                                                                                    <tbody>
                                                                                                                    <tr>


                                                                                                                        <td align="left"
                                                                                                                            valign="middle"
                                                                                                                            class="m_5372895143664279880mcnFollowTextContent"
                                                                                                                            style="padding-left:5px">
                                                                                                                            <a href="https://nuuvem.us4.list-manage.com/track/click?u=c38947ad4cbb7a03997e53a0b&amp;id=3c92a5bcad&amp;e=54a8c8f101"
                                                                                                                               style="font-family:&quot;Open Sans&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:12px;text-decoration:none;color:#ffffff;font-weight:bold"
                                                                                                                               target="_blank"
                                                                                                                               data-saferedirecturl="https://www.google.com/url?q=https://nuuvem.us4.list-manage.com/track/click?u%3Dc38947ad4cbb7a03997e53a0b%26id%3D3c92a5bcad%26e%3D54a8c8f101&amp;source=gmail&amp;ust=1535571759063000&amp;usg=AFQjCNHMdT6BqHaDMcBfaml9smD-B7CbPg">SOBRE</a>
                                                                                                                        </td>

                                                                                                                    </tr>
                                                                                                                    </tbody>
                                                                                                                </table>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </td>
                                                                                            </tr>
                                                                                            </tbody>
                                                                                        </table>


                                                                                        <table align="left" border="0"
                                                                                               cellpadding="0"
                                                                                               cellspacing="0"
                                                                                               style="display:inline;border-collapse:collapse">
                                                                                            <tbody>
                                                                                            <tr>
                                                                                                <td valign="top"
                                                                                                    style="padding-right:0;padding-bottom:9px"
                                                                                                    class="m_5372895143664279880mcnFollowContentItemContainer">
                                                                                                    <table border="0"
                                                                                                           cellpadding="0"
                                                                                                           cellspacing="0"
                                                                                                           width="100%"
                                                                                                           class="m_5372895143664279880mcnFollowContentItem"
                                                                                                           style="border-collapse:collapse">
                                                                                                        <tbody>
                                                                                                        <tr>
                                                                                                            <td align="left"
                                                                                                                valign="middle"
                                                                                                                style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px">
                                                                                                                <table align="left"
                                                                                                                       border="0"
                                                                                                                       cellpadding="0"
                                                                                                                       cellspacing="0"
                                                                                                                       width=""
                                                                                                                       style="border-collapse:collapse">
                                                                                                                    <tbody>
                                                                                                                    <tr>


                                                                                                                        <td align="left"
                                                                                                                            valign="middle"
                                                                                                                            class="m_5372895143664279880mcnFollowTextContent"
                                                                                                                            style="padding-left:5px">
                                                                                                                            <a href="https://nuuvem.us4.list-manage.com/track/click?u=c38947ad4cbb7a03997e53a0b&amp;id=bf16b9835e&amp;e=54a8c8f101"
                                                                                                                               style="font-family:&quot;Open Sans&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:12px;text-decoration:none;color:#ffffff;font-weight:bold"
                                                                                                                               target="_blank"
                                                                                                                               data-saferedirecturl="https://www.google.com/url?q=https://nuuvem.us4.list-manage.com/track/click?u%3Dc38947ad4cbb7a03997e53a0b%26id%3Dbf16b9835e%26e%3D54a8c8f101&amp;source=gmail&amp;ust=1535571759063000&amp;usg=AFQjCNEyKCaXuur93fLJSzx4SxGOH7VoDA">SUPORTE</a>
                                                                                                                        </td>

                                                                                                                    </tr>
                                                                                                                    </tbody>
                                                                                                                </table>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </td>
                                                                                            </tr>
                                                                                            </tbody>
                                                                                        </table>


                                                                                    </td>
                                                                                </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>

                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    {/if}
                                    {if isset($social)}
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                               class="m_5372895143664279880mcnCodeBlock"
                                               style="border-collapse:collapse">
                                            <tbody class="m_5372895143664279880mcnTextBlockOuter">
                                            <tr>
                                                <td valign="top" class="m_5372895143664279880mcnTextBlockInner">
                                                    <div class="m_5372895143664279880mcnTextContent"
                                                         style="word-break:break-word;color:#96a6b7;font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:12px;line-height:150%;text-align:left">
                                                        <center><font style="font-size:14px"> <span
                                                                        style="display:inline-block;padding:10px 5px;font-size:10px"><a
                                                                            href="https://nuuvem.us4.list-manage.com/track/click?u=c38947ad4cbb7a03997e53a0b&amp;id=e2e833b713&amp;e=54a8c8f101"
                                                                            style="background-color:#5b79a8;display:inline-block;width:40px;height:24px;padding:11px 0 5px 0;border-radius:20px;color:#fff;text-decoration:none;font-weight:normal"
                                                                            target="_blank"
                                                                            data-saferedirecturl="https://www.google.com/url?q=https://nuuvem.us4.list-manage.com/track/click?u%3Dc38947ad4cbb7a03997e53a0b%26id%3De2e833b713%26e%3D54a8c8f101&amp;source=gmail&amp;ust=1535571759063000&amp;usg=AFQjCNExyhY-I4HW2OBYRTNj08i0KO3ymg"><img
                                                                                style="vertical-align:middle;width:16px;border:0;height:auto!important;outline:none;text-decoration:none"
                                                                                src="https://ci6.googleusercontent.com/proxy/8lI9jyxp22IeGKDul5Ii6w407Rjf076qEk4xIQOywEbCnhP1THiCXBaH_PuS6zQ2nIB3sPkHcfw-fBRrvhUV8870gj6XPd2fu024nr3fQ3XXC1fRZD0HraJvUjsFj_oZcWQpwx7B9QUkHPaIZmH1w63R4_Gy98s3C-0BQrk=s0-d-e1-ft#https://gallery.mailchimp.com/c38947ad4cbb7a03997e53a0b/images/05248e1e-b556-42b1-bdfd-958e5bb0ad48.png"
                                                                                alt="" class="CToWUd"></a></span> <span
                                                                        style="display:inline-block;padding:10px 5px;font-size:10px"><a
                                                                            href="https://nuuvem.us4.list-manage.com/track/click?u=c38947ad4cbb7a03997e53a0b&amp;id=e5c258ae80&amp;e=54a8c8f101"
                                                                            style="background-color:#63b3ff;display:inline-block;width:40px;height:24px;padding:11px 0 5px 0;border-radius:20px;color:#fff;text-decoration:none;font-weight:normal"
                                                                            target="_blank"
                                                                            data-saferedirecturl="https://www.google.com/url?q=https://nuuvem.us4.list-manage.com/track/click?u%3Dc38947ad4cbb7a03997e53a0b%26id%3De5c258ae80%26e%3D54a8c8f101&amp;source=gmail&amp;ust=1535571759063000&amp;usg=AFQjCNFxIsIn7F9rEErl28HHfH8TJHYBTA"><img
                                                                                style="vertical-align:middle;width:16px;border:0;height:auto!important;outline:none;text-decoration:none"
                                                                                src="https://ci4.googleusercontent.com/proxy/A6F5e2ZFR1nMBnNTkXkxAtzKaIKc5rTNPsQW7b8pa23TT4QNA8CsDUSwl2x0TXd36XTUAHN_GEvvsilOF1xrlI-oZTOXvItWU01lvPKOzR8428sDbMO6pP68BW96mguPDKgpZPIBzWkzhyvcae7FrcwMLJ0wA2rRRmtH-nM=s0-d-e1-ft#https://gallery.mailchimp.com/c38947ad4cbb7a03997e53a0b/images/1716d74e-d007-4c4e-a788-ef9e1c1ed5eb.png"
                                                                                alt="" class="CToWUd"></a></span> <span
                                                                        style="display:inline-block;padding:10px 5px;font-size:10px"><a
                                                                            href="https://nuuvem.us4.list-manage.com/track/click?u=c38947ad4cbb7a03997e53a0b&amp;id=27c6bef142&amp;e=54a8c8f101"
                                                                            style="background-color:#d63372;display:inline-block;width:40px;height:24px;padding:11px 0 5px 0;border-radius:20px;color:#fff;text-decoration:none;font-weight:normal"
                                                                            target="_blank"
                                                                            data-saferedirecturl="https://www.google.com/url?q=https://nuuvem.us4.list-manage.com/track/click?u%3Dc38947ad4cbb7a03997e53a0b%26id%3D27c6bef142%26e%3D54a8c8f101&amp;source=gmail&amp;ust=1535571759063000&amp;usg=AFQjCNGgnDggpH398MD0n-GH2r0fe-jPQQ"><img
                                                                                style="vertical-align:middle;width:16px;border:0;height:auto!important;outline:none;text-decoration:none"
                                                                                src="https://ci4.googleusercontent.com/proxy/US3jnfgAoWnpvlh3YjsO4ZLoOKbLVgfnLBSdAV9LXDBEDgLpmX6Cw87ivFt1tMOzyiy0kOlnY6tgzyr7uYyz9VhAL_nPJGXis4Ca5fbJof9hRTG2_e-MHIxrC420NKzRtY8lFgRw2uMABGuLRamfp8dnoytsMlJASGk1FeY=s0-d-e1-ft#https://gallery.mailchimp.com/c38947ad4cbb7a03997e53a0b/images/52a69056-d89f-49da-b8f9-6f62bff8b11a.png"
                                                                                alt="" class="CToWUd"></a></span> <span
                                                                        style="display:inline-block;padding:10px 5px;font-size:10px"><a
                                                                            href="https://nuuvem.us4.list-manage.com/track/click?u=c38947ad4cbb7a03997e53a0b&amp;id=0ae1f734c1&amp;e=54a8c8f101"
                                                                            style="background-color:#ee2b3b;display:inline-block;width:40px;height:24px;padding:11px 0 5px 0;border-radius:20px;color:#fff;text-decoration:none;font-weight:normal"
                                                                            target="_blank"
                                                                            data-saferedirecturl="https://www.google.com/url?q=https://nuuvem.us4.list-manage.com/track/click?u%3Dc38947ad4cbb7a03997e53a0b%26id%3D0ae1f734c1%26e%3D54a8c8f101&amp;source=gmail&amp;ust=1535571759063000&amp;usg=AFQjCNGll4K59WU1hCAvYDDczvOli3dfcw"><img
                                                                                style="vertical-align:middle;width:16px;border:0;height:auto!important;outline:none;text-decoration:none"
                                                                                src="https://ci6.googleusercontent.com/proxy/9ztNyWHbK31W_xBsRD6guFVjZH3z-bzY9u7SHX3opKnZr9XW3eYuSbZ_o2rh4qghhBzKXRb8xhaDjJ92YIDB0riFddGp0jhW36iSEPc7-jrZZUIupV6xuU4bv5SjmDGQPv87N1aAWsVuVkoMIiHbpsmq-CD_HzU2pXfZbhs=s0-d-e1-ft#https://gallery.mailchimp.com/c38947ad4cbb7a03997e53a0b/images/38dee916-3b0e-42f8-be91-1bce8ef334e7.png"
                                                                                alt="" class="CToWUd"></a></span> <span
                                                                        style="display:inline-block;padding:10px 5px;font-size:10px"><a
                                                                            href="https://nuuvem.us4.list-manage.com/track/click?u=c38947ad4cbb7a03997e53a0b&amp;id=d1719a1d15&amp;e=54a8c8f101"
                                                                            style="background-color:#7289da;display:inline-block;width:40px;height:24px;padding:11px 0 5px 0;border-radius:20px;color:#fff;text-decoration:none;font-weight:normal"
                                                                            target="_blank"
                                                                            data-saferedirecturl="https://www.google.com/url?q=https://nuuvem.us4.list-manage.com/track/click?u%3Dc38947ad4cbb7a03997e53a0b%26id%3Dd1719a1d15%26e%3D54a8c8f101&amp;source=gmail&amp;ust=1535571759063000&amp;usg=AFQjCNHshAz7Y00IO93bjT3MJaFhAo7X-A"><img
                                                                                style="vertical-align:middle;width:16px;border:0;height:auto!important;outline:none;text-decoration:none"
                                                                                src="https://ci4.googleusercontent.com/proxy/Wg2uni8rESp8QCDAHe5oqRpS0KvO3Swp73i5h3UMvffvMyHvnIL707c1ngi1inYaSEnxSdo_K-4-hPDQc_L43pjwYACzPKEDvK3MUCJoJEBngEgA1urigsBK-JuyNRMZR6p-V0l19y56Q5yvXPJ9WdcsRR4wMjFSMdR3_U0=s0-d-e1-ft#https://gallery.mailchimp.com/c38947ad4cbb7a03997e53a0b/images/52c0cb4f-9ccc-4257-a2af-47be457089bc.png"
                                                                                alt="" class="CToWUd"></a></span></font>
                                                        </center>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    {/if}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>