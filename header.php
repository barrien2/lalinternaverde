<?php
	echo '<header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title">L\'empleat del mes</span>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation. We hide it in small screens. -->
      <nav class="mdl-navigation mdl-layout--large-screen-only">
        <a class="mdl-navigation__link" href="index.php">Inici</a>
        
        <a class="mdl-navigation__link" href="treballadors.php">Llista treballadors</a>
        
        
        <a class="mdl-navigation__link" href="inserirtreballadors.php">Inserir treballadors</a>
      </nav>
    </div>
  </header>
  



  <nav class="uk-navbar-container" uk-navbar>
    <div class="uk-navbar-left">

        <ul class="uk-navbar-nav">
            <li><a href="index.php">Inici</a></li>
            <li>
                <a href="insignies.php">Insignies</a>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <li><a href="novainsignia.php">Nova insignia</a></li>
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
                </ul>
            </div>
            </li>
        </ul>

    </div>
</nav>
  
  
  
  ';
