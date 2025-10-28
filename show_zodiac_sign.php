<?php include('layouts/header.php');?>

<?php

function encontrarSigno($data_nascimento) {
    
    $mes_dia_nascimento = substr($data_nascimento, 5); 
    
    $signos_xml = @simplexml_load_file("signos.xml");

    if ($signos_xml === false) {
        return ['erro' => 'Erro ao carregar o arquivo XML.'];
    }

    
    foreach ($signos_xml->signo as $signo) {

        $dataInicio_str = (string) $signo->dataInicio;
        $dataFim_str = (string) $signo->dataFim;

        
        $data_inicio_obj = DateTime::createFromFormat('d/m', $dataInicio_str);
        $data_fim_obj = DateTime::createFromFormat('d/m', $dataFim_str);

        if (!$data_inicio_obj || !$data_fim_obj) {
             
             continue; 
        }

        
        $mes_dia_inicio = $data_inicio_obj->format('m-d');
        $mes_dia_fim = $data_fim_obj->format('m-d');

        
        if ((string) $signo->signoNome == 'Capricórnio') {

            if ($mes_dia_nascimento >= $mes_dia_inicio || $mes_dia_nascimento <= $mes_dia_fim) {
                return $signo;
            }
        } 
        
        else if ($mes_dia_nascimento >= $mes_dia_inicio && $mes_dia_nascimento <= $mes_dia_fim) {
            return $signo;
        }
    }


    return null;
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['data_nascimento']) && !empty($_POST['data_nascimento'])) {
    $data_nascimento = $_POST['data_nascimento'];
    $signo_encontrado = encontrarSigno($data_nascimento);

    if (isset($signo_encontrado['erro'])) {
        $nome_signo = "Erro no Sistema";
        $descricao_signo = $signo_encontrado['erro'];
    } elseif ($signo_encontrado) {
        $nome_signo = (string) $signo_encontrado->signoNome;
        $descricao_signo = (string) $signo_encontrado->descricao;
    } else {
        $nome_signo = "Signo Não Encontrado";
        $descricao_signo = "A data inserida não corresponde a um signo astrológico no nosso arquivo.";
    }
} else {
    
    header('Location: index.php');
    exit;
}
?>

<div class="result-box">
    <h1 class="signo-name"><?php echo $nome_signo; ?></h1>
    <p class="signo-desc"><?php echo $descricao_signo; ?></p>

    <p class="mt-4"><a href="index.php" class="home-link">← Descobrir outro signo</a></p>
</div>

<?php 

echo '</div>'; 
echo '</div>'; 
echo '</body>'; 
echo '</html>'; 
?>
