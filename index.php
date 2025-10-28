<?php include('layouts/header.php');?>

<h2 class="card-title text-center">Descubra Seu Signo</h2>

<form id="signo-form" method="POST" action="show_zodiac_sign.php">
    <div class="mb-3">
        <label for="data_nascimento" class="form-label">Data de Nascimento:</label>
        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" placeholder="Ex.: 21/05/1992" required>
        </div>
    <button type="submit" class="btn btn-primary mt-3">Descobrir Signo</button>
</form>

<?php 

echo '</div>'; 
echo '</div>'; 
echo '</body>'; 
echo '</html>'; 
?>