
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once('head.php'); 
	
		if(isset($_GET['classe'])) titrePage("classe");
		if(isset($_GET['cours'])) titrePage("cours");
		else titrePage("Bienvenue");
	
	?>
</head>
<body>
    <style>
        section p{color: #000;}
        .section-header .line span{color: #000;}
        i{text-align: center;}
        .Faculty{
    background: #f7f7f7;
}
.filieres .serv{
    background: #fff;
    padding: 20px;
    text-align: center;
    margin-bottom: 20px;
}
.filieres .serv .icon{
    background: #965116;
    width: 60px;
    height: 60px;
    text-align: center;
    line-height: 60px;
    color: #fff;
    border-radius: 50%;
}
.filieres .serv-title{
    font-weight: bold;
    font-size: 25px;
    margin-bottom: 20px;
    margin-top: 20px;
}
.filieres .serv-desc{
    font-size: 16px;
    color:#888;
    margin-top: 20px;

}
.about-info-desc{height:230px;overflow:hidden;}
.about-info.showContent p{height:auto;}
.about-info.showContent .readmore-btn{background: #965116;}
    </style>

        <section id="accueil" class="sections home text-center">
            <div class="overlay">
                <div class="container">
                    <div class="home-content">
                        <h3 class="home-title">ESTE Essaouira</h3>
                        <p class="home-desc">L’École Supérieure de Technologie d'Essaouira (ESTE), créée en 2005, est une école marocaine d'enseignement supérieur public. Elle fait partie du réseau des écoles supérieures de technologie et relève de l'Université Cadi Ayyad.</p>
                        <a href="enregistrer.php?type_compte=enseignant"><button class="btn button">Espace enseignant</button></a>
                        <a href="enregistrer.php?type_compte=etudiant"><button class="btn button">Espace étudiant</button></a>
                    </div>
                </div>
            </div>
        </section>

        <!-- About -->

       <section id="About" class="sections about">
            <div class="container">
                <div class="section-header text-center">
                    <h2 class="section-title">About Us</h2>
                    <div class="line"><span></span> </div>
                    <p>l‘Ecole Supérieure de Technologie d‘Essaouira (ESTE) est un établissement public d‘enseignement supérieur á finalité professionnalisante. <br></p>
                </div>

                <div class="row">
                <div class="col-md-6">
                    <div class="about-info">
                        <h3>PRÉSENTATION GÉNÉRALE sur <span>EST Essaouira</span></h3>
                        <p class="about-info-desc">EST Essaouira Ecole Supérieure de Technologie Essaouira : est un établissement public d'enseignement supérieur à finalité professionnalisant. La durée des études à l'EST est de deux années universitaires. - La première année s'étale sur 32 semaines suivies de quatre semaines de stage dans l'entreprise en Juillet ou Aout. - La deuxième année est de 36 semaines dont 8 semaines de stage et dispensé é raison de 36 heures par semaine en moyenne. Le système d'évaluation des connaissances sur Ecole Supérieure de Technologie Essaouira ( EST Essaouira ou ESTE ) repose sur le contrôle continue au cours de quatre semestres d'étude . Le contrôle continue à Ecole Supérieure de Technologie Essaouira ( EST Essaouira ou ESTE ) porte jugement sur les connaissances acquises et la participation en classe ainsi que sur l'intérêt accordé par l'étudiant à l'enseignement et sur les progrès constatés. Les étudiants sont tenus aussi d'accomplir des stages pratiques obligatoires dans l'industrie. Ces stages font l'objet d'un rapport qui est soutenu devant un jury mixte composé d'enseignants et d'industriels. L'assiduité à toutes les activités d'enseignement est obligatoire.</p>
                        <a href="javascript:void();" class="readmore-btn about-info-btn">Read More</a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="about-img">
                        <img src="img/tt.jpg">
                    </div>
                </div>
        </div>
            </div>
        </section> 
        <section id="filieres" class="sections filieres">
            <div class="container">
                <div class="section-header text-center">
                        <h2 class="section-title">filieres</h2>
                        <div class="line"><span></span> </div>
                        <p>L'École Supérieure de Technologie d'Essaouira (ESTE) dispense en deux ans une formation universitaire et technologique. Cette formation est sanctionnée par le Diplôme universitaire de technologie (DUT).</p>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <div class="serv">
                                <i class="icon fa fa-database fa-lg"></i>
                                <h3 class="serv-title">DUT/IDSD</h3><br>
                                <p class="serv-desc my-2"> Informatique Décisionnelle et Sciences de Données.</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="serv">
                                <i class="icon fa fa-code fa-lg"></i>
                                <h3 class="serv-title mb-3">DUT/GI</h3><br>
                                <p class="serv-desc my-4"> Génie Informatique.</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="serv">
                                <i class="icon fa fa-tasks fa-lg"></i>
                                <h3 class="serv-title mb-3">DUT/TM</h3><br>
                                <p class="serv-desc my-4"> Technique de Management .</p>
                            </div>
                        </div>
                    
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <div class="serv">
                                <i class="icon fa fa-sitemap fa-lg"></i>
                                <h3 class="serv-title ">DUT/GODT </h3><br>
                                <p class="serv-desc my-2"> Gestion des Organisations et des Destinations Touristiques .</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="serv">
                            <i class="icon fa fa-bolt fa-lg"></i>
                                <h3 class="serv-title mb-3">DUT/ER</h3><br>
                                <p class="serv-desc my-4">Energies Renouvelables . </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="serv">
                                <i class="icon fa fa-leaf fa-lg"></i>
                                <h3 class="serv-title mb-3">DUT/GE</h3><br>
                                <p class="serv-desc my-4"> Génie de l'Environment .</p>
                            </div>
                        </div>
                    
                    </div>
            </div>
        </section>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(".readmore-btn").on('click',function(){
            $(this).parent().toggleClass("showContent");
            var replaceText = $(this).parent().hasClass("showContent") ? "Read Less" : "Read More";
            $(this).text(replaceText);
        });
    </script>
    
</body>