<?php
    echo '
    <div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky">
  <nav class="uk-navbar-container" uk-navbar>
    <div class="uk-navbar-left">

        <ul class="uk-navbar-nav">
            <li><a href="index.php">Inici</a></li>
            <li>
                <a href="insignies.php">Insignies</a>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <li><a href="insignia.php">Nova insignia</a></li>
                        <li><a href="atorgarinsignia.php">Atornar insignia</a></li>
                        <li><a href="consultaratorgades.php">Llista atorgades</a></li>
                    </ul>
                </div>
            </li>
            <li>
            <a href="treballadors.php">Treballadors</a>
            <div class="uk-navbar-dropdown">
                <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li><a href="inserirtreballadors.php">Inserir treballadors</a></li>
                    <li><a href="treballador.php">Nou treballador</a></li>
                </ul>
            </div>
            </li>

            <li>
            <a href="#">'.$_SESSION['usuari'].'</a>
            <div class="uk-navbar-dropdown">
                <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li><a href="login.php">Sortir</a></li>
                </ul>
            </div>
            </li>

            
        </ul>

    </div>
</nav>
</div>
  
  
  
  ';
