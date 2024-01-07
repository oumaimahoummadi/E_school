<section class="chat-area" style="width:40%;height:100%;">
    <section >
        <i class="fa fa-user-circle img"></i>
        <h1><?php echo $_SESSION['utilisateur']['NOM'] ." " . $_SESSION['utilisateur']['PRENOM'] ?></h1>
    </section>
    <div class="chat-box" id="usersList" onmouseover="clearInterval(refreshUsers);" style="padding:0; padding-left:10px;" onmouseout="refreshUsers=setInterval(refreshList,1000)">
        <?php include_once("usersList.php"); ?>
    </div>
</section>