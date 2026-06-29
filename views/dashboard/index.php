<?php @include_once __DIR__ . '/header-dashboard.php';?>

<?php
    echo count($proyectos) === 0 ? "<p class='no-proyectos'>No hay proyectos aún</p>" : "";
    foreach($proyectos as $proyecto) { ?>
        <div>
            <ul class="listado-proyectos">
                <li class="proyecto">   
                    <a href="/proyecto?url=<?php echo $proyecto->url; ?>">
                        <?php echo $proyecto->proyecto; ?>
                    </a>
                </li>
            </ul>   
        </div>
<?php } ?>
<?php @include_once __DIR__ . '/footer-dashboard.php';?>
