<?PHP
//-----------------------------------------------
// SESSÃO INCIADA
//-----------------------------------------------
session_start();
//-----------------------------------------------
// LOGIN
//-----------------------------------------------
if ( strlen($_SESSION['login']['nome']) > 0  and strlen($_SESSION['login']['id']) > 0 ):
    //-----------------------------------------------
    // ARQUIVOS NECESSÁRIOS
    //-----------------------------------------------
    //    Diretório de includes
    set_include_path( dirname(__FILE__) . '/php/' );
    
    //    classes
    require_once( 'classes/class.TemplatePower.inc.php' );
    require_once( 'classes/servicos.php' );
    require_once( 'configs/cfg.mysql.inc.php' );
    
    //    funções
    require_once( 'funcoes/geral.php' );
    
    //-----------------------------------------------
    // OBJETO DA CLASSE
    //-----------------------------------------------
    $tpl    =    new TemplatePower ( 'tpl/default/white_horse/index.tpl' );
    $serv    =    new servicos;
    
    //-----------------------------------------------
    // CAPTURO OS DADOS
    //-----------------------------------------------
    $GLOBALS['OS']        =    $_GET['id'];
    $GLOBALS['MONTH']    =    $_GET['mes'];
    $GLOBALS['YEAR']    =    $_GET['ano'];
    
    //-----------------------------------------------
    // CONEXÂO MySQL
    //-----------------------------------------------
    mysqli_report(MYSQLI_REPORT_OFF);
    
    $mysqli    =    mysqli_init();
    
    @$mysqli->real_connect($MySQL['servidor'], $MySQL['usuario'], $MySQL['senha'], $MySQL['banco']);
    
    if ( mysqli_connect_errno() )
    {
        header('Location: erro.php');
        exit();
    }
    
    //-----------------------------------------------
    // ARQUIVOS QUE GERAM O SITE
    //-----------------------------------------------
    $tpl->assignInclude ('corpo',        'tpl/default/white_horse/meio.tpl');
    $tpl->assignInclude ('menu',        'tpl/default/white_horse/menu.tpl'); 
    
    //    se o mes ea OS não estiverem setados carrega os meses deste ano
    if ((strlen($GLOBALS['OS']) == 0) && (strlen($GLOBALS['MONTH']) == 0)) {
        
        $tpl->assignInclude('conteudo', 'tpl/conteudo/white_horse/osVer/conteudo.tpl');
        
    } elseif ((strlen($GLOBALS['MONTH']) > 0) && (strlen($GLOBALS['YEAR']) > 0)){
    
        $tpl->assignInclude('conteudo', 'tpl/conteudo/white_horse/osVerMonth/conteudo.tpl');
        
    } elseif ( strlen($GLOBALS['OS']) > 0 ) {
        
        $tpl->assignInclude('conteudo', 'tpl/conteudo/white_horse/osVerId/conteudo.tpl'); 
    }

    //-----------------------------------------------
    // COMANDO DE PREPARO DA CLASSE
    //-----------------------------------------------
    $tpl->prepare();
    
    //-----------------------------------------------
    // COMANDOS
    //-----------------------------------------------
        //-- Se o mês ea OS não estiverem setados carrega os meses deste ano..
    if ((strlen($GLOBALS['OS']) == 0) && (strlen($GLOBALS['MONTH']) == 0)) {
        
        //    Verfico a equivalencia do ano 
        if ( $GLOBALS['YEAR'] == NULL)
            $GLOBALS['YEAR']    =    date('Y');
            
        //    Janeiro
        $jan    =    $mysqli->prepare('SELECT COUNT(*) FROM OSPedido WHERE MONTH(data) = 01 AND YEAR(data) = "' . $GLOBALS['YEAR'] . '" AND idVendedor = "' . $_SESSION['login']['id'] . '";');
        @$jan->execute();
        $jan->store_result();
        
        if ( $jan->num_rows() > 0 ) {
            
            $jan->bind_result($total);
            $jan->fetch();
            
            $tpl->assign('jan', $total);
        
        } else {
            
            $tpl->assign('jan', '0');
            
        }
        
        $jan->free_result();
        $jan->close();
        
        //    Fevereiro
        $fev    =    $mysqli->prepare('SELECT COUNT(*) FROM OSPedido WHERE MONTH(data) = 02 AND YEAR(data) = "' . $GLOBALS['YEAR'] . '" AND idVendedor = "' . $_SESSION['login']['id'] . '";');
        @$fev->execute();
        $fev->store_result();
        
        if ( $fev->num_rows() > 0 ) {
            
            $fev->bind_result($total);
            $fev->fetch();
            
            $tpl->assign('fev', $total);
        
        } else {
            
            $tpl->assign('fev', '0');
            
        }
        
        $fev->free_result();
        $fev->close();
        
        //    Março
        $mar    =    $mysqli->prepare('SELECT COUNT(*) FROM OSPedido WHERE MONTH(data) = 03 AND YEAR(data) = "' . $GLOBALS['YEAR'] . '" AND idVendedor = "' . $_SESSION['login']['id'] . '";');
        @$mar->execute();
        $mar->store_result();
        
        if ( $mar->num_rows() > 0 ) {
            
            $mar->bind_result($total);
            $mar->fetch();
            
            $tpl->assign('mar', $total);
        
        } else {
            
            $tpl->assign('mar', '0');
            
        }
        
        $mar->free_result();
        $mar->close();
        
        //    Abril
        $abr    =    $mysqli->prepare('SELECT COUNT(*) FROM OSPedido WHERE MONTH(data) = 04 AND YEAR(data) = "' . $GLOBALS['YEAR'] . '" AND idVendedor = "' . $_SESSION['login']['id'] . '";');
        @$abr->execute();
        $abr->store_result();
        
        if ( $abr->num_rows() > 0 ) {
            
            $abr->bind_result($total);
            $abr->fetch();
            
            $tpl->assign('abr', $total);
        
        } else {
            
            $tpl->assign('abr', '0');
            
        }
        
        $abr->free_result();
        $abr->close();
        
        //    Maio
        $mai    =    $mysqli->prepare('SELECT COUNT(*) FROM OSPedido WHERE MONTH(data) = 05 AND YEAR(data) = "' . $GLOBALS['YEAR'] . '" AND idVendedor = "' . $_SESSION['login']['id'] . '";');
        @$mai->execute();
        $mai->store_result();
        
        if ( $mai->num_rows() > 0 ) {
            
            $mai->bind_result($total);
            $mai->fetch();
            
            $tpl->assign('mai', $total);
        
        } else {
            
            $tpl->assign('mai', '0');
            
        }
        
        $mai->free_result();
        $mai->close();
        
        //    Junho
        $jun    =    $mysqli->prepare('SELECT COUNT(*) FROM OSPedido WHERE MONTH(data) = 06 AND YEAR(data) = "' . $GLOBALS['YEAR'] . '" AND idVendedor = "' . $_SESSION['login']['id'] . '";');
        @$jun->execute();
        $jun->store_result();
        
        if ( $jun->num_rows() > 0 ) {
            
            $jun->bind_result($total);
            $jun->fetch();
            
            $tpl->assign('jun', $total);
        
        } else {
            
            $tpl->assign('jun', '0');
            
        }
        
        $jun->free_result();
        $jun->close();
        
        //    Julho
        $jul    =    $mysqli->prepare('SELECT COUNT(*) FROM OSPedido WHERE MONTH(data) = 07 AND YEAR(data) = "' . $GLOBALS['YEAR'] . '" AND idVendedor = "' . $_SESSION['login']['id'] . '";');
        @$jul->execute();
        $jul->store_result();
        
        if ( $jul->num_rows() > 0 ) {
            
            $jul->bind_result($total);
            $jul->fetch();
            
            $tpl->assign('jul', $total);
        
        } else {
            
            $tpl->assign('jul', '0');
            
        }
        
        $jul->free_result();
        $jul->close();
        
        //    Agosto
        $ago    =    $mysqli->prepare('SELECT COUNT(*) FROM OSPedido WHERE MONTH(data) = 08 AND YEAR(data) = "' . $GLOBALS['YEAR'] . '" AND idVendedor = "' . $_SESSION['login']['id'] . '";');
        @$ago->execute();
        $ago->store_result();
        
        if ( $ago->num_rows() > 0 ) {
            
            $ago->bind_result($total);
            $ago->fetch();
            
            $tpl->assign('ago', $total);
        
        } else {
            
            $tpl->assign('ago', '0');
            
        }
        
        $ago->free_result();
        $ago->close();
        
        //    Setembro
        $set    =    $mysqli->prepare('SELECT COUNT(*) FROM OSPedido WHERE MONTH(data) = 09 AND YEAR(data) = "' . $GLOBALS['YEAR'] . '" AND idVendedor = "' . $_SESSION['login']['id'] . '";');
        @$set->execute();
        $set->store_result();
        
        if ( $set->num_rows() > 0 ) {
            
            $set->bind_result($total);
            $set->fetch();
            
            $tpl->assign('set', $total);
        
        } else {
            
            $tpl->assign('set', '0');
            
        }
        
        $set->free_result();
        $set->close();
        
        //    Outubro
        $out    =    $mysqli->prepare('SELECT COUNT(*) FROM OSPedido WHERE MONTH(data) = 10 AND YEAR(data) = "' . $GLOBALS['YEAR'] . '" AND idVendedor = "' . $_SESSION['login']['id'] . '";');
        @$out->execute();
        $out->store_result();
        
        if ( $out->num_rows() > 0 ) {
            
            $out->bind_result($total);
            $out->fetch();
            
            $tpl->assign('out', $total);
        
        } else {
            
            $tpl->assign('out', '0');
            
        }
        
        $out->free_result();
        $out->close();
        
        //    Novembro
        $nov    =    $mysqli->prepare('SELECT COUNT(*) FROM OSPedido WHERE MONTH(data) = 11 AND YEAR(data) = "' . $GLOBALS['YEAR'] . '" AND idVendedor = "' . $_SESSION['login']['id'] . '";');
        @$nov->execute();
        $nov->store_result();
        
        if ( $nov->num_rows() > 0 ) {
            
            $nov->bind_result($total);
            $nov->fetch();
            
            $tpl->assign('nov', $total);
        
        } else {
            
            $tpl->assign('nov', '0');
            
        }
        
        $nov->free_result();
        $nov->close();
        
        //    Dezembro
        $dez    =    $mysqli->prepare('SELECT COUNT(*) FROM OSPedido WHERE MONTH(data) = 12 AND YEAR(data) = "' . $GLOBALS['YEAR'] . '" AND idVendedor = "' . $_SESSION['login']['id'] . '";');
        @$dez->execute();
        $dez->store_result();
        
        if ( $dez->num_rows() > 0 ) {
            
            $dez->bind_result($total);
            $dez->fetch();
            
            $tpl->assign('dez', $total);
        
        } else {
            
            $tpl->assign('dez', '0');
            
        }
        
        $dez->free_result();
        $dez->close();
        
        //-----------------------------------------------
        // PÁGINAÇÃO DE ANOS
        //-----------------------------------------------
        //    Exibo o ano atual nos links
        $tpl->assign('ano', $GLOBALS['YEAR']);
        
        //    ano anterior
        $menos    =    $GLOBALS['YEAR'] - 1;
        $SqlAA    =    'SELECT id FROM OSPedido WHERE YEAR(data) = ? AND idVendedor = ?;';
        
        $AA    =    $mysqli->prepare($SqlAA);
        $AA->bind_param('ii', $menos, $_SESSION['login']['id']);
        @$AA->execute();
        $AA->store_result();
        
        if ( $AA->num_rows() > 0 ) {
            
            $tpl->assign('AA', '<a href="osAlt.php?ano=' . $menos .'" class="hub">&laquo;&nbsp;Ano anterior </a>');
        }
        
        $AA->free_result();
        $AA->close();
        
        //    ano posterior
        $mais    =    $GLOBALS['YEAR'] + 1;
        $SqlAP    =    'SELECT id FROM OSPedido WHERE YEAR(data) = ? AND idVendedor = ?;';
        
        $AP    =    $mysqli->prepare($SqlAP);
        $AP->bind_param('ii', $mais, $_SESSION['login']['id']);
        @$AP->execute();
        $AP->store_result();
        
        if ( $AP->num_rows() > 0 ) {
            
            $tpl->assign('AP', '<a href="osAlt.php?ano=' . $mais .'" class="hub">Pr&oacute;ximo ano &raquo;</a>');
            
        }
        
        $AP->free_result();
        $AP->close();
            
    } elseif ( (strlen($GLOBALS['MONTH']) > 0) && (strlen($GLOBALS['YEAR']) > 0) ) {
        
        //    verifico o total de OS's para cria a páginação
$sql    =    'SELECT DATE_FORMAT(OSPedido.data, "%d/%m/%Y") AS data, OSPedido.id, OSStatusTec.nome AS status, OSCliente.nome, OSAdsl.idOs AS ADSL, OSCabo.idOs AS ViaCabo, OSDiscado.idOs AS discado, OSHospedagem.idOs AS hospedagem, OSRegistro.idOs AS Registro, OSViaRadio.idOs AS ViaRadio, OSRedelCabo.idOs AS RedelCabo, OSServDiv.idOs AS ServDiv FROM OSPedido JOIN OSVendedor ON OSVendedor.id = OSPedido.idVendedor JOIN OSCliente ON OSCliente.idOS = OSPedido.id LEFT OUTER JOIN OSTecnica ON OSTecnica.idOs = OSPedido.id LEFT OUTER JOIN OSStatusTec ON OSStatusTec.id = OSTecnica.status  LEFT OUTER JOIN OSAdsl ON OSAdsl.idOS = OSPedido.id LEFT OUTER JOIN OSCabo ON OSCabo.idOS = OSPedido.id LEFT OUTER JOIN OSDiscado ON OSDiscado.idOS = OSPedido.id LEFT OUTER JOIN OSHospedagem ON OSHospedagem.idOS = OSPedido.id LEFT OUTER JOIN OSRegistro ON OSRegistro.idOS = OSPedido.id LEFT OUTER JOIN OSViaRadio ON OSViaRadio.idOS = OSPedido.id LEFT OUTER JOIN OSRedelCabo ON OSRedelCabo.idOS = OSPedido.id LEFT OUTER JOIN OSServDiv ON OSServDiv.idOS = OSPedido.id WHERE OSPedido.idVendedor = ? AND MONTH(data) = ? AND YEAR(data) = ? GROUP BY OSPedido.id DESC;
';
        
        //    resultados por página
        $resultsPage    =    15;
        
        //    Comando de execução dos dados
        $check    =    $mysqli->prepare($sql);
        $check->bind_param('iss', $_SESSION['login']['id'], $GLOBALS['MONTH'], $GLOBALS['YEAR']);
        @$check->execute();
        $check->store_result();
        
        $pages    =    ceil ( $check->num_rows / $resultsPage );
        
        $page    =    $_GET['page'];
            
        if ( !isset ( $page ) )
        {
            $page    =    0;
        }

        $first    =    $page * $resultsPage;
        
        //    Comando de seleção dos resultados
$SQL    =    "SELECT DATE_FORMAT(OSPedido.data, '%d/%m/%Y') AS data, OSPedido.id, OSStatusTec.nome AS status, OSCliente.nome, OSAdsl.idOs AS ADSL, OSCabo.idOs AS ViaCabo, OSDiscado.idOs AS discado, OSHospedagem.idOs AS hospedagem, OSRegistro.idOs AS Registro, OSViaRadio.idOs AS ViaRadio, OSRedelCabo.idOs AS RedelCabo, OSServDiv.idOs AS ServDiv FROM OSPedido JOIN OSVendedor ON OSVendedor.id = OSPedido.idVendedor JOIN OSCliente ON OSCliente.idOS = OSPedido.id LEFT OUTER JOIN OSTecnica ON OSTecnica.idOs = OSPedido.id LEFT OUTER JOIN OSStatusTec ON OSStatusTec.id = OSTecnica.status  LEFT OUTER JOIN OSAdsl ON OSAdsl.idOS = OSPedido.id LEFT OUTER JOIN OSCabo ON OSCabo.idOS = OSPedido.id LEFT OUTER JOIN OSDiscado ON OSDiscado.idOS = OSPedido.id LEFT OUTER JOIN OSHospedagem ON OSHospedagem.idOS = OSPedido.id LEFT OUTER JOIN OSRegistro ON OSRegistro.idOS = OSPedido.id LEFT OUTER JOIN OSViaRadio ON OSViaRadio.idOS = OSPedido.id LEFT OUTER JOIN OSRedelCabo ON OSRedelCabo.idOS = OSPedido.id LEFT OUTER JOIN OSServDiv ON OSServDiv.idOS = OSPedido.id WHERE OSPedido.idVendedor = ? AND MONTH(data) = ? AND YEAR(data) = ? GROUP BY OSPedido.id DESC LIMIT $first, $resultsPage";
        
        $res    =    $mysqli->prepare($SQL);
        $res->bind_param('iss', $_SESSION['login']['id'], $GLOBALS['MONTH'], $GLOBALS['YEAR']);
        @$res->execute();
        $res->store_result();
        
        if ( $res->num_rows() > 0 ) {
            
            $res->bind_result($data, $OS, $status, $nomeCli, $adsl, $ViaCabo, $discado, $hospedagem, $registro, $ViaRadio, $redelCabo, $ServDiv);
            $bg    =    0;
            
            while ( $res->fetch() ) {
                
                //    Inicio o Bloco
                $tpl->newBlock('lista');
                
                //    Valores
                $tpl->assign('idOS',         $OS);
                $tpl->assign('nomeCliente', $nomeCli);
                $tpl->assign('data',        $data);
                
                //    Status do serviço
                if ( is_null($status) == TRUE ):
                    $tpl->assign('status',        'Não realizado');
                else:
                    $tpl->assign('status',        $status);
                endif;
                
                //    Serviços
                if ( is_null($adsl) == FALSE  )
                    $tpl->assign('adsl', ' Adsl,');
                
                if ( is_null($ViaCabo) == FALSE )
                    $tpl->assign('viaCabo',    ' Via Cabo,');
                
                if ( is_null($discado) == FALSE )
                    $tpl->assign('discado',    ' Acesso discado,');
                    
                if ( is_null($hospedagem) == FALSE )
                    $tpl->assign('hospedagem', ' Hospedagem,');
                
                if ( is_null($registro) == FALSE )
                    $tpl->assign('registro', ' Registro de dominio,');
                    
                if ( is_null($ViaRadio) == FALSE )
                    $tpl->assign('viaRadio', ' Via Rádio,');
                    
                if ( is_null($redelCabo) == FALSE )
                    $tpl->assign('redelCabo', ' Redel Cabo,');
                    
                if ( is_null($ServDiv) == FALSE )
                    $tpl->assign('ServDiv', ' Serviços Diversos,');                    
                
                //    Cor de fundo
                if ( $bg%2) {
                    $tpl->assign('corFundo',    'bgcolor="#E6F1FB"');
                }
                
                $bg++;
            }
        } else {
            
            $tpl->newBlock('erro');
        }
        
        //    links dinamicos
        //    + voltar
        if ( $page > 0 ){
            $menos    =    $page - 1;
            $url    =    '?mes=' . $_GET['mes'] . '&ano='. $_GET['ano'] . '&page='. $menos;
            
            $tpl->assignGlobal("v1",    "<a href='". $url ."' class='hub'>&laquo;&nbsp;Voltar&nbsp;</a>");
        }

        
        //    + avançar
        if ( $page < ($pages -1) ){
            $maior    =    $page + 1;
            $url2    =    '?mes=' . $_GET['mes'] . '&ano='. $_GET['ano'] . '&page='. $maior;
            
            $tpl->assignGlobal("a1",    "<a href='".$url2."' class='hub' >&nbsp;Avançar&nbsp;&raquo;</a>");
        }

        
    } elseif ( strlen($GLOBALS['OS']) > 0 ) {
        
        //--------------------------------------
        //    Segurança
        //        +    Verifica se a O.S é do vendedor atual
        //-------------------------------------
        $sqlSeg    =    'SELECT OSPedido.id FROM OSPedido JOIN OSVendedor ON OSVendedor.nome = ? AND OSVendedor.id = OSPedido.idVendedor WHERE OSPedido.id = ?';
        
        $VOs    =    $mysqli->prepare($sqlSeg);
        $VOs->bind_param('ss', $_SESSION['login']['nome'], $GLOBALS['OS']);
        @$VOs->execute();
        $VOs->store_result();
        
        if ( $VOs->num_rows == 0 )
        {
            header('Location: osAlt.php');
        }

        //    SQL dos dados do cliente
        $SQL    =    'SELECT * FROM OSCliente WHERE idOs = ?;';
        
        //    Comandos para puxar dados do Cliente
        $cliente    =    $mysqli->prepare($SQL);
        $cliente->bind_param('s', $GLOBALS['OS']);
        @$cliente->execute();
        $cliente->store_result();
         
        if ( $cliente->num_rows() > 0 ){
            
            $cliente->bind_result($idBD, $idOS, $nome, $nascimento, $doc1, $doc2, $conjuge, $rua, $numero, $apto, $edificio, $bairro, $telefone, $cidade, $cep, 
            $uf, $contato, $responsavel, $cpf, $telefoneResp, $ddd1, $ddd2, $complemento, $login, $bolsao, $conhecimento);
            $cliente->fetch();
            
            //    ID da OS
            $tpl->assign('os',                $GLOBALS['OS']);
            
            $tpl->assign('nomeCliente',     $nome);
            $tpl->assign('dtNascimento',    $nascimento);
            $tpl->assign('doc1',            $doc1);
            $tpl->assign('doc2',            $doc2);
            $tpl->assign('conjuge',            $conjuge);
            $tpl->assign('endereco',        $rua);
            $tpl->assign('numero',            $numero);
            $tpl->assign('apto',            $apto);
            $tpl->assign('complemento',        $complemento);
            $tpl->assign('edificio',        $edificio);
            $tpl->assign('bairro',            $bairro);
            $tpl->assign('cidade',            $cidade);
            $tpl->assign('cep',                $cep);
            $tpl->assign('ddd1',            $ddd1);
            $tpl->assign('telefone',        $telefone);
            $tpl->assign('contato',            $contato);
            $tpl->assign('responsavel',        $responsavel);
            $tpl->assign('doc3',            $cpf);
            $tpl->assign('ddd2',            $ddd2);
            $tpl->assign('foneResp',        $telefoneResp);
            $tpl->assign('estado',            $uf);
            $tpl->assign('login',            $login);
        
            switch($conhecimento)
            {
                case '0': $tpl->assign('conhecimento',    'Não cadastrado'); break;
                case '1': $tpl->assign('conhecimento',    'Zelador/Sindico Condominio'); break;
                case '2': $tpl->assign('conhecimento',    'Outdoor'); break;
                case '3': $tpl->assign('conhecimento',    'Busdoor'); break;
                case '4': $tpl->assign('conhecimento',    'Jornal/Revista'); break;
                case '5': $tpl->assign('conhecimento',    'Placa de rua'); break;
                case '6': $tpl->assign('conhecimento',    'Parceiro'); break;
                case '7': $tpl->assign('conhecimento',    'Site Redel'); break;
                case '8': $tpl->assign('conhecimento',    'Divulgação prédio (Flyer)'); break;
                case '9': $tpl->assign('conhecimento',    'Panfleto'); break;
                case '10': $tpl->assign('conhecimento',    'Indicação'); break;                                                                                                                                                
                case '11': $tpl->assign('conhecimento',    'Outro Site'); break;
                case '12': $tpl->assign('conhecimento',    'Outros'); break;
                case ''     : $tpl->assign('conhecimento',    'Não informado'); break;                                
            }
                                                        
            if ( $bolsao == '1')
            $tpl -> assign( 'bolsao', 'Sim');
            
            else
                $tpl -> assign( 'bolsao', 'Não');
            
            //    Venda conjunta
            $vConj    =    $mysqli->prepare('SELECT OSVendedor.nome FROM OSVendedor JOIN OSPedido ON OSPedido.idVendConj = OSVendedor.id  WHERE OSPedido.id = ?;');
            $vConj->bind_param("s", $GLOBALS['OS']);
            @$vConj->execute();
            $vConj->store_result();
            
            if ( $vConj->num_rows() > 0 ):
                $vConj->bind_result($vendedor);
                
                while ( $vConj->fetch() )
                {
                    $tpl->assign('nomeVend', $vendedor);
                }
            endif;
            
        }
        
        $cliente->free_result();
        $cliente->close();
        
        //    Endereço de cobrança
        $cob    =    $mysqli->prepare('SELECT * FROM OSClienteCobr WHERE idOs = ?');
        $cob->bind_param('s', $GLOBALS['OS']);
        @$cob->execute();
        $cob->store_result();
        
        if ( $cob->num_rows() > 0 ) {
        
            $cob->bind_result($idDB, $idOS, $Nome, $end, $numero, $apto, $edificio, $bairro, $telefone, $cidade, $cep, $estado, $ddd3);
            $cob->fetch();
            
            $tpl->newBlock('endCob');
            
            $tpl->assign('nomeC',        $Nome);
            $tpl->assign('enderecoC',    $end);
            $tpl->assign('numeroC',        $numero);
            $tpl->assign('aptoC',        $apto);
            $tpl->assign('edificioC',    $edificio);
            $tpl->assign('bairroC',        $bairro);
            $tpl->assign('ddd3',        $ddd3);
            $tpl->assign('telefoneC',    $telefone);
            $tpl->assign('cidadeC',        $cidade);
            $tpl->assign('cep',            $cep);
            $tpl->assign('uf',            $estado);
        }
        
        $cob->free_result();
        $cob->close();
        
        //+    Retorno o template para o bloco root
        
        
        //    Serviços
        //+    Registro de dominio
            
        //$registro    =    $mysqli->prepare('SELECT dominio, obs, anualidade, anos, obsVenda FROM OSRegistro WHERE idOs = ?');
        $sql = "SELECT dominio, OSRegistro.obs AS 'OBSREGISTRO', anualidade, anos, obsVenda, OSTecnica.obs AS 'OSBTECNICA', OSStatusTec.nome AS 'Status'
        FROM OSRegistro 
        LEFT OUTER JOIN OSTecnica ON OSTecnica.idOs = OSRegistro.idOs  AND servico = 1
        LEFT OUTER JOIN OSStatusTec ON OSStatusTec.id = OSTecnica.status
        WHERE OSRegistro.idOs = ?
        GROUP BY OSRegistro.idOs, servico";    
        
        
        $registro    =    $mysqli->prepare($sql);
        
        $registro->bind_param('s', $GLOBALS['OS']);
        @$registro->execute();
        $registro->store_result();
        
        if ( $registro->num_rows() > 0 )
        {
        
            $registro->bind_result($dominio, $OBSREGISTRO, $anuidade, $anos, $obsVnd, $OSBTECNICA , $Status );

            while ( $registro->fetch() )
            {
            
                $tpl->newBlock('registro');
                
                $tpl->assign('dominio',     $dominio);
                $tpl->assign('obs',            $OBSREGISTRO);
                $tpl->assign('obsVnd',        $obsVenda);
                $tpl->assign('vlrAnual',    $anuidade);
                $tpl->assign('regAnos',        $anos);
                
                
                $tpl->assign('Rstatus',        $Status ? $Status : "Não finalizado");
                $tpl->assign('RobsTecn',        $OSBTECNICA);
            }
            
            $tpl->gotoBlock('_ROOT');
        }
        
        $registro->free_result();
        $registro->close();

        
        //+    Hospedagem
        //$hospedagem    =    $mysqli->prepare('SELECT plano, dominio, obs, mensalidade, obsVenda FROM OSHospedagem WHERE idOs = ?');
        $sql = "
        SELECT plano, dominio, OSHospedagem.obs as 'OBSHOSPEDAGEM', mensalidade, obsVenda, OSTecnica.obs AS 'OSBTECNICA', OSStatusTec.nome AS 'Status' FROM OSHospedagem
        LEFT OUTER JOIN OSTecnica ON OSTecnica.idOs = OSHospedagem.idOs AND servico = 6
        LEFT OUTER JOIN OSStatusTec ON OSStatusTec.id = OSTecnica.status
        WHERE OSHospedagem.idOs = ?
        GROUP BY OSHospedagem.idOs, servico";
        //'echo "<pre>$sql</pre>";
        
        
        $hospedagem    =    $mysqli->prepare($sql);
        $hospedagem->bind_param('s', $GLOBALS['OS']);
        @$hospedagem->execute();
        $hospedagem->store_result();
        
        if ( $hospedagem->num_rows() > 0 )
        {
        
            $hospedagem->bind_result($plano, $dominio, $obs, $mensalidade, $obsVenda, $OSBTECNICA , $Status);
            
            while ( $hospedagem->fetch() )
            {
            
                $tpl->newBlock('hospedagem');
            
                $tpl->assign('dominio',     $dominio);
                $tpl->assign('vlrMensal',    $mensalidade);
                $tpl->assign('obs',            $obs);
                $tpl->assign('obsVnd',        $obsVenda);
                
                $tpl->assign('Hstatus',        $Status ? $Status : "Não finalizado");
                $tpl->assign('HobsTecn',        $OSBTECNICA);
                
                
                //    Planos de hospedagem
                $pHosp    =    $mysqli->prepare('SELECT plano FROM OSPlanos WHERE id =  ?;');
                $pHosp->bind_param('s', $plano);
                @$pHosp->execute();
                $pHosp->store_result();
                
                $pHosp->bind_result($nome);
                
                while ( $pHosp->fetch() ){

                    $tpl->assign('plano',     $nome);
                    
                }
                $pHosp->free_result();
                $pHosp->close();
            }
            
            $tpl->gotoBlock('__ROOT');
        }
        
        $hospedagem->free_result();
        $hospedagem->close();
        
        //+    Discado
        //$discado    =    $mysqli->prepare('SELECT plano, cidade, mensalidade, obs, obsVenda FROM OSDiscado WHERE idOs = ?');
        $sql = "SELECT plano, cidade, mensalidade, OSDiscado.obs as 'OBSDISCADO', obsVenda, OSTecnica.obs AS 'OSBTECNICA', OSStatusTec.nome AS 'Status' FROM OSDiscado
        LEFT OUTER JOIN OSTecnica ON OSTecnica.idOs = OSDiscado.idOs AND servico = 5
        LEFT OUTER JOIN OSStatusTec ON OSStatusTec.id = OSTecnica.status
        WHERE OSDiscado.idOs = ?
        GROUP BY OSDiscado.idOs, servico";
        
        
        $discado    =    $mysqli->prepare($sql);
        
        $discado->bind_param('s', $GLOBALS['OS']);
        @$discado->execute();
        $discado->store_result();
        
        if ( $discado->num_rows() > 0 ){
        
            $discado->bind_result($plano, $cidade, $mensalidade, $obs, $obsVenda, $OSBTECNICA , $Status);
            
            while ( $discado->fetch() ){
            
                $tpl->newBlock('discado');
                
                $tpl->assign('cidade',        $cidade);
                $tpl->assign('obs',            $obs);
                $tpl->assign('obsVnd',        $obsVenda);
                $tpl->assign('vlrMensal',    $mensalidade);
                
                $tpl->assign('Dstatus',        $Status ? $Status : "Não finalizado");
                $tpl->assign('DobsTecn',        $OSBTECNICA);
                
                //    Planos Acesso Discado
                $disc    =    $mysqli->prepare('SELECT plano FROM OSPlanos WHERE id = ?');
                $disc->bind_param('s', $plano);
                @$disc->execute();
                $disc->store_result();
                
                $disc->bind_result($nome);
                
                while ( $disc->fetch() ){

                    $tpl->assign('plano',     $nome);

                }
                $disc->free_result();
                $disc->close();
            }
            
            $tpl->gotoBlock('__ROOT');
        }
        
        $discado->free_result();
        $discado->close();
        
        //+    Adsl
        //$adsl    =    $mysqli->prepare('SELECT plano, valor, adesao, instalacao, pAdesao, vPAdesao, provedor, mAVista, mParcela, mAluguel, mensalidade, obs, mValPar, fidelizacao, promModem, vlrPromModem, obsVenda FROM OSAdsl WHERE idOs = ?');
        $sql = "SELECT plano, valor, adesao, instalacao, pAdesao, vPAdesao, provedor, mAVista, mParcela, mAluguel, mensalidade, OSAdsl.obs as 'OBADSL', 
            mValPar, fidelizacao, promModem, vlrPromModem, obsVenda, OSTecnica.obs AS 'OSBTECNICA', OSStatusTec.nome AS 'Status' FROM OSAdsl
            LEFT OUTER JOIN OSTecnica ON OSTecnica.idOs = OSAdsl.idOs AND servico = 3
            LEFT OUTER JOIN OSStatusTec ON OSStatusTec.id = OSTecnica.status
            WHERE OSAdsl.idOs =  ?
            GROUP BY OSAdsl.idOs, servico";
        $adsl    =    $mysqli->prepare($sql);

        $adsl->bind_param('s', $GLOBALS['OS']);
        @$adsl->execute();
        $adsl->store_result();
        
        if ( $adsl->num_rows() > 0 ){
        
            $adsl->bind_result($plano, $valor, $adesao, $inst, $pAdesao, $vPAdesao, $provedor, $mAVista, $mParcela, $mAluguel, $mensalidade, $obs, $mValPar, 
                               $fidelizacao, $promModem, $vlrPromModem, $obsVnd, $OSBTECNICA , $Status);
            
            while ( $adsl->fetch() ){
            
                $tpl->newBlock("adsl");
                
                $tpl->assign('vlrMensal',     $valor);
                $tpl->assign('adsVlrl',        $mensalidade);
                $tpl->assign('mdmAvs',        $mAVista);
                $tpl->assign('numParM',        $mParcela);
                $tpl->assign('mdmParV',        $mValPar);
                $tpl->assign('vlrAlugMdm',    $mAluguel);
                $tpl->assign('obs',            $obs);
                $tpl->assign('cfgMdm',        $inst);
                $tpl->assign('numPar',        $pAdesao);
                $tpl->assign('adsVlrPar',    $vPAdesao);
                $tpl->assign('adesao',        $adesao);
                $tpl->assign('dslDesc',        $vlrPromModem);
                $tpl->assign('obsVnd',        $obsVnd);
                $tpl->assign('Astatus',        $Status ? $Status : "Não finalizado");
                $tpl->assign('AobsTecn',    $OSBTECNICA);
                
                //    Fidelização
                if ( $fidelizacao == 1 )
                {
                    $tpl->assign('dslfid', 'checked="checked"');
                }
                
                //    Promoção Modem Adsl
                if ( $promModem == 1 )
                {
                    $tpl->assign('dslPro',    'checked="checked"');
                }
                    
                //    Velocidades do Adsl
                $dsl    =    $mysqli->prepare('SELECT plano FROM OSPlanos WHERE id = ?;');
                $dsl->bind_param('s', $plano);
                @$dsl->execute();
                $dsl->store_result();
                    
                $dsl->bind_result($nome);
                    
                while ( $dsl->fetch() ){

                        $tpl->assign('plano',     $nome);
                }
                $dsl->free_result();
                $dsl->close();
                
                //    Provedor de adsl    
                $dslb    =    $mysqli->prepare('SELECT plano FROM OSPlanos WHERE id = ?');
                $dslb->bind_param('s', $provedor);
                @$dslb->execute();
                $dslb->store_result();
                    
                $dslb->bind_result($nome);
                    
                while ( $dslb->fetch() ){

                    $tpl->assign('LSAdsl',    $nome);
                }
            }
            
            $tpl->gotoBlock('__ROOT');
        }
        
        $adsl->free_result();
        $adsl->close();
        
        //+    Via Cabo
        //$cabo    =    $mysqli->prepare('SELECT velocidade, valVel, provedor, obs, modemAvista, mQtdPar, mValPar, mAluguel, valProv, vlrPromModem , promModem, obsVenda FROM OSCabo WHERE idOs = ?');
        $sql = "SELECT velocidade, valVel, provedor, OSCabo.obs as 'OBSCABO', modemAvista, mQtdPar, mValPar, mAluguel, valProv, vlrPromModem , promModem, obsVenda , OSTecnica.obs AS 'OSBTECNICA', OSStatusTec.nome AS 'Status' 
            FROM OSCabo
            LEFT OUTER JOIN OSTecnica ON OSTecnica.idOs = OSCabo.idOs and servico = 4
            LEFT OUTER JOIN OSStatusTec ON OSStatusTec.id = OSTecnica.status
            WHERE OSCabo.idOs = ?
            GROUP BY OSCabo.idOs, servico";
            
        $cabo    =    $mysqli->prepare($sql);

        $cabo->bind_param('s', $GLOBALS['OS']);
        @$cabo->execute();
        $cabo->store_result();
        
        if ( $cabo->num_rows() > 0 ) {
        
            $cabo->bind_result($velocidade, $valVel, $provedor, $obs, $mdmAVista, $mQtdPar, $mValPar, $mAluguel, $valProv, $vlrPromModem, $promModem, $obsVnd, $OSBTECNICA , $Status);
            
            while ( $cabo->fetch() ){
                
                $tpl->newBlock('cabo');
    
                $tpl->assign('vlrMensal',    $valVel);
                $tpl->assign('adsVlrl',        $valProv);
                $tpl->assign('mdmAvs',        $mdmAVista);
                $tpl->assign('numParM',        $mQtdPar);
                $tpl->assign('mdmParV',        $mValPar);
                $tpl->assign('vlrAlugMdm',    $mAluguel);
                $tpl->assign('obs',            $obs);
                $tpl->assign('descMdm',        $vlrPromModem);
                $tpl->assign('provV',        $valProv);
                $tpl->assign('obsVnd',        $obsVnd);
                $tpl->assign('Cstatus',        $Status ? $Status : "Não finalizado");
                $tpl->assign('CobsTecn',    $OSBTECNICA);
                
                //    Promoção CableModem
                if ( $promModem == 1 )
                {
                    $tpl->assign('cabop',    'checked="checked"');
                }
                    
                //    Planos Via Cabo
                $viaCabo    =    $mysqli->prepare('SELECT plano FROM OSPlanos WHERE id = ?');
                $viaCabo->bind_param('s', $provedor);
                @$viaCabo->execute();
                $viaCabo->store_result();
                    
                $viaCabo->bind_result($plano);
                    
                while ( $viaCabo->fetch() ){

                    $tpl->assign('plano',     $plano);

                }
                
                $viaCabo->free_result();
                $viaCabo->close();    
                
                //    Plano redel
                $vCabo    =    $mysqli->prepare('SELECT plano FROM OSPlanos WHERE id = ?');
                $vCabo->bind_param('s', $velocidade);
                @$vCabo->execute();
                $vCabo->store_result();
                    
                $vCabo->bind_result($plano);
                    
                while ( $vCabo->fetch() ){
                    $tpl->assign('provedor',     $plano);
                }
                
                $vCabo->free_result();
                $vCabo->close();
            }
            
            $tpl->gotoBlock('__ROOT');
        }
        
        $cabo->free_result();
        $cabo->close();
        
        //+    Via Radio
        //$radio    =    $mysqli->prepare('SELECT planos, velocidade, obs, nPontos, adesao, parcelas, vParcela, mensalidade, obsVenda FROM OSViaRadio WHERE idOs = ?');

        $sql = "SELECT planos, velocidade, OSViaRadio.obs as 'OBSVIARADIO', nPontos, adesao, parcelas, vParcela, mensalidade, obsVenda, OSTecnica.obs AS 'OSBTECNICA', OSStatusTec.nome AS 'Status'  FROM OSViaRadio
        LEFT OUTER JOIN OSTecnica ON OSTecnica.idOs = OSViaRadio.idOs and servico = 2
        LEFT OUTER JOIN OSStatusTec ON OSStatusTec.id = OSTecnica.status
        WHERE OSViaRadio.idOs = ?
        GROUP BY OSViaRadio.idOs, servico";
        
        $radio    =    $mysqli->prepare($sql);
        $radio->bind_param('s', $GLOBALS['OS']);
        @$radio->execute();
        $radio->store_result();
        
        if ( $radio->num_rows() > 0 ) {
        
            $radio->bind_result($plano, $velocidade, $obs, $nPontos, $adesao, $parcelas, $vParcela, $mensalidade, $obsVnd, $OSBTECNICA , $Status);
            
                while ( $radio->fetch() )
                {
                
                    $tpl->newBlock('radio');
            
                    $tpl->assign('adsVlrl',        $mensalidade);
                    $tpl->assign('nPontos',        $nPontos);
                    $tpl->assign('adesao',        $adesao);
                    $tpl->assign('numParc',        $parcelas);
                    $tpl->assign('vlrParc',        $vParcela);
                    $tpl->assign('obs',            $obs);
                    $tpl->assign('obsVnd',        $obsVnd);
                    $tpl->assign('Kstatus',        $Status ? $Status : "Não finalizado");
                    $tpl->assign('KobsTecn',    $OSBTECNICA);
                        
                    //    Planos Via Radio
                    $viaRadio    =    $mysqli->prepare('SELECT plano FROM OSPlanos WHERE id = ?');
                    $viaRadio->bind_param('s', $velocidade);
                    @$viaRadio->execute();
                    $viaRadio->store_result();
                    
                    $viaRadio->bind_result($nome);
                    
                    while ( $viaRadio->fetch() )
                    {

                        $tpl->assign('plano',     $nome);
        
                    }
                    $viaRadio->free_result();
                    $viaRadio->close();                    
                    
                    //    provedor
                    if ( $plano == 1 )
                    {
                        $tpl->assign('ss1',        'selected="selected"');
                    }
                    elseif ( $plano == 2 )
                    {
                        $tpl->assign('ss2',        'selected="selected"');
                    }
                }
                
                $tpl->gotoBlock('__ROOT');
            }
            
            $radio->free_result();
            $radio->close();
            
            //+    redel cabo
        //$radio    =    $mysqli->prepare('SELECT plano, valVel, obsVenda, obsTecnica FROM OSRedelCabo WHERE idOs = ?');
        $sql = "SELECT plano, valVel, obsVenda, obsTecnica, OSTecnica.obs AS 'OSBTECNICA', OSStatusTec.nome AS 'Status'  FROM OSRedelCabo
        LEFT OUTER JOIN OSTecnica ON OSTecnica.idOs = OSRedelCabo.idOs and servico = 7
        LEFT OUTER JOIN OSStatusTec ON OSStatusTec.id = OSTecnica.status
        WHERE OSRedelCabo.idOs = ?;";
        
        $radio    =    $mysqli->prepare($sql);

        $radio->bind_param('s', $GLOBALS['OS']);
        @$radio->execute();
        $radio->store_result();
        
        if ( $radio->num_rows() > 0 ) {
        
            $radio->bind_result($plano, $valor, $obs, $obsTecnica, $OSBTECNICA , $Status);
            
                while ( $radio->fetch() ){
                
                    $tpl->newBlock('redelcabo');
            
                    $tpl->assign('valor',        $valor);
                    $tpl->assign('obs',            $obs);
                    $tpl->assign('obsVnd',        $obs);
                    $tpl->assign('Estatus',        $Status ? $Status : "Não finalizado");
                    $tpl->assign('E
                    obsTecn',    $OSBTECNICA);
                        
                    //    Planos Via Radio
                    $viaRadio    =    $mysqli->prepare('SELECT plano FROM OSPlanos WHERE id = ?');
                    $viaRadio->bind_param('s', $plano);
                    @$viaRadio->execute();
                    $viaRadio->store_result();
                    
                    $viaRadio->bind_result($nome);
                    
                    while ( $viaRadio->fetch() ){

                        $tpl->assign('plano',     $nome);
        
                    }
                    $viaRadio->free_result();
                    $viaRadio->close();
                        
                }
                
                $tpl->gotoBlock('__ROOT');
            }            
    }
    
        //+    Servicos Adicionais
        $ServDiv    =    $mysqli->prepare('SELECT description, obsVenda, obsTec FROM OSServDiv WHERE idOs = ?');
        $ServDiv->bind_param('s', $GLOBALS['OS']);
        @$ServDiv->execute();
        $ServDiv->store_result();
        
        if ( $ServDiv->num_rows() > 0 ) 
        {
        
            $ServDiv->bind_result($description, $obsVenda, $obsTec);
            
                while ( $ServDiv->fetch() )
                {
                    $tpl->newBlock('ServAdd');
                                
                    $tpl->assign('description',        $description);
                    $tpl->assign('obsVenda',        $obsVenda);
                    $tpl->assign('obsTec',            $obsTec);    
                }
                
                $tpl->gotoBlock('__ROOT');
        }
            
            $ServDiv->free_result();
            $ServDiv->close();

        //-----------------------------------------------
        // STATUS TECNICAS
        //-----------------------------------------------            
        //status tecnicos
        /*
            $SQLST        =    'SELECT OSStatusTec.nome AS status, OSTecnica.obs, OSTecnica.servico FROM OSTecnica JOIN OSStatusTec ON OSTecnica.status = OSStatusTec.id 
                             WHERE idOs = ?';
        
            $resultST    =    $mysqli    ->    prepare( $SQLST );
            $resultST    ->    bind_param('s', $GLOBALS['OS'] );
            $resultST    ->    execute();
            $resultST    ->    store_result();
            
            $resultST    ->    bind_result( $status, $obsTecn, $servico );
            
            if( $resultST    ->    num_rows() > 0 )
            {
                    $resultST    ->    fetch();            
                    
                    $tpl    ->    assign('status',     $status);
                    $tpl    ->    assign('obsTecn',    $obsTecn);            
            }
            else {            
                $tpl->assign('status',     'Status não informado');
            }
            
            $resultST    ->    free_result();
            $resultST    ->    close();            
        */

    //-----------------------------------------------
    // EXIBIR DADOS
    //-----------------------------------------------
    $tpl->printToScreen();
    
    //-----------------------------------------------
    // LOGIN
    //-----------------------------------------------
else:

    header("Location: index.php?ERGO=" . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);

endif;
?>