
<div class="off-canvas-wrapper">
    <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
        <!-- off-canvas title bar for 'small' screen -->
        <div class="title-bar" data-responsive-toggle="widemenu" data-hide-for="medium">
            <div class="title-bar-left">
                <button class="menu-icon" type="button" data-open="offCanvasLeft"></button>
                <span class="title-bar-title">Eenmaal Andermaal</span>
            </div>
        </div>
        <!-- off-canvas left menu -->
        <div class="off-canvas position-down" id="offCanvasLeft" data-off-canvas>
            <ul class="vertical dropdown menu" data-dropdown-menu>
                <li>
                    <a href="actievebiedingen.php">
                        <div class="menu">Actieve biedingen</div>
                    </a>
                </li>
                <li>
                    <a href="contact.php">
                        <div class="menu">Contact</div>
                    </a>
                </li>
				
				<?php 
				
				if (isset($_SESSION['username'])) 
				{
                echo '<li>';
                    echo '<a href="mijnaccount.php">';
                        echo '<div class="menu">Mijn account</div>';
                    echo '</a>';
                echo '</li>';
				
				} 
				else  {
                echo '<li>';
                    echo '<a href="loginscreen.php">';
                        echo '<div class="menu">Inloggen</div>';
                    echo '</a>';
                echo '</li>';
				} 
				?>
            </ul>
        </div>
        
        <!-- "wider" top-bar menu for 'medium' and up -->
        <div id="widemenu" class="top-bar">
            <div class="top-bar-left">
                <ul class="dropdown menu">
                    <li class="background">
                        <a href="actievebiedingen.php"class="button"><div class="menu">Actieve biedingen</div></a></li>
                    <li class="background">
                        <a href="contact.php" class="button"><div class="menu">Contact</div></a></li>
                    <li class="background">
					<?PHP if (isset($_SESSION['username'])) 
						{
                        echo '<a href="mijnaccount.php" class="button"><div class="menu">Mijn Account</div></a></li>';
						
						} 
						else {
							echo '<a href="loginscreen.php" class="button"><div class="menu">Inloggen</div></a></li>';
						}
				?>
                </ul>
            </div>
        </div>

        <!-- original content goes in this container -->
        <div class="off-canvas-content" data-off-canvas-content>
